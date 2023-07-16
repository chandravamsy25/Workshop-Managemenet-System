<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add module');
define('PAGE', 'module');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 if(isset($_REQUEST['moduleubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['module_name'] == "") || ($_REQUEST['module_desc'] == "") || ($_REQUEST['workshop_id'] == "") || ($_REQUEST['workshop_name'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $module_name = $_REQUEST['module_name'];
   $module_desc = $_REQUEST['module_desc'];
   $workshop_id = $_REQUEST['workshop_id'];
   $workshop_name = $_REQUEST['workshop_name'];
   $module_link = $_FILES['module_link']['name']; 
   $module_link_temp = $_FILES['module_link']['tmp_name'];
   $link_folder = '../modulevid/'.$module_link; 
   move_uploaded_file($module_link_temp, $link_folder);
    $sql = "INSERT INTO module (module_name, module_desc, module_link, workshop_id, workshop_name) VALUES ('$module_name', '$module_desc','$link_folder', '$workshop_id', '$workshop_name')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> module Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add module </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New module</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="workshop_id">workshop ID</label>
      <input type="text" class="form-control" id="workshop_id" name="workshop_id" value ="<?php if(isset($_SESSION['workshop_id'])){echo $_SESSION['workshop_id'];} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="workshop_name">workshop Name</label>
      <input type="text" class="form-control" id="workshop_name" name="workshop_name" value ="<?php if(isset($_SESSION['workshop_name'])){echo $_SESSION['workshop_name'];} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="module_name">module Name</label>
      <input type="text" class="form-control" id="module_name" name="module_name">
    </div>
    <div class="form-group">
      <label for="module_desc">module Description</label>
      <textarea class="form-control" id="module_desc" name="module_desc" row=2></textarea>
    </div>
    <div class="form-group">
      <label for="module_link">module Video Link</label>
      <input type="file" class="form-control-file" id="module_link" name="module_link">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="moduleubmitBtn" name="moduleubmitBtn">Submit</button>
      <a href="module.php" class="btn btn-secondary">Close</a>
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