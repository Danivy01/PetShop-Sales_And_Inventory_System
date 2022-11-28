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

            let supplierTable = $("#supplierTable").DataTable({
                processing: true,
                columnDefs: [],

                scrollCollapse: false,
                scroller: {
                    loadingIndicator: true,
                },
                stateSave: false,
            });

            let productTable = $("#productTable").DataTable({
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

        $(".editEmp").on("click", function() {
            let id = $(this).attr("data-id");

            $.ajax({
                url: "controllers/detailsController.php",
                method: "POST",
                data: {
                    id: id,
                    getEmp: true
                },
                success: function(data) {
                    let customer = JSON.parse(data);
                    $("#editIdEmp").val(id);
                    $("#editCusFirstName").val(customer.firstName);
                    $("#editCusMiddleName").val(customer.middleName);
                    $("#editCusLastname").val(customer.lastName);
                    $("#editCusGender").val(customer.gender);
                    $("#editCusEmail").val(customer.email);
                    $("#editCusPhoneNumber").val(customer.phonenumber);
                    $("#editCusPosition").val(customer.position);
                    $("#editFromDate").val(customer.fromdate);
                    $("#editAddress").text(customer.address);
                    $("#editProvince").val(customer.province);
                    $("#editCity").val(customer.city);
                }
            })
        })

        $("#editEmployeeForm").on("submit", function(e) {
            e.preventDefault();

            let firstname = $("#editCusFirstName").val();
            let middleName = $("#editCusMiddleName").val();
            let lastname = $("#editCusLastname").val();
            let gender = $("#editCusGender").val();
            let email = $("#editCusEmail").val();
            let phonenumber = $("#editCusPhoneNumber").val();
            let position = $("#editCusPosition").val();
            let FromDate = $("#editFromDate").val();
            let address = $("#editAddress").val();
            let province = $("#editProvince").val();
            let city = $("#editCity").val();
            let editIdEmp = $("#editIdEmp").val();

            let pattern = /^(09|\+639)\d{9}$/;
            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

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
            } else if (province.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Province cannot be blank!',
                })
            } else if (city.trim() == "") {
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
                        editIdEmp: editIdEmp,
                        editEmployee: true
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
                                text: 'Employee Updated Successfully!',
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

        // User Settings

        $("#editSettings").on("submit", function(e) {
            e.preventDefault();

            let id = $("#setid").val();
            let randomId = $("#randomId").val();
            let firstname = $("#setfirstname").val();
            let middlename = $("#setmiddlename").val();
            let lastname = $("#setlastname").val();
            let gender = $("#setgender").val();
            let username = $("#setusername").val();
            let password = $("#setpassword").val();
            let email = $("#setemail").val();
            let phone = $("#setphone").val();
            let hireddate = $("#sethireddate").val();
            let address = $("#setaddress").val();
            let province = $("#setprovince").val();
            let city = $("#setcity").val();

            let pattern = /^(09|\+639)\d{9}$/;
            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

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
            } else if (phone.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Phone Number cannot be blank!',
                })
            } else if (!pattern.test(phone)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Phone Number!',
                })
            } else if (hireddate.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hired Date cannot be blank!',
                })
            } else if (address.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Address cannot be blank!',
                })
            } else if (province.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Province cannot be blank!',
                })
            } else if (city.trim() == "") {
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
                        id: id,
                        randomId: randomId,
                        firstname: firstname,
                        middlename: middlename,
                        lastname: lastname,
                        gender: gender,
                        username: username,
                        password: password,
                        email: email,
                        phone: phone,
                        hireddate: hireddate,
                        address: address,
                        province: province,
                        city: city,
                        editSettings: true
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
                                text: 'Settings Updated Successfully!',
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

        // Accounts Page

        $("#addUser").on("submit", function(e) {
            e.preventDefault();

            let selectUser = $("#selectUser").val();
            let selectType = $("#selectType").val();
            let userName = $("#userName").val();
            let password = $("#password").val();

            if (selectUser == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a user!',
                })
            } else if (selectType == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a type!',
                })
            } else if (userName.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username cannot be blank!',
                })
            } else if (password.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password cannot be blank!',
                })
            } else {
                $.ajax({
                    url: "controllers/detailsController.php",
                    method: "POST",
                    data: {
                        selectUser: selectUser,
                        selectType: selectType,
                        userName: userName,
                        password: password,
                        addUser: true
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
                                text: 'User Added Successfully!',
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

        $(".editAdmin").on("click", function() {
            let id = $(this).attr("data-id");

            $.ajax({
                url: "controllers/detailsController.php",
                method: "POST",
                data: {
                    id: id,
                    editAdminModal: true
                },
                success: function(data) {
                    console.log(data);
                    if (data != false) {
                        let user = JSON.parse(data);
                        $("#adminFullName").val(user.fullName);
                        $("#adminType").val(user.type);
                        $("#adminEditUserName").val(user.username);
                        $("#adminEditPassword").val(user.password);
                        $("#editAdminId").val(user.id);
                    }
                }
            })
        })

        $(".editUser").on("click", function() {
            let id = $(this).attr("data-id");

            $.ajax({
                url: "controllers/detailsController.php",
                method: "POST",
                data: {
                    id: id,
                    editUserModal: true
                },
                success: function(data) {
                    console.log(data);
                    if (data != false) {
                        let user = JSON.parse(data);
                        $("#userFullName").val(user.fullName);
                        $("#userType").val(user.type);
                        $("#editUserName").val(user.username);
                        $("#editPassword").val(user.password);
                        $("#editUserId").val(user.id);
                    }
                }
            })
        })

        $("#updateAdmin").on("submit", function(e) {
            e.preventDefault();

            let editId = $("#editAdminId").val();
            let editUserName = $("#adminEditUserName").val();
            let editPassword = $("#adminEditPassword").val();

            if (editUserName.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username cannot be blank!',
                })
            } else if (editPassword.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password cannot be blank!',
                })
            } else {
                $.ajax({
                    url: "controllers/detailsController.php",
                    method: "POST",
                    data: {
                        editId: editId,
                        editUserName: editUserName,
                        editPassword: editPassword,
                        updateUser: true
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
                                text: 'User Updated Successfully!',
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

        $("#updateUser").on("submit", function(e) {
            e.preventDefault();

            let editId = $("#editUserId").val();

            if (editId == "" || editId == null) {
                editId = $("#editAdminId").val();
            }

            let editUserName = $("#editUserName").val();
            let editPassword = $("#editPassword").val();

            if (editUserName.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username cannot be blank!',
                })
            } else if (editPassword.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password cannot be blank!',
                })
            } else {
                $.ajax({
                    url: "controllers/detailsController.php",
                    method: "POST",
                    data: {
                        editId: editId,
                        editUserName: editUserName,
                        editPassword: editPassword,
                        updateUser: true
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
                                text: 'User Updated Successfully!',
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

        function deleteUser(id) {
            Swal.fire({
                title: 'Delete User?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "controllers/detailsController.php",
                        method: "POST",
                        data: {
                            id: id,
                            deleteUser: true
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
                                    text: 'User Deleted Successfully!',
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
        }

        // Supplier Page

        $("#addSupplier").on("submit", function(e) {
            e.preventDefault();

            let companyName = $("#companyName").val();
            let companyPhone = $("#companyPhone").val();
            let supplierProvince = $("#supplierProvince option:selected").text();
            let supplierCity = $("#supplierCity option:selected").text();

            let pattern = /^(09|\+639)\d{9}$/;

            if (companyName.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Company Name cannot be blank!',
                })
            } else if (companyPhone.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Company Phone cannot be blank!',
                })
            } else if (!pattern.test(companyPhone)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Phone Number!',
                })
            } else if (supplierProvince.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Province cannot be blank!',
                })
            } else if (supplierCity.trim() == "") {
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
                        companyName: companyName,
                        companyPhone: companyPhone,
                        supplierProvince: supplierProvince,
                        supplierCity: supplierCity,
                        addSupplier: true
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
                                text: 'Supplier Added Successfully!',
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

        $(".editSupplier").on("click", function() {
            let id = $(this).attr("data-id");

            $.ajax({
                url: "controllers/detailsController.php",
                method: "POST",
                data: {
                    id: id,
                    getSupplier: true
                },
                success: function(data) {
                    console.log(data);
                    if (data != false) {
                        let supplier = JSON.parse(data);
                        $("#supplierEditId").val(supplier.id);
                        $("#editCompanyName").val(supplier.companyName);
                        $("#editCompanyPhone").val(supplier.companyPhone);
                        $("#editSupplierProvince").val(supplier.province);
                        $("#editSupplierCity ").val(supplier.city);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                }
            })
        })

        $("#updateSupplier").on("submit", function(e) {
            e.preventDefault();

            let supplierEditId = $("#supplierEditId").val();
            let editCompanyName = $("#editCompanyName").val();
            let editCompanyPhone = $("#editCompanyPhone").val();
            let editSupplierProvince = $("#editSupplierProvince").val();
            let editSupplierCity = $("#editSupplierCity").val();

            let pattern = /^(09|\+639)\d{9}$/;

            if (editCompanyName.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Company Name cannot be blank!',
                })
            } else if (editCompanyPhone.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Company Phone cannot be blank!',
                })
            } else if (!pattern.test(editCompanyPhone)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Phone Number!',
                })
            } else if (editSupplierProvince.trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Province cannot be blank!',
                })
            } else if (editSupplierCity.trim() == "") {
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
                        supplierEditId: supplierEditId,
                        editCompanyName: editCompanyName,
                        editCompanyPhone: editCompanyPhone,
                        editSupplierProvince: editSupplierProvince,
                        editSupplierCity: editSupplierCity,
                        updateSupplier: true
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
                                text: 'Supplier Updated Successfully!',
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

        function deleteSupplier(id) {
            Swal.fire({
                title: 'Delete Supplier?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "controllers/detailsController.php",
                        method: "POST",
                        data: {
                            id: id,
                            deleteSupplier: true
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
                                    text: 'Supplier Deleted Successfully!',
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
        }

        let activeTab = "category";

        $("#categoryTab").on("click", function() {
            activeTab = "category";
        })

        $("#productTab").on("click", function() {
            activeTab = "product";
        })

        $("#productForm").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let text = "";

            if (activeTab == "category") {
                let categoryName = $("#categoryName").val();
                let categoryStatus = $("#categoryStatus").val();

                text = "Category";

                if (categoryName.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Category Name cannot be blank!',
                    })

                    return false;
                } else if (categoryStatus.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Category Status cannot be blank!',
                    })

                    return false;
                }

                formData.append("categoryName", categoryName);
                formData.append("categoryStatus", categoryStatus);
                formData.append("addCategory", true);

            } else if (activeTab == "product") {
                let productCode = $("#productCode").val();
                let productName = $("#productName").val();
                let categorySelect = $("#categorySelect").val();
                let productDescription = $("#productDescription").val();
                let stock = $("#stock").val();
                let onHand = $("#onHand").val();
                let price = $("#price").val();
                let supplierSelect = $("#supplierSelect").val();

                text = "Product";

                if (productCode.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Product Code cannot be blank!',
                    })

                    return false;
                } else if (productName.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Product Name cannot be blank!',
                    })

                    return false;
                } else if (categorySelect.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Category cannot be blank!',
                    })

                    return false;
                } else if (productDescription.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Product Description cannot be blank!',
                    })

                    return false;
                } else if (stock.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Stock cannot be blank!',
                    })

                    return false;
                } else if (onHand.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'On Hand cannot be blank!',
                    })

                    return false;
                } else if (price.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Price cannot be blank!',
                    })

                    return false;
                } else if (supplierSelect.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Supplier cannot be blank!',
                    })

                    return false;
                }

                formData.append("productCode", productCode);
                formData.append("productName", productName);
                formData.append("categorySelect", categorySelect);
                formData.append("productDescription", productDescription);
                formData.append("stock", stock);
                formData.append("onHand", onHand);
                formData.append("price", price);
                formData.append("supplierSelect", supplierSelect);
                formData.append("addProduct", true);
            }

            $.ajax({
                url: "controllers/detailsController.php",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
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
                            text: text + ' Added Successfully!',
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
        $.showProvinces("#supplierProvince");
        $.showCities("#supplierCity");

        // ------------------
        // additional methods 
        // -------------------

        // will return all provinces 
        // console.log($.getProvinces());

        // will return all cities 
        // console.log($.getAllCities());

        // will return all cities under specific province (e.g Batangas)
        // console.log($.getCities("Batangas"));

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