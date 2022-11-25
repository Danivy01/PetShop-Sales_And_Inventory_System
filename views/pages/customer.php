<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Customer</h4>
        <div class="float-right">
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-lg fa-fw text-blue-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Customer Options:</div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#customerModal">
                        Add Customer <i class="fas fa-fw fa-plus text-gray-400"></i>
                    </a>
                    <button type="button" class="dropdown-item" onclick="exportFunction('customerExcel')">Export to Excel</button>

                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="customerTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">First Name</th>
                        <th class="text-center">Last Name</th>
                        <th class="text-center">Phone Number</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $customerTable; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>