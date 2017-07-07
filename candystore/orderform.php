<head>
    <title>Order Form</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<style>
.card{border-radius:10px;}
::-webkit-input-placeholder {color:black;}
nav{letter-spacing:8px;}
body{background-repeat:no-repeat;background-size:cover;background-image:url('../candystore/candy_images/candies.jpg');background-color:#d1c4e9}
button{background-image:url('candyimages/jellies.jpg');background-size:cover;font-weight:bold;}
</style>
<body>
<?php
session_start();
?>
 <nav>
    <div class="nav-wrapper">
      <a href="orderform.php" class="brand-logo center" style="font-family:'Fredericka the Great';color:#ffff00 ">The Sweet Treats Store</a>    
    </div>
  </nav>
  
  <div id="order-form" class="container">
  <form method="post" action="order_confirmation.php">
      <div class="row">     
          <div class="col s4">
              <div class="card hoverable">
                    <div class="card-image">
                        <img src="candyimages/chocolates.jpg">
                    </div>
                    <div style="background-color:#f48fb1" class="card-content">
                        <span><h6>Assorted chocolates <strong style="float:right;border:2px solid white;border-radius:25px;background-color:white">$19.99 each</strong></h6></span>
                        <br>
                         <input data-price="19.99" @input="changeItem" type="number" name="chocolate assortment" placeholder="How many boxes would you like?">
                    </div>
              </div>
          </div>
          
            <div class="col s4">
              <div class="card hoverable">
                    <div class="card-image">
                        <img src="candyimages/cookies.jpg">
                    </div>
                    <div style="background-color:#ce93d8" class="card-content">
                        <span><h6>Colorful cookies <strong style="float:right;border:2px solid white;border-radius:25px;background-color:white">$9.99 each</strong></h6></span>
                        <br>
                         <input data-price="9.99" @input="changeItem" type="number" name="cookies" placeholder="How many boxes would you like?">
                    </div>
              </div>
          </div>
          <div class="col s4">
              <div class="card hoverable">
                    <div class="card-image">
                        <img src="candyimages/corn.jpg">
                    </div>
                    <div style="background-color:#ffab91 " class="card-content">
                        <span><h6>Candy corn <strong style="float:right;border:2px solid white;border-radius:25px;background-color:white">$7.99 each</strong></h6></span>
                        <br>
                       <input data-price="7.99" @input="changeItem" type="number" name="candy corn" placeholder="How many boxes would you like?">
                    </div>
              </div>
          </div>
       <!-- end of row -->  </div>
           <div class="row">
               <div class="col s4">
              <div class="card hoverable">
                    <div class="card-image">
                        <img src="candyimages/crunch.jpg">
                    </div>
                    <div style="background-color:#bcaaa4" class="card-content">
                        <span><h6>Chocolate crunch <strong style="float:right;border:2px solid white;border-radius:25px;background-color:white">$11.99 each</strong></h6></span>
                        <br>
                         <input data-price="11.99" @input="changeItem" type="number" name="chocolate crunch" placeholder="How many boxes would you like?">
                    </div>
              </div>
          </div>
          <div class="col s4">
              <div class="card hoverable">
                    <div class="card-image">
                        <img src="candyimages/gummies.jpg">
                    </div>
                    <div style="background-color:#64ffda" class="card-content">
                        <span><h6>Gummy bears <strong style="float:right;border:2px solid white;border-radius:25px;background-color:white">$6.99 each</strong></h6></span>
                        <br>
                         <input data-price="6.99" @input="changeItem" type="number" name="gummy bears" placeholder="How many boxes would you like?">
                    </div>
              </div>
          </div>
          <div class="col s4">
              <div class="card hoverable">
                    <div class="card-image">
                        <img src="candyimages/suckers.jpg">
                    </div>
                    <div style="background-color:#fff9c4" class="card-content">
                        <span><h6>Candy suckers <strong style="float:right;border:2px solid white;border-radius:25px;background-color:white">$8.99 each</strong></h6></span>
                        <br>
                        <input data-price="8.99" @input="changeItem" type="number" name="candy suckers" placeholder="How many boxes would you like?">
                    </div>
              </div>
          </div>
           </div>
           <div class="row">
            <div class="col s12 center-align" id="total">
                <h3>${{total.toFixed(2)}}<span v-if="total>0"> + ${{tax.toFixed(2)}} tax = <div style="color:red;display:inline-block;">${{getTotal}} total</div></span></h3>
               <input type="hidden" :value="getTotal" name="total">
               <button :disabled="total === 0" class="btn waves-effect waves-light btn-large" type="submit">Continue 
                <i class="material-icons right">trending_flat</i>
                </button>
            </div>
           </div>   
       </form>  
  </div>
    <script>
    new Vue({
        el: '#order-form',
        data:{
            total:0,
            tax: 0
        },
        methods:{
            changeItem(){           
                this.total = 0;
                this.tax = 0;
                for(var i=0;i<$("input[type!='hidden']").length;i++){
                        this.total += $("input[type!='hidden']")[i].value * $("input[type!='hidden']")[i].dataset.price;
                        this.tax = this.total * .0925;   
                    }
                    window.location = "#total";
                }
            },
        computed:{
            getTotal(){
                return (this.total + this.tax).toFixed(2);
            }
        }
    });
    </script>
</body>
