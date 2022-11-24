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

            let customerTable = $("#customerTable").DataTable({
                processing: true,
                columnDefs: [],

                scrollCollapse: false,
                scroller: {
                    loadingIndicator: true,
                },
                stateSave: false,
            });
        });

        // Add Customer Logic

        $("#addCustomer").on("submit", function(e) {
            e.preventDefault();

            let firstname = $("#firstname").val();
            let lastname = $("#lastname").val();
            let phonenumber = $("#phonenumber").val();
            let pattern = /^(09|\+639)\d{9}$/;

            if (firstname.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'First Name cannot be blank!',
                })
            } else if (lastname.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Last Name cannot be blank!',
                })
            } else if (phonenumber.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Phone Number cannot be blank!',
                })
            } else if (!pattern.test(phonenumber)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Phone Number!',
                })
            } else {
                $.ajax({
                    url: "controllers/detailsController.php",
                    method: "POST",
                    data: {
                        firstname: firstname,
                        lastname: lastname,
                        phonenumber: phonenumber,
                        addCustomer: true
                    },
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Customer Added Successfully!',
                            }).then((result) => {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    }
                })
            }
        })

        // Edit Customer

        $(document).on("click", ".editCust", function() {
            let id = $(this).attr("data-id");

            $.ajax({
                url: "controllers/detailsController.php",
                method: "POST",
                data: {
                    id: id,
                    editCustomerValue: true
                },
                success: function(data) {
                    let response = JSON.parse(data);

                    console.log(response);

                    $("#editFirstName").val(response.firstName);
                    $("#editLastName").val(response.lastName);
                    $("#editPhoneNumber").val(response.phoneNumber);
                    $("#editId").val(response.id);
                }
            })
        })

        $("#editCustomer").on("submit", function(e) {
            e.preventDefault();

            let firstname = $("#editFirstName").val();
            let lastname = $("#editLastName").val();
            let phonenumber = $("#editPhoneNumber").val();
            let id = $("#editId").val();
            let pattern = /^(09|\+639)\d{9}$/;

            if (firstname.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'First Name cannot be blank!',
                })
            } else if (lastname.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Last Name cannot be blank!',
                })
            } else if (phonenumber.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Phone Number cannot be blank!',
                })
            } else if (!pattern.test(phonenumber)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Phone Number!',
                })
            } else {
                $.ajax({
                    url: "controllers/detailsController.php",
                    method: "POST",
                    data: {
                        firstname: firstname,
                        lastname: lastname,
                        phonenumber: phonenumber,
                        id: id,
                        editCustomer: true
                    },
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Customer Updated Successfully!',
                            }).then((result) => {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    }
                })
            }
        })

        // Add and Edit Employee

        $("#addEmployeeForm").on("submit", function(e) {
            e.preventDefault();

            let firstname = $("#cusFirstName").val();
            let middleName = $("#cusMiddleName").val();
            let lastname = $("#cusLastname").val();
            let gender = $("#cusGender").val();
            let email = $("#cusEmail").val();
            let phonenumber = $("#cusPhoneNumber").val();
            let position = $("#cusPosition").val();
            let FromDate = $("#FromDate").val();
            let address = $("#address").val();
            let province = $("#province option:selected").text();
            let city = $("#city option:selected").text();
            let pattern = /^(09|\+639)\d{9}$/;
            let emailPattern = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;

            if (firstname.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'First Name cannot be blank!',
                })
            } else if (lastname.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Last Name cannot be blank!',
                })
            } else if (gender == null) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gender cannot be blank!',
                })
            } else if (email.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email cannot be blank!',
                })
            } else if (!emailPattern.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Email!',
                })
            } else if (phonenumber.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Phone Number cannot be blank!',
                })
            } else if (!pattern.test(phonenumber)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Phone Number!',
                })
            } else if (position == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Position cannot be blank!',
                })
            } else if (FromDate.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'From Date cannot be blank!',
                })
            } else if (address.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Address cannot be blank!',
                })
            } else if (province == "Select Province") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Province cannot be blank!',
                })
            } else if (city == "Select City / Municipality") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'City cannot be blank!',
                })
            } else {
                $.ajax({
                    url: "controllers/detailsController.php",
                    method: "POST",
                    data: {
                        firstname: firstname,
                        middleName: middleName,
                        lastname: lastname,
                        gender: gender,
                        email: email,
                        phonenumber: phonenumber,
                        position: position,
                        FromDate: FromDate,
                        address: address,
                        province: province,
                        city: city,
                        addEmployee: true
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please wait...',
                            imageUrl: 'https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading()
                            },
                        });
                    },
                    success: function(data) {
                        console.log(data);
                        if (data != false) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Employee Added Successfully!',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    }
                })
            }
        })

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


    window.onload = function() {
        // ---------------
        // basic usage
        // ---------------
        var $ = new City();
        $.showProvinces("#province");
        $.showCities("#city");

        // ------------------
        // additional methods 
        // -------------------

        // will return all provinces 
        console.log($.getProvinces());

        // will return all cities 
        console.log($.getAllCities());

        // will return all cities under specific province (e.g Batangas)
        console.log($.getCities("Batangas"));

    }

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });


    function exportFunction(type) {
        $.ajax({
            url: "controllers/exportController.php",
            method: "GET",
            data: {
                type: type,
                export: true
            },
            success: function(data) {
                console.log(data);
                if (data != false) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Exported Successfully!',
                    }).then((result) => {
                        window.open("controllers/exportController.php?type=" + type + "&export=true", "_blank");
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            }
        })
    }
</script>