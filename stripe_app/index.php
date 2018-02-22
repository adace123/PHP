<!DOCTYPE html>
<html>
    <?php require_once('header.php') ?>
    <style type="text/css">
        .form-control {
            border-top: 0;
            border-right: 0;
            border-left: 0;
        }
        button {
            width: 100%;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
    <body>
        <div class="container mt-4 text-center">
            <div class="row">
                <div class="col md-12">
                    <h3>Intro To React Course [$50 USD]</h3>
                    <form class="mt-4" id="payment-form" method="post" action="charge.php">
                        <div class="form-group">
                            <input name="first_name" class="form-control" id="first_name" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <div id="card-element"></div>
                            <div id="card-errors"></div>
                        </div>
                        <input type="hidden" name="amount" value="50"/>
                        <input type="hidden" name="product" value="Intro To React Course" />
                        <button type="submit" class="btn btn-primary">Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="charge.js">
            
        </script>
    </body>
</html>
