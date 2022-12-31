<?php require_once "includes/header.php"; 
 Confirm_Login();
$title = "Dashboard";
?>
  
    <div class="container-scroller">
    
     <?php require_once "includes/topbar.php"; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php require_once "includes/sidebar.php"; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> <?php echo $title; ?>
              </h3>

              <?php 
                       echo ErrorMessage();
                       echo SuccessMessage();
                    ?>

           
            </div>
            
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Product table</h4>
                    
                    <table class="table table-dark">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Name </th>
                          <th> Price</th>
                          <th> Image </th>
                          <th> Status </th>
                          <th> Desc </th>
                          <th> Action </th>
                        </tr>
                      </thead>

                      <?php 
             $sql = "SELECT * FROM product";
             $stmt = $conn->query($sql);
             $Sr = 0;
             while($DataRows = $stmt->fetch()){
                 $Id            = $DataRows['id'];
                 $Date          = $DataRows['time'];
                 $ProductName     = $DataRows['pname'];
                 $ProductPrice  = $DataRows['pprice'];
                 $ProductImage       = $DataRows['pimg'];
                 $ProductStatus   = $DataRows['pstatus'];
                 $Description   = $DataRows['pdesc'];
                 $Sr++;
             ?>




                      <tbody>
                        <tr>
                          <td><?php echo $Id; ?></td>
                          <td><?php echo $ProductName; ?></td>
                          <td><?php echo $ProductPrice; ?></td>
                          <td><img src="uploads/<?php echo htmlentities($ProductImage); ?>" alt="" width="220px" height="80px"></td>
                          <td><?php echo $ProductStatus; ?></td>
                          <td><?php echo $Description; ?></td>
                          <td>


                          <a target='_blank' class="" name="edit" href="editProduct.php?id=<?php echo htmlentities($Id); ?>"><i class="fa-regular bg-light fa-pen-to-square p-2"></i></a>
                         <a target='_blank'  href="deleteProduct.php?id=<?php echo htmlentities($Id); ?>"><i class="fa-solid fa-trash bg-light p-2"></i></a>

                          </td>
                        </tr>
                      </tbody>

                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
          </div>
         <?php require_once "includes/footer.php"; ?>