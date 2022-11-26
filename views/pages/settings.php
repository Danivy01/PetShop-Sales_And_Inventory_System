<div class="card shadow mb-4 col-xs-12 col-md-12 border-bottom-primary">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Edit Account Info</h4>
    </div>
    <div class="card-body">


        <form method="post" id="editSettings">
            <input type="hidden" id="setid" value="<?php echo $_GET['id']; ?>" />
            <input type="hidden" id="randomId" value="<?php echo $_SESSION['randomId']; ?>" />

            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    First Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="First Name" id="setfirstname" value="<?php echo $settings[0]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Middle Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Middle Name" id="setmiddlename" value="<?php echo $settings[11]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Last Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Last Name" id="setlastname" value="<?php echo $settings[1]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Gender:
                </div>
                <div class="col-sm-9">
                    <select class='form-control' id='setgender'>
                        <option value="" disabled selected hidden>Select Gender</option>
                        <option value="Male" <?php if ($settings[2] == 0) echo "selected"; ?>>Male</option>
                        <option value="Female" <?php if ($settings[2] == 1) echo "selected"; ?>>Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Username:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Username" id="setusername" value="<?php echo $settings[9]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Password:
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control" placeholder="Password" id="setpassword" value="<?php echo $settings[10]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Email:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Email" id="setemail" value="<?php echo $settings[3]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Contact #:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Contact #" id="setphone" value="<?php echo $settings[4]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Hired Date:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Hired Date" id="sethireddate" value="<?php echo $settings[5]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Address:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Address" id="setaddress" value="<?php echo $settings[6]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    Province:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="Province" id="setprovince" value="<?php echo $settings[7]; ?>">
                </div>
            </div>
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                    City / Municipality:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="City / Municipality" id="setcity" value="<?php echo $settings[8]; ?>">
                </div>
            </div>
            <hr>

            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-edit fa-fw"></i>Update</button>
        </form>
    </div>
</div>