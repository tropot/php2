<?php
 include 'db.php';
 $conn = new mysqli($servername,$username,$password,$dbname);
 $nr_random = random_int(1, 25);
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
 if (isset($_POST['action'])) {
    switch ($_POST['action']) {
            case 'fetch':
                $result = mysqli_query($conn,"SELECT * FROM numeros");
                while($row = mysqli_fetch_assoc($result)){
                    $arr[] = $row;
                }
                echo json_encode($arr);
                exit;
                break;
            case 'add':
                $numar = (int)$_POST['newData'];
                $suma = $numar + $nr_random;
                $sql = "INSERT INTO numeros (input_number, random_number, number_result)
                VALUES ($numar, $nr_random, $suma)";
                if ($conn->query($sql) === TRUE) {
                    echo "numbers are posted to the database";
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                exit;
                break;
            case 'edit':

                $nD = $_POST['newData'];
                $iD = $_POST['id'];
                $sql = "UPDATE numeros SET input_number= '$nD' WHERE id='$iD'";
                if ($conn->query($sql) === TRUE) {
                    echo "numbers are edited";
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                exit;
                break;
        }
     
    
     

     
      
    

 }
 
?>
