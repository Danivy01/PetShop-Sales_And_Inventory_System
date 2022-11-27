<!-- ADMIN TABLE -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Admin Account(s)</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="adminTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $adminTable; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">User Accounts&nbsp;<a href="#" data-toggle="modal" data-target="#userModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="usersTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $userTable; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>