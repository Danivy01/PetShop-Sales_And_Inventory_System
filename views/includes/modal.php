<script>
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
</script>
<!-- end of Employee select and script -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"><?php echo  $firstName; ?> are you sure do you want to logout?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="controllers/logoutController.php">Logout</a>
      </div>
    </div>
  </div>
</div>
<!-- Customer Modal-->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="cust_transac.php?action=add">
          <div class="form-group">
            <input class="form-control" placeholder="First Name" name="firstname" required>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Last Name" name="lastname" required>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
          </div>
          <hr>
          <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
          <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Customer Modal-->
<div class="modal fade" id="poscustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="cust_pos_trans.php?action=add">
          <div class="form-group">
            <input class="form-control" placeholder="First Name" name="firstname" required>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Last Name" name="lastname" required>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
          </div>
          <hr>
          <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
          <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Employee Modal-->
<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="addEmployeeForm">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" placeholder="First Name" id="firstname">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Middle Name" id="middleName">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Last Name" id="lastname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select class='form-control' id='gender'>
                  <option value="" disabled selected hidden>Select Gender</option>
                  <option value="0">Male</option>
                  <option value="1">Female</option>
                </select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Email" id="email">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Phone Number" id="phonenumber">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select id="position" class="form-control">
                  <option value="" disabled selected hidden>Select Position</option>
                  <?php foreach ($position as $key => $pos) : ?>
                    <option value="<?php echo $pos['id']; ?>"><?php echo $pos['positionName']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input placeholder="Date Hired" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="FromDate" name="hireddate" class="form-control" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <textarea id="address" cols="30" rows="5" class="form-control" placeholder="House/Unit/Flr #, Bldg Name, Blk or Lot #"></textarea>
          </div>
          <div class="form-group">
            <select class="form-control" id="province" placeholder="Province" name="province"></select>
          </div>
          <div class="form-group">
            <select class="form-control" id="city" placeholder="City" name="city"></select>
          </div>
          <hr>
          <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
          <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Delete Modal-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Are you sure do you want to delete?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>
  </div>
</div>
<script>
  $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
  });
</script>