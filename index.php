<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('views/includes/head.php'); ?>
</head>

<body class="bg-gradient-primary">

    <?php if (isset($_SESSION['randomId'])) : ?>

        <?php include('controllers/topBarController.php'); ?>

        <?php include('views/includes/modal.php'); ?>

        <?php include('views/includes/sidebar.php'); ?>

        <?php if (!isset($_GET['page'])) : ?>

            <?php include('views/dashboard/dashboard.php'); ?>

        <?php elseif ($_GET['page'] == 1) : ?>

            <?php include('views/pages/customer.php'); ?>

        <?php elseif ($_GET['page'] == 2) : ?>

            <?php include('views/pages/employee.php'); ?>

        <?php elseif ($_GET['page'] == 3) : ?>

            <?php include('views/pages/inventory.php'); ?>

        <?php elseif ($_GET['page'] == 4) : ?>

            <?php include('views/pages/product.php'); ?>

        <?php elseif ($_GET['page'] == 5) : ?>

            <?php include('views/pages/supplier.php'); ?>

        <?php elseif ($_GET['page'] == 6) : ?>

            <?php include('views/pages/transaction.php'); ?>

        <?php elseif ($_GET['page'] == 7) : ?>

            <?php include('views/pages/user.php'); ?>

        <?php elseif ($_GET['page'] == 8) : ?>

            <?php include('views/pages/settings.php'); ?>

        <?php endif; ?>

    <?php else : ?>

        <?php include('views/login/login.php'); ?>

    <?php endif; ?>

    <?php if (isset($_SESSION['randomId'])) : ?>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © 2022. All Rights Reserved.</span>
                </div>
            </div>

            <?php include('views/includes/footer.php'); ?>

        </footer>

    <?php else : ?>

        <footer>
            <?php include('views/includes/footer.php'); ?>
        </footer>

    <?php endif; ?>

</body>

</html>