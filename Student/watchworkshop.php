<?php
if(!isset($_SESSION)){ 
   session_start(); 
 }
include('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $stuEmail = $_SESSION['stuLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Watch workshop</title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="../css/bootstrap.min.css">

 <!-- Font Awesome CSS -->
 <link rel="stylesheet" href="../css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

 <!-- Custom CSS -->
 <link rel="stylesheet" href="../css/stustyle.css">
</head>
<body>

   <div class="container-fluid bg-success p-2" >
    <h3>Welcome to E_workshop</h3>
    <a class="btn btn-danger" href="./myworkshop.php">My workshop</a>
   </div>
   
   <div class="container-fluid">
    <div class="row">
     <div class="col-sm-3 border-right">
       <h4 class="text-center">module</h4>
       <ul id="playlist" class="nav flex-column">
          <?php
             if(isset($_GET['workshop_id'])){
              $workshop_id = $_GET['workshop_id'];
              $sql = "SELECT * FROM module WHERE workshop_id = '$workshop_id'";
              $result = $conn->query($sql);
              if($result->num_rows > 0){
               while($row = $result->fetch_assoc()){
                echo '<li class="nav-item border-bottom py-2" movieurl='.$row['module_link'].' style="cursor: pointer;">'. $row['module_name'] .'</li>';
               }
              }
             }
          ?>
       </ul>
     </div>
     <div class="col-sm-8">
        <video id="videoarea" src="" class="mt-5 w-75 ml-2" controls>
        </video>
     </div>
    </div>
   </div>



    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="../js/all.min.js"></script>

    <!-- Ajax Call JavaScript -->
    <!-- <script type="text/javascript" src="..js/ajaxrequest.js"></script> -->

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>