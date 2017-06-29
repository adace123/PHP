<html>
	<title>Package Form</title>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css"/>
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style>
		.center{text-align:center;}
		label{font-weight: 800; font-size:24px !important}
		.form-section{padding:5px;margin:5px;background-color:#f5f5f5;background:none;}
		a{font-weight:800;position:fixed;}
		.container{width:40%;}
		body{background-image:url('plane.jpg');background-repeat:no-repeat;background-size:cover;}
		#from label, #from input{color:#ff9800}
		#to label, #to input{color:#4caf50}
		#dimensions label, #dimensions input{color:#9c27b0}
	</style>
<?php
ob_start();
   function print_form(){
       $action = $_SERVER['PHP_SELF'];
       echo <<<EOT
       <body class='cyan'>
          <script>
          $(document).ready(function(){
             $('#from').fadeIn("slow");
          });
          </script>
    <nav style='background:none'>
    
      <a style='font-family:Pacifico;font-size:32px;letter-spacing:12px;' class='brand-logo center deep-purple-text text-accent-1'>Enter Your Package Details</a>
  </nav>
    <div class='container'>
       <?php
           if(any_errors()){
               print_r(validate_form());
           }
        ?>
    
    <form class='col s12' method='post' action="$action">

      <div style='margin-top:8%;' class='form-section hoverable' id='from'>
        <h4 class="center orange-text">FROM</h4>
      <div style='margin-top:8%;' class="row">
        <div class="input-field col s6">
          <input name="street[0]" id="street[0]" required>
          <label class="active" for="street[0]">Street</label>
        </div> 
        <div class="input-field col s6">
          <input name="city[0]" id="city[0]" required>
          <label class="active" for="city[0]">City</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="state[0]" id="state[0]" required>
          <label class="active" for="state[0]">State</label>
        </div>
        <div class="input-field col s6">
          <input name="zip[0]" id="zip[0]"  required>
          <label class="active" for="zip[0]">Zip</label>
        </div>
      </div><br></div>
        
      <div class="form-section hoverable" id='to'>
        <h4 class="center green-text" style='margin-bottom:5%;'>TO</h4>
        <div class="row">
            <div class="input-field col s6">
          <input name="street[1]" id="street[1]" type="text"  required>
          <label class="active" for="street[1]">Street</label>
        </div> 
        <div class="input-field col s6">
          <input name="city[1]" id="city[1]" type="text"  required>
          <label class="active" for="city[1]">City</label>
        </div>
        </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="state[1]" id="state[1]" required>
          <label class="active" for="state[1]">State</label>
        </div>
        <div class="input-field col s6">
          <input name="zip[1]" id="zip[1]"  required>
          <label class="active" for="zip[1]">Zip</label>
        </div>
      </div>
      <br>
        </div>
        
      <div class="form-section hoverable" id='dimensions'>
        <h4 class="center purple-text" style='margin-bottom:5%;'>DIMENSIONS</h4>
      <div class="row">
        <div class="input-field col s3">
            <input type="number" step="0.01" name="length" id="length" required>
            <label class="active" for="length">Length (in.)</label>
        </div>
        <div class="input-field col s3">
            <input type="number" step="0.01" name="width" id="width" required>
            <label class="active" for="width">Width (in.)</label>
        </div>
        <div class="input-field col s3">
            <input type="number" step="0.01" name="height" id="height" required>
            <label class="active" for="height">Height (in.)</label>
        </div>
        <div class="input-field col s3">
            <input type="number" step="0.01" name="weight" id="weight" required>
            <label class="active" for="weight">Weight (lbs.)</label>
        </div>
      </div>
      </div>
      
        <br>
        <div class="center">
            <button style='background:linear-gradient(to right,#7b1fa2,#651fff )' class="align-center btn-large btn waves-effect waves-light" id="submit" type="submit" name="submit">Submit
    <i class="material-icons right">done</i>
  </button>
        </div>
  
    </form>
  
        </div>
      
    </body>
EOT;
   }
   print_form();
   process_form();
   
   function process_form(){
       if(isset($_POST['submit']))
      {  //make form fields safe
         $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //no errors = render same page with success template
          if(!any_errors()){
              echo "
              
              <script>
              $('body').empty();
              $('body').removeClass('cyan');
              $('body').addClass('blue-grey');
              $('body').addClass('lighten-3');
              $('body').css('background-image','url(mountains.png)');
              $('body').css('background-repeat','no-repeat');
              $('body').css('background-size','cover');
              
              </script>";
               echo "<div class='container'>
                 <div class='row'>
                 <div class='col s12'>";
                    echo "<div style='background:none' class='center-align card'>
                    <div class='card-content yellow-text text-accent-2 hoverable'>
                    <h3 class='center' style='font-family:Pacifico;text-transform:capitalize;'>Your form has been submitted!</h3>
                    </div></div>
                    ";
                    
                   echo "<div style='background:none' class='center-align card'>
                   <div class='card-content white-text hoverable'>
                   <h2 class='card-title'>FROM</h2><hr><ul>";

                   foreach($_POST as $fieldname => $fromvalue){
                      if(is_array($fromvalue))
                       echo "<li><strong>".ucfirst($fieldname)."</strong>: ".$fromvalue[0]."</li>";
                   }
                   
                   echo "<ul></div></div>";

                    
                  echo "<div style='background:none' class='center-align card'>
                   <div class='card-content white-text hoverable'>
                   <h2 class='card-title'>TO</h2><hr><ul>";

                   foreach($_POST as $fieldname => $tovalue){
                      if(is_array($tovalue))
                       echo "<li class='collection-item'><strong>".ucfirst($fieldname)."</strong>: ".$tovalue[1]."</li>";
                   }
                   
                   echo "<ul></div></div>";
                  
                   echo "<div style='background:none' class='center-align card'>
                   <div class='card-content white-text hoverable'>
                   <h2 class='card-title'>DIMENSIONS</h2><hr><ul>";

                   foreach($_POST as $fieldname => $dimension){
                       if($fieldname!="submit" && !is_array($dimension)) 
                       echo "<li class='collection-item'><strong>".ucfirst($fieldname)."</strong>: ".$dimension." ".
                       ($fieldname == "weight" ? "pounds" : "inches").
                       "</li>";
                   }
                   
                   echo "<ul></div></div>";
                 echo "</ul></div></div>";
                 echo "</div></div>";
                 
                 echo"<div class='center'>
                   <a href='packageform.php' style='background:linear-gradient(to right,#ec407a,#4a148c)' class='align-center btn-large btn waves-effect waves-light'>Enter Another Package
                <i class='material-icons right'>star</i>
                </a>
                <script>
                
                $('.card').css('right',1500);
                $('.card').each(function(index){
                $(this).animate({right:0},index*800);
                });
                </script>
                ";
                
          }else{ //error modal pops up
            $errors = validate_form();
            
            echo "<div class='modal grey lighten-4'>";
            echo "<div class='modal-content'>";
                foreach($errors as $error){
              echo "<div class='container' style='text-align:center'>
                <div class='row'>
                    <div class='col s12'>
                        <h4 class='red-text text-lighten-3'>$error</h4>
                    </div>
                </div></div>";
            }
            echo "</div>";
            echo "<div style='padding-bottom:75px;' class='modal-footer grey lighten-4'>
                <a href='#' style='right:45%;' class='center-align modal-action modal-close waves-effect waves-green btn-large'>Got it</a>
                </div>";
            echo "</div>";
            echo "<script>
                $('.modal').modal('open');
            </script>";
          }
      }
   }
   
   function validate_form(){
       $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       $errors = array();
       $states = [ 'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DC', 'DE', 'FL', 'GA', 
       'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD', 'MA', 'MI', 'MN', 
       'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH', 
       'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY' ];
       
       //check dimension values fit to range
       if($_POST['weight'] > 150 || $_POST['weight'] <=0)
        array_push($errors,"Package weight must be between 1 and 150 pounds inclusive.");
       
       if(($_POST['length']>36 || $_POST['length']<=0) || ($_POST['width']>36 || $_POST['width']<=0) || ($_POST['height']>36 || $_POST['height']<=0))
       array_push($errors,"All size dimensions must be between 1 and 36 inches inclusive.");
       
       //check valid state
       foreach($_POST['state'] as $state){
          if(!in_array($state, $states))
       array_push($errors,"Invalid state");
       }
       
       //zip code must be 5 digits and valid in the U.S.
       foreach($_POST['zip'] as $zip){
         $zip_check = @file_get_contents("http://ziplocate.us/api/v1/".$zip);
        if($zip_check == false || !preg_match('/^[0-9]{5}([- ]?[0-9]{4})?$/',strval($zip)))
            array_push($errors,"Invalid zip code"); 
       }
       
       //check if to and from addresses are the same
        $samecount = 0;
       foreach($_POST as $field){
          if(is_array($field)){
              if($field[0] == $field[1]){
                  $samecount++;
              }
          } 
       }
       
       if($samecount == 4){
           array_push($errors, "To and From addresses cannot be the same.");
       }
       
       return $errors;
   }

    function any_errors(){
        return count(validate_form()) > 0;
    }
?>	
</html>
