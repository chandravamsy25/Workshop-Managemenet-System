<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Edit workshop');
define('PAGE', 'workshop');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } 
 else {
  echo "<script> location.href='../index.php'; </script>";
 }
 // Update
 if(isset($_REQUEST['requpdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['workshop_id'] == "") || ($_REQUEST['workshop_name'] == "") || ($_REQUEST['workshop_desc'] == "") || ($_REQUEST['workshop_author'] == "") || ($_REQUEST['workshop_duration'] == "") || ($_REQUEST['workshop_price'] == "") || ($_REQUEST['workshop_original_price'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    $cid = $_REQUEST['workshop_id'];
    $cname = $_REQUEST['workshop_name'];
    $cdesc = $_REQUEST['workshop_desc'];
    $cauthor = $_REQUEST['workshop_author'];
    $cduration = $_REQUEST['workshop_duration'];
    $cprice = $_REQUEST['workshop_price'];
    $coriginalprice = $_REQUEST['workshop_original_price'];
    $cimg = '../image/workshopimg/'. $_FILES['workshop_img']['name'];
    
   $sql = "UPDATE workshop SET workshop_id = '$cid', workshop_name = '$cname', workshop_desc = '$cdesc', workshop_author='$cauthor', workshop_duration='$cduration', workshop_price='$cprice', workshop_original_price='$coriginalprice', workshop_img='$cimg' WHERE workshop_id = '$cid'";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Update workshop Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM workshop WHERE workshop_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="workshop_id">workshop ID</label>
      <input type="text" class="form-control" id="workshop_id" name="workshop_id" value="<?php if(isset($row['workshop_id'])) {echo $row['workshop_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="workshop_name">workshop Name</label>
      <input type="text" class="form-control" id="workshop_name" name="workshop_name" value="<?php if(isset($row['workshop_name'])) {echo $row['workshop_name']; }?>">
    </div>


    <div class="form-group">
      <label for="workshop_desc">workshop Description</label>
      <textarea class="form-control" id="workshop_desc" name="workshop_desc" row=2><?php if(isset($row['workshop_desc'])) {echo $row['workshop_desc']; }?></textarea>
    </div>
    <div class="form-group">
      <label for="workshop_author">Author</label>
      <input type="text" class="form-control" id="workshop_author" name="workshop_author" value="<?php if(isset($row['workshop_author'])) {echo $row['workshop_author']; }?>">
    </div>
    <div class="form-group">
      <label for="workshop_duration">workshop Duration</label>
      <input type="text" class="form-control" id="workshop_duration" name="workshop_duration" value="<?php if(isset($row['workshop_duration'])) {echo $row['workshop_duration']; }?>">
    </div>
    <div class="form-group">
      <label for="workshop_original_price">workshop Original Price</label>
      <input type="text" class="form-control" id="workshop_original_price" name="workshop_original_price" onkeypress="isInputNumber(event)" value="<?php if(isset($row['workshop_original_price'])) {echo $row['workshop_original_price']; }?>">
    </div>
    <div class="form-group">
      <label for="workshop_price">workshop Selling Price</label>
      <input type="text" class="form-control" id="workshop_price" name="workshop_price" onkeypress="isInputNumber(event)" value="<?php if(isset($row['workshop_price'])) {echo $row['workshop_price']; }?>">
    </div>
    <div class="form-group">
      <label for="workshop_img">workshop Image</label>
      <img src="<?php if(isset($row['workshop_img'])) {echo $row['workshop_img']; }?>" alt="workshopimage" class="img-thumbnail">     
      <input type="file" class="form-control-file" id="workshop_img" name="workshop_img">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="workshop.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>