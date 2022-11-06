<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Employee&nbsp;<a href="#" data-toggle="modal" data-target="#employeeModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
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