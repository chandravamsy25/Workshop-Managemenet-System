<?php
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
?>  
    <div class="container-fluid bg-dark"> <!-- Start workshop Page Banner -->
      <div class="row">
        <img src="./image/workshopbanner.jpg" alt="workshop" style="height:200px; width:100%; object-fit:cover; box-shadow:10px;"/>
      </div> 
    </div> <!-- End workshop Page Banner -->

    <div class="container mt-5"> <!-- Start All workshop -->
      <?php
          if(isset($_GET['workshop_id'])){
           $workshop_id = $_GET['workshop_id'];
           $_SESSION['workshop_id'] = $workshop_id;
           $sql = "SELECT * FROM workshop WHERE workshop_id = '$workshop_id'";
          $result = $conn->query($sql);
          if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){
              echo ' 
                <div class="row">
                <div class="col-md-4">
                  <img src="'.str_replace('..', '.', $row['workshop_img']).'" class="card-img-top" alt="Guitar" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">workshop Name: '.$row['workshop_name'].'</h5>
                    <p class="card-text"> Description: '.$row['workshop_desc'].'</p>
                    <p class="card-text"> Duration: '.$row['workshop_duration'].'</p>
                    <form action="checkout.php" method="post">
                      <p class="card-text d-inline">Price: <small><del>&#8377 '.$row['workshop_original_price'].'</del></small> <span class="font-weight-bolder">&#8377 '.$row['workshop_price'].'<span></p>
                      <input type="hidden" name="id" value='. $row["workshop_price"] .'> 
                      <button type="submit" class="btn btn-primary text-white font-weight-bolder float-right" name="buy">Buy Now</button>
                    </form>
                  </div>
                </div>
              ';
            }
          }
         }
        ?>   
      </div><!-- End All workshop --> 
      <div class="container">
          <div class="row">
          <?php $sql = "SELECT * FROM module";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
          echo '
           <table class="table table-bordered table-hover">
             <thead>
               <tr>
                 <th scope="col">module No.</th>
                 <th scope="col">module Name</th>
               </tr>
             </thead>
             <tbody>';
             $num = 0;
             while($row = $result->fetch_assoc()){
              if($row['workshop_id'] == $workshop_id) {
               $num++;
              echo ' <tr>
               <th scope="row">'.$num.'</th>
               <td>'. $row["module_name"].'</td></tr>';
              }
             }
             echo '</tbody>
           </table>';
            } ?>         
       </div>
      </div>  
     <?php 
  // Footer Include from mainInclude 
  include('./mainInclude/footer.php'); 
?>  
