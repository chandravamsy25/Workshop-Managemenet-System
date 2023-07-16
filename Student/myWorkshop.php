<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'My workshop');
define('PAGE', 'myworkshop');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $stuLogEmail = $_SESSION['stuLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
?>

 <div class="container mt-5 ml-2">
  <div class="row">
   <div class="jumbotron">
    <h4 class="text-center">All workshop</h4>
    <?php 
   if(isset($stuLogEmail)){
    $sql = "SELECT co.order_id, c.workshop_id, c.workshop_name, c.workshop_duration, c.workshop_desc, c.workshop_img, c.workshop_author, c.workshop_original_price, c.workshop_price FROM workshoporder AS co JOIN workshop AS c ON c.workshop_id = co.workshop_id WHERE co.stu_email = '$stuLogEmail'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
     while($row = $result->fetch_assoc()){ ?>
      <div class="bg-light mb-3">
        <h5 class="card-header"><?php echo $row['workshop_name']; ?></h5>
          <div class="row">
          
              <div class="col-sm-3">
                <img src="<?php echo $row['workshop_img']; ?>" class="card-img-top
                mt-4" alt="pic">
              </div>
              <div class="col-sm-6 mb-3">
                <div class="card-body">
                  <p class="card-title"><?php echo $row['workshop_desc']; ?></p>
                  <small class="card-text">Duration: <?php echo $row['workshop_duration']; ?></small><br />
                  <small class="card-text">Instructor: <?php echo $row['workshop_author']; ?></small><br/>
                  <p class="card-text d-inline">Price: <small><del>&#8377 <?php echo $row['workshop_original_price'] ?> </del></small> <span class="font-weight-bolder">&#8377 <?php echo $row['workshop_price']?> <span></p>
                  <a href="watchworkshop.php?workshop_id=<?php echo $row['workshop_id'] ?>" class="btn btn-primary mt-5 float-right">Watch workshop</a>
                </div>
              </div>
          
          </div>
          
      </div> 
    <?php
     }
    }
   }
  
    ?>
    <hr/>
   </div>
  </div>
 </div>

 </div> <!-- Close Row Div from header file -->
 <?php
include('./stuInclude/footer.php'); 
?>