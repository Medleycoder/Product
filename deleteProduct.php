<?php require_once "includes/header.php"; 
 Confirm_Login();
$title = "Delete Product";
$SearchQueryParameter = $_GET['id'];






          









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
                <i class="fa-brands fa-product-hunt"></i>
                </span> <?php echo $title; ?>
              </h3>
           
            </div>
            
        



            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Product</h4>
                    <p class="card-description"> Product Update </p>
       



                    <?php 
                
                $conn;
                $sql = "SELECT * FROM product WHERE id='$SearchQueryParameter'";
                $stmt = $conn->query($sql);
                while($DataRows = $stmt->fetch()){
                    $IdEdit           = $DataRows['id'];
                    
                    $ProductName       = $DataRows['pname'];
                    $ProductPrice     = $DataRows['pprice'];
                    $ProductImage         = $DataRows['pimg'];
                    $ProductStatus       = $DataRows['pstatus'];
                    $ProductDesc = $DataRows['pdesc'];

?>
<?php
if(isset($_POST['submit'])){
               if(isset($_GET['id'])){
                   $SearchQueryParameter = $_GET['id'];
                   global $conn;
                   $sql = "DELETE FROM product WHERE id='$SearchQueryParameter'";
                   $Executes = $conn->query($sql);
                   
              
                   if($Executes){
                       $Target_image_delete = "uploads/$ProductImage";
                       var_dump($Target_image_delete);
                       unlink($Target_image_delete);
                       $_SESSION['SuccessMessage'] = "Product deleted successfully";
                       Redirect_to("index.php");
              
                   }else{
                       $_SESSION['ErrorMessage'] = "Something techinical glitch happened";
                       Redirect_to("index.php");
                   }
               }
             }
             ?>
                    


                    <form class="forms-sample" action="deleteProduct.php?id=<?php echo $SearchQueryParameter; ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Product Name</label>
                        <input type="text" class="form-control" name="pname" id="exampleInputName1" placeholder="<?php echo htmlentities($ProductName); ?>" disabled>
                      </div>
                      <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                            <div class="form-group">
                        <label for="exampleInputPrice1">Product Price</label>
                        <input type="text" name="pprice" class="form-control" id="exampleInputPrice1" placeholder="<?php echo htmlentities($ProductPrice); ?>" disabled>
                      </div>
                     </div>
                     <div class="col-lg-4">
                      <div class="form-group">
                        <label for="exampleSelectStatus">Status</label>
                        <select class="form-control py-3"  name="pstatus" id="exampleSelectStatus" disabled>
                        <option selected><?php echo htmlentities($ProductStatus); ?></option>
                        
                          
                        </select>
                      </div>


                            </div>
                        </div>
                      </div>
                     
                     
                      <div class="form-group">
                        <label>Existing Image</label>

                        <img src="Uploads/<?php echo $ProductImage; ?>" class="img-fluid p-2" width="400px" alt="">

                   
                      
                      <div class="form-group">
                        <label for="exampleTextarea1">Product Description</label>
                        <textarea class="form-control" name="pdesc" placeholder="<?php echo htmlentities($ProductDesc); ?>" placeholder="<?php echo htmlentities($ProductDesc); ?>" id="exampleTextarea1" rows="4" disabled></textarea>
                      </div>
                      <button type="submit" name="submit" class="btn btn-gradient-danger me-2">Delete</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>

                    <?php } ?>
                  </div>
                </div>
              </div>










          </div>
         <?php require_once "includes/footer.php"; ?>