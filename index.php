<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title> loplo</title>
    </head>
    	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <body>
      
        <form action="" method="POST" id="sendData">
            <p><input type="number" name="nr" value="" id="nr"></p>
            <p><input type="submit" name="submit" value="Submit"></p>
        </form> 
        
       
    </body>
    <script>
    $("#sendData").submit(function(e) {
        //e.preventDefault();
        var _data = document.getElementById("nr").value;
        $.ajax({
                type: "POST",
                url: "http://localhost/php2/",
                data: {nr : _data},
            });
    });
</script>
<?php
    if( isset($_POST['nr']) ){
        echo $_POST['nr'];
        error_log($_POST['nr']);
        exit;
      }
    
?>

</html> 

//C:\xampp\php\php -S localhost:8085 consola la php
