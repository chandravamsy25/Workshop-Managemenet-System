<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Edit module');
define('PAGE', 'module');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 // Update
 if(isset($_REQUEST['requpdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['module_id'] == "") || ($_REQUEST['module_name'] == "") || ($_REQUEST['module_desc'] == "") || ($_REQUEST['workshop_id'] == "") || ($_REQUEST['workshop_name'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    $lid = $_REQUEST['module_id'];
    $lname = $_REQUEST['module_name'];
    $ldesc = $_REQUEST['module_desc'];
    $cid = $_REQUEST['workshop_id'];
    $cname = $_REQUEST['workshop_name'];
    $llink = '../modulevid/'. $_FILES['module_link']['name'];
    
   $sql = "UPDATE module SET module_id = '$lid', module_name = '$lname', module_desc = '$ldesc', workshop_id='$cid', workshop_name='$cname', module_link='$llink' WHERE module_id = '$lid'";
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
  <h3 class="text-center">Update module Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM module WHERE module_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="module_id">module ID</label>
      <input type="text" class="form-control" id="module_id" name="module_id" value="<?php if(isset($row['module_id'])) {echo $row['module_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="module_name">module Name</label>
      <input type="text" class="form-control" id="module_name" name="module_name" value="<?php if(isset($row['module_name'])) {echo $row['module_name']; }?>">
    </div>

    <div class="form-group">
      <label for="module_desc">module Description</label>
      <textarea class="form-control" id="module_desc" name="module_desc" row=2><?php if(isset($row['module_desc'])) {echo $row['module_desc']; }?></textarea>
    </div>
    <div class="form-group">
      <label for="workshop_id">workshop ID</label>
      <input type="text" class="form-control" id="workshop_id" name="workshop_id" value="<?php if(isset($row['workshop_id'])) {echo $row['workshop_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="workshop_name">workshop Name</label>
      <input type="text" class="form-control" id="workshop_name" name="workshop_name" onkeypress="isInputNumber(event)" value="<?php if(isset($row['workshop_name'])) {echo $row['workshop_name']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="module_link">module Link</label>
      <div class="embed-responsive embed-responsive-16by9">
       <iframe class="embed-responsive-item" src="<?php if(isset($row['module_link'])) {echo $row['module_link']; }?>" allowfullscreen></iframe>
      </div>     
      <input type="file" class="form-control-file" id="module_link" name="module_link">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="module.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>