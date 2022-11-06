<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/city.js"></script>

<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Login Script -->

<script>
    // function that will get the parameter from the url
    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    <?php if (isset($_SESSION['randomId'])) : ?>

        // Employee Data Table
        $(document).ready(function() {
            let employeeTable = $("#employeeTable").DataTable({
                processing: true,
                columnDefs: [],

                scrollCollapse: false,
                scroller: {
                    loadingIndicator: true,
                },
                stateSave: false,
            });

            let adminTable = $("#adminTable").DataTable({
                processing: true,
                columnDefs: [],

                scrollCollapse: false,
                scroller: {
                    loadingIndicator: true,
                },
                stateSave: false,
            });

            let usersTable = $("#usersTable").DataTable({
                processing: true,
                columnDefs: [],

                scrollCollapse: false,
                scroller: {
                    loadingIndicator: true,
                },
                stateSave: false,
            });
        });

    <?php else : ?>

        $("#loginForm").on("submit", function(e) {
            e.preventDefault();

            let user = $("#user").val();
            let password = $("#password").val();

            if (user.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username is required!',
                })
            } else if (password.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password is required!',
                })
            } else {
                $.ajax({
                    url: "controllers/loginController.php",
                    method: "POST",
                    data: {
                        user: user,
                        password: password,
                        login: 1
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please wait...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            },

                        })
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Username does not exist!',
                            })
                        } else if (data == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Password is incorrect!',
                            })
                        } else if (data == 2) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location = "index.php";
                            })
                        } else if (data == 3) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Account does not exist!',
                            })
                        }
                    }
                })
            }
        })

        $("#customCheck").on("click", function() {
            if ($("#customCheck").is(":checked")) {
                $("#password").attr("type", "text");
            } else {
                $("#password").attr("type", "password");
            }
        })

    <?php endif; ?>
</script>