<?php
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
?>  
    <div class="container-fluid bg-dark"> <!-- Start workshop Page Banner -->
      <div class="row">
        <img src="./image/workshopbanner.jpg" alt="workshop" style="height:500px; width:100%; object-fit:cover; box-shadow:10px;"/>
      </div> 
    </div> <!-- End workshop Page Banner -->

    <div class="container mt-5"> <!-- Start All workshop -->
      <h1 class="text-center">All workshop</h1>
      <div class="row mt-4"> <!-- Start All workshop Row -->
      <?php
          $sql = "SELECT * FROM workshop";
          $result = $conn->query($sql);
          if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){
              $workshop_id = $row['workshop_id'];
              echo ' 
                <div class="col-sm-4 mb-4">
                  <a href="workshopdetails.php?workshop_id='.$workshop_id.'" class="btn" style="text-align: left; padding:0px;"><div class="card">
                    <img src="'.str_replace('..', '.', $row['workshop_img']).'" class="card-img-top" alt="Guitar" />
                    <div class="card-body">
                      <h5 class="card-title">'.$row['workshop_name'].'</h5>
                      <p class="card-text">'.$row['workshop_desc'].'</p>
                    </div>
                    <div class="card-footer">
                      <p class="card-text d-inline">Price: <small><del>&#8377 '.$row['workshop_original_price'].'</del></small> <span class="font-weight-bolder">&#8377 '.$row['workshop_price'].'<span></p> <a class="btn btn-primary text-white font-weight-bolder float-right" href="workshopdetails.php?workshop_id='.$workshop_id.'">Enroll</a>
                    </div>
                  </div> </a>
                </div>
              ';
            }
          }
        ?> 
        </div><!-- End All workshop Row -->   
      </div><!-- End All workshop -->   
     
<?php 
  // Contact Us
  include('./contact.php'); 
?> 

<?php 
  // Footer Include from mainInclude 
  include('./mainInclude/footer.php'); 
?>  
