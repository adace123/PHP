<!DOCTYPE html>
<html>
    <?php require_once('./header.php') ?>
    <body>
        <div class="container text-left">
            <div class="row">
                <div class="col md-12 mt-4">
                    <h2>Thank you for purchasing <?php echo $_GET['product']; ?></h2>
                </div>
            </div>
            <hr />
            <p>Your transaction ID is <?php echo $_GET['tid']; ?></p>
            <p>Check your email for more info.</p>
            <a href="index.php" class="btn btn-outline-primary">Go Back</a>
        </div>
    </body>
</html>
