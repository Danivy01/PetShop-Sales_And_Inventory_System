<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('views/includes/head.php'); ?>
</head>

<body class="bg-gradient-primary">

    <?php if (isset($_SESSION['randomId'])) : ?>
        <?php include('views/dashboard/dashboard.php'); ?>
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