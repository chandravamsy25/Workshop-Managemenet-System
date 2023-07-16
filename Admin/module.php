<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'module');
define('PAGE', 'module');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 ?>

<div class="col-sm-9 mt-5  mx-3">
  <form action="" class="mt-3 form-inline d-print-none">
    <div class="form-group mr-3">
      <label for="checkid">Enter workshop ID: </label>
      <input type="text" class="form-control ml-3" id="checkid" name="checkid" onkeypress="isInputNumber(event)">
    </div>
    <button type="submit" class="btn btn-danger">Search</button>
  </form>
  <?php
  $sql = "SELECT workshop_id FROM workshop";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()){
    if(isset($_REQUEST['checkid']) && $_REQUEST['checkid'] == $row['workshop_id']){
      $sql = "SELECT * FROM workshop WHERE workshop_id = {$_REQUEST['checkid']}";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      if(($row['workshop_id']) == $_REQUEST['checkid']){ 
        $_SESSION['workshop_id'] = $row['workshop_id'];
        $_SESSION['workshop_name'] = $row['workshop_name'];
        
        ?>
        <h3 class="mt-5 bg-dark text-white p-2">workshop ID : <?php if(isset($row['workshop_id'])) {echo $row['workshop_id']; } ?> workshop Name: <?php if(isset($row['workshop_name'])) {echo $row['workshop_name']; } ?></h3>
        <?php
          $sql = "SELECT * FROM module WHERE workshop_id = {$_REQUEST['checkid']}";
          $result = $conn->query($sql);
          echo '<table class="table">
            <thead>
              <tr>
              <th scope="col">module ID</th>
              <th scope="col">module Name</th>
              <th scope="col">module Link</th>
              <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>';
              while($row = $result->fetch_assoc()){
                echo '<tr>';
                echo '<th scope="row">'.$row["module_id"].'</th>';
                echo '<td>'. $row["module_name"].'</td>';
                echo '<td>'.$row["module_link"].'</td>';
                echo '<td><form action="editmodule.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["module_id"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button></form>  
                <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["module_id"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
              </tr>';
              }
              echo '</tbody>
             </table>';
        } else {
          echo '<div class="alert alert-dark mt-4" role="alert">
          workshop Not Found ! </div>';
        }
        if(isset($_REQUEST['delete'])){
         $sql = "DELETE FROM module WHERE module_id = {$_REQUEST['id']}";
         if($conn->query($sql) === TRUE){
           // echo "Record Deleted Successfully";
           // below code will refresh the page after deleting the record
           echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
           } else {
             echo "Unable to Delete Data";
           } 
     } 
   } 
  }?>
  
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
 <?php if(isset($_SESSION['workshop_id'])){
   echo '<div><a class="btn btn-danger box" href="./addmodule.php"><i class="fas fa-plus fa-2x"></i></a></div>';
   } ?>
 
</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./adminInclude/footer.php'); 
?>