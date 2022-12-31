<?php require_once "includes/header.php"; 
 Confirm_Login();
$title = "Update Product";
$SearchQueryParameter = $_GET['id'];







if(isset($_POST['submit'])){
    date_default_timezone_set('Asia/Kolkata');
    $DateTime             = date(DATE_RFC822); 
    $ProductName1                = $_POST['pname'];
    $ProductPrice1             = $_POST['pprice'];
    $ProductImage1                = $_FILES['qimage']['name'];
    $Target               = "uploads/".basename($_FILES["qimage"]["name"]);
    $ProductStatus1             = $_POST['pstatus'];
    $ProductDesc1         = $_POST['pdesc'];



    if(empty($ProductName1) ||  empty($ProductPrice1) ){
        $_SESSION['ErrorMessage'] = "Field can not be left empty";
        Redirect_to("editProduct.php");

    }else{
        global $conn;
        if (!empty($_FILES['qimage']['name'])) {
            $sql = "UPDATE product
                    SET time=:dateTime, pname=:pname, pprice=:pprice, pimg=:pimg, pstatus =:pstatus, pdesc = :pdesc
                    WHERE id='$SearchQueryParameter'";
                    $stmt =$conn->prepare($sql);
                    $Execute = $stmt->execute([
                        ':dateTime'        => $DateTime,
                        ':pname'           => $ProductName1,
                        ':pprice'          => $ProductPrice1,
                        ':pimg'            => $ProductImage1,
                        ':pstatus'         => $ProductStatus1,
                        ':pdesc'           => $ProductDesc1
                    ]);
                    move_uploaded_file($_FILES["qimage"]["tmp_name"],$Target);
          }else {
            $sql = "UPDATE product
                    SET time = :dateTime, pname=:pname, pprice=:pprice, pstatus =:pstatus, pdesc = :pdesc
                    WHERE id='$SearchQueryParameter'";
                    $stmt =$conn->prepare($sql);
                    $Execute = $stmt->execute([
                        ':dateTime'        => $DateTime,
                        ':pname'           => $ProductName1,
                        ':pprice'          => $ProductPrice1,
                        
                        ':pstatus'         => $ProductStatus1,
                        ':pdesc'           => $ProductDesc1
                    ]);
          }
     
        
        
      
         
        if($Execute){
            $_SESSION['SuccessMessage'] = "Your Product updated successfully";
            Redirect_to('index.php');
        }else{
            $_SESSION['ErrorMessage']  = "Something techinical glitch happened on editing product";
            Redirect_to("editProduct.php");

        }
        
    }   

    
}

?>









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
                    // $DateEdit         = $DataRows['time'];
                    $ProductName       = $DataRows['pname'];
                    $ProductPrice     = $DataRows['pprice'];
                    $ProductImage         = $DataRows['pimg'];
                    $ProductStatus       = $DataRows['pstatus'];
                    $ProductDesc = $DataRows['pdesc'];

?>

                    


                    <form class="forms-sample" action="editProduct.php?id=<?php echo $SearchQueryParameter; ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Product Name</label>
                        <input type="text" class="form-control" name="pname" id="exampleInputName1" value="<?php echo htmlentities($ProductName); ?>">
                      </div>
                      <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                            <div class="form-group">
                        <label for="exampleInputPrice1">Product Price</label>
                        <input type="text" name="pprice" class="form-control" id="exampleInputPrice1" value="<?php echo htmlentities($ProductPrice); ?>">
                      </div>
                     </div>
                     <div class="col-lg-4">
                      <div class="form-group">
                        <label for="exampleSelectStatus">Status</label>
                        <select class="form-control py-3"  name="pstatus" id="exampleSelectStatus">
                        <option selected><?php echo htmlentities($ProductStatus); ?></option>
                        
                          <option value="Active">Active</option>
                          <option value="In-Active">In-Active</option>
                        </select>
                      </div>


                            </div>
                        </div>
                      </div>
                     
                     
                      <div class="form-group">
                        <label>Existing Image</label>

                        <img src="Uploads/<?php echo $ProductImage; ?>" class="img-fluid p-2" width="400px" alt="">

                        <div class="custom-file">
                               <label for="formFileSm" class="form-label custom-file-label">Update image</label>
                               <input class="form-control form-control-sm " name="qimage" id="formFileSm" type="File"></div>


                        
                        
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleTextarea1">Product Description</label>
                        <textarea class="form-control" name="pdesc" value="<?php echo htmlentities($ProductDesc); ?>" placeholder="<?php echo htmlentities($ProductDesc); ?>" id="exampleTextarea1" rows="4"></textarea>
                      </div>
                      <button type="submit" name="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>

                    <?php } ?>
                  </div>
                </div>
              </div>










          </div>
         <?php require_once "includes/footer.php"; ?>