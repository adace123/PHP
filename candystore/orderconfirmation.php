<head>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Confirm Your Order</title>
</head>
<style>
body{background-repeat:no-repeat;background-size:cover;background-image:url('../candy_images/candies.jpg');background-color:#d1c4e9}
.container{margin-top:8%;text-align:center;font-size:24px;}
nav{letter-spacing:8px;}
.collection{border:5px solid purple}
button{background-image:url('../candy_images/jellies.jpg');background-size:cover;font-weight:bold;}
#back{background-image:url('../candy_images/candies2.jpg');background-size:cover;font-weight:bold;}
</style>
<body>
<nav>
    <div class="nav-wrapper">
      <a href="orderform.php" class="brand-logo center" style="font-family:'Fredericka the Great';color:#ffeb3b">The Sweet Treats Store</a>    
    </div>
  </nav>
  <div class="container">
    <div class="row">
        <div class="col s12" id="col">
        <?php $action = $_SERVER['PHP_SELF']; ?>
        <?php if(!(isset($_POST['submit']))) {?>
        <form action="<?php echo $action; ?>" method="post">
           <div class="card-panel purple lighten-4">
            <h2>Your Order Is:</h2>
        </div>
            <ul class="collection">
                 <?php
                 session_start();
                foreach($_POST as $name => $field){
                    if($field > 0){
                        $_SESSION[$name] = $field;
                    }
                }

                foreach($_SESSION as $name => $field){
                    if($name != "total")
                    echo "<li class='collection-item'>".ucfirst(str_replace("_"," ",$name)). ": ". $field ."</li>";
                }
                 echo "<li class='collection-item'><h2><strong>Total: <div style='display:inline-block;color:#ef5350;'>$".$_SESSION['total']."</div></strong></h2></li>";
                  ?>
            </ul>
            <a id="back" href="orderform.php" class="btn waves-effect waves-light btn-large">Go Back 
                <i class="material-icons right">fast_rewind</i>
                </a>
           <button class="btn waves-effect waves-light btn-large" name="submit" type="submit">Complete Your Order 
                <i class="material-icons right">done</i>
                </button>
        </form>
        <?php 
            } else{
            session_start();
            session_destroy();
            $_SESSION = array(); 
            echo "<h1>Thank you! Your order has been submitted!</h1>";
        }
        ?>
        </div>
    </div>
  </div>
</body>
