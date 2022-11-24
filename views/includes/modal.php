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
        <form method="post" id="addCustomer">
          <div class="form-group">
            <input class="form-control" placeholder="First Name" id="firstname">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Last Name" id="lastname">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Phone Number" id="phonenumber">
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

<!-- Edit Customer Modal-->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="editCustomer">
          <div class="form-group">
            <input class="form-control" placeholder="First Name" id="editFirstName">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Last Name" id="editLastName">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Phone Number" id="editPhoneNumber">
          </div>
          <input type="hidden" id="editId">
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
                <input class="form-control" placeholder="First Name" id="cusFirstName">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Middle Name" id="cusMiddleName">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Last Name" id="cusLastname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select class='form-control' id='cusGender'>
                  <option value="" disabled selected hidden>Select Gender</option>
                  <option value="0">Male</option>
                  <option value="1">Female</option>
                </select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Email" id="cusEmail">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Phone Number" id="cusPhoneNumber">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select id="cusPosition" class="form-control">
                  <option value="" disabled selected hidden>Select Position</option>
                  <?php foreach ($position as $key => $pos) : ?>
                    <?php echo $pos; ?>
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

<!-- Edit Employee Modal-->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="editEmployeeForm">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" placeholder="First Name" id="cusFirstName">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Middle Name" id="cusMiddleName">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Last Name" id="cusLastname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select class='form-control' id='cusGender'>
                  <option value="" disabled selected hidden>Select Gender</option>
                  <option value="0">Male</option>
                  <option value="1">Female</option>
                </select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Email" id="cusEmail">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Phone Number" id="cusPhoneNumber">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select id="cusPosition" class="form-control">
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

<!-- Product Modal-->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="addProductForm">
              <div class="form-group">
                <input class="form-control" placeholder="Product Code" id="prodCode">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Product Name" id="prodName">
              </div>
              <div class="form-group">
                <textarea cols="30" rows="5" class="form-control" placeholder="Description" id="prodDescription"></textarea>
              </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input placeholder="Date Stock In" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="FromDate" name="hireddate" class="form-control" />
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="On Hand" id="prodOnHand">
              </div>
            </div>
              <div class="form-group">
                <input class="form-control" placeholder="Price" id="prodPrice">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Quantity Stock" id="prodQtyStock">
              </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select id="cusPosition" class="form-control">
                  <option value="" disabled selected hidden>Select Category</option>
                  <?php foreach ($position as $key => $pos) : ?>
                    <?php echo $pos; ?>
                    <option value="<?php echo $pos['id']; ?>"><?php echo $pos['positionName']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
              <div class="form-group">
                <select class='form-control' id='prodSupplier'>
                  <option value="" disabled selected hidden>Select Supplier</option>
                  <option value="0">Male</option>
                  <option value="1">Female</option>
                </select>
              </div>
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