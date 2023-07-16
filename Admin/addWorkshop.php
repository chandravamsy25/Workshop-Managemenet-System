<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add workshop');
define('PAGE', 'workshop');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 if(isset($_REQUEST['workshopubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['workshop_name'] == "") || ($_REQUEST['workshop_desc'] == "") || ($_REQUEST['workshop_author'] == "") || ($_REQUEST['workshop_duration'] == "") || ($_REQUEST['workshop_price'] == "") || ($_REQUEST['workshop_original_price'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $workshop_name = $_REQUEST['workshop_name'];
   $workshop_desc = $_REQUEST['workshop_desc'];
   $workshop_author = $_REQUEST['workshop_author'];
   $workshop_duration = $_REQUEST['workshop_duration'];
   $workshop_price = $_REQUEST['workshop_price'];
   $workshop_original_price = $_REQUEST['workshop_original_price'];
   $workshop_image = $_FILES['workshop_img']['name']; 
   $workshop_image_temp = $_FILES['workshop_img']['tmp_name'];
   $img_folder = '../image/workshopimg/'. $workshop_image; 
   move_uploaded_file($workshop_image_temp, $img_folder);
    $sql = "INSERT INTO workshop (workshop_name, workshop_desc, workshop_author, workshop_img, workshop_duration, workshop_price, workshop_original_price) VALUES ('$workshop_name', '$workshop_desc','$workshop_author', '$img_folder', '$workshop_duration', '$workshop_price', '$workshop_original_price')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> workshop Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add workshop </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New workshop</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="workshop_name">workshop Name</label>
      <input type="text" class="form-control" id="workshop_name" name="workshop_name">
    </div>
    <div class="form-group">
      <label for="workshop_desc">workshop Description</label>
      <textarea class="form-control" id="workshop_desc" name="workshop_desc" row=2></textarea>
    </div>
    <div class="form-group">
      <label for="workshop_author">Author</label>
      <input type="text" class="form-control" id="workshop_author" name="workshop_author">
    </div>
    <div class="form-group">
      <label for="workshop_duration">workshop Duration</label>
      <input type="text" class="form-control" id="workshop_duration" name="workshop_duration">
    </div>
    <div class="form-group">
      <label for="workshop_original_price">workshop Original Price</label>
      <input type="text" class="form-control" id="workshop_original_price" name="workshop_original_price" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="workshop_price">workshop Selling Price</label>
      <input type="text" class="form-control" id="workshop_price" name="workshop_price" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="workshop_img">workshop Image</label>
      <input type="file" class="form-control-file" id="workshop_img" name="workshop_img">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="workshopubmitBtn" name="workshopubmitBtn">Submit</button>
      <a href="workshop.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>