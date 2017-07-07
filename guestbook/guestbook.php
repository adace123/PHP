<head>
<title>Guestbook</title>
<script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js'></script>
<script src="https://use.fontawesome.com/594f332e05.js"></script>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>
<style>
.modal-content{color:black;}
strong{color:purple;}
.comment,input{font-family:Pacifico;font-size:24px;}
.card-content{background-color:#e1bee7}
.card-action{background-color:#ba68c8 !important}
nav{background-color:#7986cb;}

body{background-image:url('space2.jpg');background-size:cover;background-repeat:no-repeat;}
</style>
<body>
<script>
    var editing = false;
    function editComment(e){
        var original = $($(e).parent().parent().children()[0]);
        editing  = !editing;
        if(editing){
            $(e).children().replaceWith("<i class='fa fa-times' aria-hidden='true'></i>");
            var ecopy = e;
        var form = "<form id='form"+e.id +"'style='padding:0;display:inline-block;margin:0;height:2%;' action='guestbook.php' method='post'><input style='display:inline-block;position:absolute;' id='"+e.id+"'name='update' value='"+e.id+"'><input type='hidden' name='"+e.id+"'></form>";
        original.replaceWith(form);
        $('#'+e.id).keyup(function(e){
            if(e.keyCode === 13){
                $('#form'+ecopy.id).submit();
                return false;
            }
        })
        } else{
            $(e).children().replaceWith("<i class='material-icons'>mode_edit</i>");
           original.replaceWith("<span class='comment'>"+e.id+"</span>");
        }
    }
    
</script>
<?php
   date_default_timezone_set('America/Los_Angeles');
    function display_form(){
      echo "
      <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
      </script>
    <nav>
        <div class='nav-wrapper'>
        <a class='brand-logo center' style='font-family:Pacifico;color:white;letter-spacing:5px;font-size:24px;text-transform:uppercase;'>Guestbook</a>
        <ul class='right hide-on-med-and-down'>
        <li><a href='#modal1' class='waves-effect purple waves-light btn'>Add a Comment <i class='material-icons right'>add</i></a></li>
        <div id='modal1' class='modal'>
            <div class='modal-content'>
            <h2>Add a new comment</h2>
                <form method='post' action='guestbook.php'>
                    <input name='comment' placeholder='Enter a comment'>
                    <input name='name' placeholder='Enter your name'>
                    <input type='submit' value='submit' name='submit' class='btn btn-large'>
                </form>
            </div>
        </div>
      </ul>
        </div>
    </nav>
    <div class='container'>
        <div class='row'>
          <div class='col s12'>        
        ";
         
        show_comments();
        append_comment();
         echo"</div>  
        </div>
    </div>
        ";
    }
    display_form();

    function show_comments(){
        $file = file('guest.txt');
       
        foreach($file as $line){
            $comment = trim(split("/",$line)[0]);
            $name = trim(split("/",$line)[1]);
            $date = trim(split("/",$line)[2]);
            echo "
            <div class='card horizontal'>
            <div class='card-stacked'>
                <div class='card-content'>
                <span>
                <h6><span class='comment'>$comment</span>
                
                <div style='float:right;height:0;margin:0;padding:0;' class='valign-wrapper' >
                <button id='$comment' onclick='editComment(this)' style='margin-top:15px;margin-right:50px;' class='btn-floating purple'><i class='material-icons'>mode_edit</i></button>
                </div>

                <form style='float:right;height:0;margin:0;padding:0;' class='valign-wrapper' method='post' action='guestbook.php'>
                <input type='hidden' name='$comment'>
                <button type='submit' name='delete' style='margin-top:15px;' class='purple btn-floating vertical-align'><i class='material-icons'>delete</i></button>
                </form>
                
                </h6>
                </span>
                </div>
                <div class='card-action'>
                <a>Posted by: <strong>$name</strong> on $date</a>
                </div>
            </div>
            </div>
            ";
        }
        
       
    }
    delete_comment();
    update_comment();

    function delete_comment(){
        if(isset($_POST['delete'])){
            $file = file('guest.txt');
            foreach($file as $line){
                $comment = trim(split("/",$line)[0]);
                $comment = str_replace(" ","_",$comment);
                if(isset($_POST[$comment])){
                    $delete_line = str_replace($line,'',$file);
                    file_put_contents('guest.txt',$delete_line);
                    echo "<script>window.location = 'guestbook.php'</script>";
                } 
            }
        }
    }

    function update_comment(){
        if(isset($_POST['update'])){
           $file = file('guest.txt');
           foreach($file as $line){
               $comment = trim(split("/",$line)[0]);
               $comment = str_replace(" ","_",$comment);
               if(isset($_POST[$comment])){
                $_POST[$comment] = htmlspecialchars(stripslashes(trim($_POST[$comment])));
                 $update_line = str_replace($line,$_POST['update'].' / '.trim(split("/",$line)[1]).' / '.date("F j, Y, g:i a")."\n",$file);
                 file_put_contents('guest.txt',$update_line);
                 echo "<script>window.location = 'guestbook.php'</script>";
               }
           }
        }
    }

    function append_comment(){
        if(isset($_POST['submit'])){
            $_POST['comment'] = htmlspecialchars(stripslashes(trim($_POST['comment'])));
            $_POST['name'] = htmlspecialchars(stripslashes(trim($_POST['name'])));
            $date = date("F j, Y, g:i a");
            $file = fopen('guest.txt','a');
            $comment = $_POST['comment'];
            $name = $_POST['name'];
            $string = $comment." / ".$name." / ".$date."\n";
            fwrite($file,$string);
            fclose($file);
            echo "
                    <div class='card horizontal'>
            <div class='card-stacked'>
                <div class='card-content'>
                <span>
                <h6><span class='comment'>$comment</span>
                
                <div style='float:right;height:0;margin:0;padding:0;' class='valign-wrapper' >
                <button id='$comment' onclick='editComment(this)' style='margin-top:15px;margin-right:50px;' class='btn-floating purple'><i class='material-icons'>mode_edit</i></button>
                </div>

                <form style='float:right;height:0;margin:0;padding:0;' class='valign-wrapper' method='post' action='guestbook.php'>
                <input type='hidden' name='$comment'>
                <button type='submit' name='delete' style='margin-top:15px;' class='purple btn-floating vertical-align'><i class='material-icons'>delete</i></button>
                </form>
                
                </h6>
                </span>
                </div>
                <div class='card-action'>
                <a>Posted by: <strong>$name</strong> on $date</a>
                </div>
            </div>
            </div>
            ";
        }
    }
    
?>
<?php 
    if(filesize('guest.txt') == 0){
?>
<h2 style='margin-top:5%;' class='blue-text center-align'>Nothing here yet!</h2>;

<?php } ?>

</body>
