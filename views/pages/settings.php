<div class="card shadow mb-4 col-xs-12 col-md-12 border-bottom-primary">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Edit Account Info</h4>
    </div>
    <div class="card-body">


        <form role="form" method="post" action="settings_edit.php">
            <input type="hidden" name="id" value="<?php echo $zz; ?>" />

            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    First Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="First Name" name="firstname" value="<?php echo $a; ?>" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Last Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Last Name" name="lastname" value="<?php echo $b; ?>" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Gender:
                </div>
                <div class="col-sm-9">
                    <select class='form-control' name='gender' required>
                        <option value="" disabled selected hidden>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Username:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Username" name="username" value="<?php echo $d; ?>" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Password:
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control" placeholder="Password" name="password" value="" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Email:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Email" name="email" value="<?php echo $f; ?>" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Contact #:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Contact #" name="phone" value="<?php echo $g; ?>" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Role:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Role" name="role" value="<?php echo $h; ?>" readonly>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Hired Date:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Hired Date" name="hireddate" value="<?php echo $i; ?>" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Province:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Province" name="province" value="<?php echo $j; ?>" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    City / Municipality:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="City / Municipality" name="city" value="<?php echo $k; ?>" required>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Account Type:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Account Type" name="type" value="<?php echo $l; ?>" readonly>
                </div>
            </div>
            <hr>

            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-edit fa-fw"></i>Update</button>
        </form>
    </div>
</div>