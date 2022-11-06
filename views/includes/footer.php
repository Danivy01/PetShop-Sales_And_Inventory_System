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
<script src="assets/js/demo/datatables-demo.js"></script>
<script src="assets/js/city.js"></script>

<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Login Script -->

<script>
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
                    } else if (data == 3){
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
</script>