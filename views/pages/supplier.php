<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Supplier&nbsp;<a href="#" data-toggle="modal" data-target="#supplierModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
        <div class="float-right">
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-lg fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Export Options:</div>
                    <button type="button" class="dropdown-item" onclick="exportFunction('supplierExcel')">Export to Excel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="supplierTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Company Name</th>
                        <th class="text-center">Province</th>
                        <th class="text-center">City</th>
                        <th class="text-center">Phone Number</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $supplierTable; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>