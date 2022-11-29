<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Transaction&nbsp;<a href="#" data-toggle="modal" data-target="#transactionModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
        <div class="float-right">
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-lg fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Export Options:</div>
                    <button type="button" class="dropdown-item" onclick="exportFunction('transactionExcel')">Export to Excel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="transactionTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="19%" class="text-center">Transaction Number</th>
                        <th class="text-center">Customer</th>
                        <th width="13%" class="text-center"># of Items</th>
                        <th width="20%" class="text-center">Transaction Date</th>
                        <th width="11%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $transactionTable; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>