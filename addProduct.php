

<?php require_once "includes/header.php";  Confirm_Login();  $title = "Add Product" ?>
<?php


if(isset($_POST['submit'])){
    
    $ProductName             = $_POST['pname'];
    date_default_timezone_set('Asia/Kolkata');
    $DateTime                = date(DATE_RFC822); 
    $ProductPrice            = $_POST['pprice'];
    $ProductStatus           = $_POST['pstatus'];
    $ProductImage            = $_FILES['qimage']['name'];
    $Target                  ="uploads/".basename($_FILES['qimage']['name']);
    $ProductDescription      = $_POST['pdesc'];

    if(empty($ProductName) || empty($ProductPrice) || empty($ProductImage) || empty($ProductDescription)){
        $_SESSION['ErrorMessage'] = 'Field should be filled!!';
        Redirect_to('addProduct.php');
    
     }else{
       $conn;
       $sql = "INSERT INTO product(pname,pprice,pimg,pstatus,pdesc,time) VALUES (:pName,:pPrice,:pIMg,:pStatus,:pDesC,:dateTime)";
       $stmt=$conn->prepare($sql);
       $Execute = $stmt->execute([
           
           ':pName'         => $ProductName,
           ':pPrice'        => $ProductPrice,
           ':pIMg'          => $ProductImage,
           ':pStatus'       => $ProductStatus,
           ':pDesC'         => $ProductDescription,
           ':dateTime'      => $DateTime
           
       ]);
        move_uploaded_file($_FILES['qimage']['tmp_name'],$Target);

       if($Execute){
           $_SESSION['SuccessMessage'] = 'Product with id: '.$conn->lastInsertId().' uploaded successfully';
           Redirect_to('index.php');
       }else {
           $_SESSION['ErrorMessage'] = 'Something techinical issue occur';
           Redirect_to('addProduct.php');
       }
       

   }
}
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
                <i class="fa-solid fa-square-plus"></i>
                </span> <?php echo $title; ?>
              </h3>
  
            </div>
            
         
          
                     
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                    <p class="card-description"> Product Details </p>
       

  
                    <?php 
echo ErrorMessage();
echo SuccessMessage();
?>





                    <form class="forms-sample" action="addProduct.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Product Name</label>
                        <input type="text" class="form-control" name="pname" id="exampleInputName1" placeholder="Product Name">
                      </div>
                      <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                            <div class="form-group">
                        <label for="exampleInputPrice1">Product Price</label>
                        <input type="text" name="pprice" class="form-control" id="exampleInputPrice1" placeholder="Input Price">
                      </div>
                     </div>
                     <div class="col-lg-4">
                      <div class="form-group">
                        <label for="exampleSelectStatus">Status</label>
                        <select class="form-control py-3"  name="pstatus" id="exampleSelectStatus">
                            <option value="Status">Status</option>
                          <option value="Active">Active</option>
                          <option value="In-Active">In-Active</option>
                        </select>
                      </div>


                            </div>
                        </div>
                      </div>
                     
                     
                      <div class="form-group">
                        <label>Upload Image</label>
                        <input class="form-control form-control-sm" name="qimage" id="formFileSm" type="File">
                        
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleTextarea1">Product Description</label>
                        <textarea class="form-control" name="pdesc" id="exampleTextarea1" rows="4"></textarea>
                      </div>
                      <button type="submit" name="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>




                </div>
              </div>




          </div>
         <?php require_once "includes/footer.php"; ?>