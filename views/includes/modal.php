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
          <input type="hidden" id="editIdEmp">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" placeholder="First Name" id="editCusFirstName">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Middle Name" id="editCusMiddleName">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Last Name" id="editCusLastname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select class='form-control' id='editCusGender'>
                  <option value="" disabled selected hidden>Select Gender</option>
                  <option value="0">Male</option>
                  <option value="1">Female</option>
                </select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Email" id="editCusEmail">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Phone Number" id="editCusPhoneNumber">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select id="editCusPosition" class="form-control">
                  <option value="" disabled selected hidden>Select Position</option>
                  <?php foreach ($position as $key => $pos) : ?>
                    <option value="<?php echo $pos['id']; ?>"><?php echo $pos['positionName']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input placeholder="Date Hired" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="editFromDate" name="hireddate" class="form-control" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <textarea id="editAddress" cols="30" rows="5" class="form-control" placeholder="House/Unit/Flr #, Bldg Name, Blk or Lot #"></textarea>
          </div>
          <div class="form-group">
            <input class="form-control" id="editProvince" placeholder="Province" name="province"></input>
          </div>
          <div class="form-group">
            <input class="form-control" id="editCity" placeholder="City" name="city"></input>
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

<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="addUser">
          <div class="form-group">
            <select class='form-control' id='selectUser'>
              <?php print_r($noAccounts); ?>
              <option value="" disabled selected hidden>Select User</option>
              <?php if (count($noAccounts) > 0) : ?>
                <?php foreach ($noAccounts as $key => $acc) : ?>
                  <option value="<?php echo $acc['id']; ?>"><?php echo $acc['fullName']; ?></option>
                <?php endforeach; ?>
              <?php else : ?>
                <option value="" disabled selected hidden>No Employee Available</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="form-group">
            <select class='form-control' id='selectType'>
              <option value="" disabled selected hidden>Select User Type</option>
              <?php foreach ($accessFields as $key => $access) : ?>
                <option value="<?php echo $access['id']; ?>"><?php echo $access['type']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" id="userName">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" id="password">
              </div>
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

<!-- User Admin Modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="updateAdmin">
          <input type="hidden" id="editAdminId">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Full Name" id="adminFullName" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Type" id="adminType" readonly>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" id="adminEditUserName">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" id="adminEditPassword">
              </div>
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

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="updateUser">
          <input type="hidden" id="editUserId">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Full Name" id="userFullName" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Type" id="userType" readonly>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" id="editUserName">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" id="editPassword">
              </div>
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

<!-- Supplier Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="addSupplier">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Company Name" id="companyName">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Phone Number" id="companyPhone">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select class="form-control" id="supplierProvince" placeholder="Province" name="province"></select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select class="form-control" id="supplierCity" placeholder="City" name="city"></select>
              </div>
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

<!-- Update Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Supplier</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="updateSupplier">
          <input type="hidden" id="supplierEditId">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Company Name" id="editCompanyName">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Phone Number" id="editCompanyPhone">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" id="editSupplierProvince" placeholder="Province" name="province"></input>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" id="editSupplierCity" placeholder="City" name="city"></input>
              </div>
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

<!-- Product Modal -->

<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product/Category</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="productForm">
          <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs mb-3" role="tablist" style="gap: 2rem;">
              <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab" id="categoryTab">Add Category</a>

              </li>
              <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab" id="productTab">Add Product</a>

              </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active mr-5" id="uploadTab">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Category Name" id="categoryName">
                </div>
                <div class="form-group">
                  <select class="form-control" id="categoryStatus" placeholder="Status">
                    <option value="" disabled hidden selected>Select Category Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="browseTab">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Product Code" id="productCode" value="<?php echo $productCode; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Product Name" id="productName">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <select class="form-control" id="categorySelect" placeholder="Select Category">
                    <option value="" disabled selected hidden>Select Category</option>
                    <?php if (count($selectCategory) > 0) : ?>
                      <?php foreach ($selectCategory as $key => $cat) : ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoryName']; ?></option>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <option value="" disabled selected hidden>No Category Available</option>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" id="supplierSelect" placeholder="Select Supplier">
                    <option value="" disabled selected hidden>Select Supplier</option>
                    <?php if (count($selectSupplier) > 0) : ?>
                      <?php foreach ($selectSupplier as $key => $sup) : ?>
                        <option value="<?php echo $sup['supplier_id']; ?>"><?php echo $sup['companyName']; ?></option>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <option value="" disabled selected hidden>No Supplier Available</option>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="productDescription" placeholder="Product Description"></textarea>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="number" class="form-control" id="stock" min="1" placeholder="On Stock"></input>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="number" class="form-control" id="onHand" min="1" placeholder="On Hand"></input>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="number" class="form-control" id="price" min="1" placeholder="Price"></input>
                    </div>
                  </div>
                </div>
              </div>
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

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="CategoryModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Categories</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Category Name</th>
              <th class="text-center">Status</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $categoryTable; ?>
          </tbody>
        </table>
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