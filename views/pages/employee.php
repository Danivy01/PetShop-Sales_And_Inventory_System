<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Employee</h4>
        <div class="float-right">
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-lg fa-fw text-blue-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Employee Options:</div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#employeeModal">
                        Add Employee <i class="fas fa-fw fa-plus text-gray-400"></i>
                    </a>
                    <button type="button" class="dropdown-item" onclick="exportFunction('employeeExcel')">Export to Excel</button>

                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="employeeTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">First Name</th>
                        <th class="text-center">Middle Name</th>
                        <th class="text-center">Last Name</th>
                        <th class="text-center">Position</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $employeeTable; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>