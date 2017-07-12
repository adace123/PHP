<!DOCTYPE html>
<html>
    <head>
        <title>Process XML Form</title>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
    </head>
    <style>
      body{text-align:center; background-position: 0px 0px; background-image:url('form-background.jpeg'); background-repeat:no-repeat; background-size:cover; }
      table{margin:0 auto; border:1px solid;}
      input{padding-left: 10px !important;background-color:#90caf9 !important;color:black !important;}
      tr,th,td{border:1px solid;}
      td{background-color:#90caf9;text-align:center;}
      th{text-align:center;}
      th{background-color:#42a5f5;}
      h1,h4, input,label{color:white;}
      button{background-color:#42a5f5;color:black;}
      
      @keyframes bg {
          from {background-position: 0 -1350px}
         
          to{background-position: 0 -325px;}
      }
    </style>
    <body>
        <div class="container">
        <div class="row">
            <div class="col s6 offset-s3">
                
            
          <h1>Inventory Item Form</h1>
          <form method="post" action="processXML.php">
            <label for="idnumber">Enter the item id# (1-10):</label>
            <input type="number" name="id" id="idnumber"><br><br>
            <button class="waves-effect blue lighten-1 btn black-text" name="submit" type="submit">Submit</button>
         </form><br>   
        <br>
        </div>
        </div>

            <div class="row">
            <div class="col s8 offset-s2">
            
            <?php
            if(isset($_POST['submit'])){
                $id = filter_input(INPUT_POST,"id");
                if($id < 0 || $id > 10){
                    echo "Error. Id must be between 1 and 10 inclusive.";
                    return;
                }
                else{
                $xml = simplexml_load_file("inventory.xml");
                $mainlabels = "";
                $mainvalues = "";
                $suppliers = "";
                $suppliercount = 0;
                foreach($xml->children() as $item){
                if($item->children() == $id){
                    foreach($item as $label => $value){
                       if($label != "supplier") {
                            $mainlabels .= "<th>".strtoupper($label)."</th>";
                            $mainvalues .= "<td>$value</td>";
                       }
                       else {
                            $suppliers .= "<h4><u>Supplier ". ++$suppliercount. "</u></h4><table>";
                            foreach($value as $l => $v){
                                $suppliers .= "<th>".strtoupper($l)."</th>";
                            }
                           $suppliers .= "<tr>";
                           foreach($value as $l => $v){
                               $suppliers .= "<td>$v</td>";
                           }
                           $suppliers .= "</tr></table><br>";
                        }
                    }
                } 
                }
                echo "<table>$mainlabels<tr>$mainvalues</tr></table><br>";
                echo $suppliers;
                }
            }
                     
?> 
</div>
</div>
</div>
    </body>
</html>
