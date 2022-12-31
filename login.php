<?php
   
require_once "includes/header.php"; ?>

<?php 
  
   
  if(isset($_POST['submit'])){

    $UserMail = $_POST['email'];
    $UserPass = $_POST['password'];
   

     if(empty($UserMail) || empty($UserPass)){
         $_SESSION['ErrorMessage'] = "Field cannt be empty";
         Redirect_to('login.php');
     }else{
         $conn;
         $sql = "SELECT * FROM user WHERE email=:emaiL";
         $stmt= $conn->prepare($sql);
         $Execute = $stmt->execute([
             ':emaiL' => $UserMail
         ]);
         $Result = $stmt->rowCount();

         if($Result==1 ){  
            $Found_Account = $stmt->fetch(PDO::FETCH_ASSOC);
                  $_SESSION['UserId']      = $Found_Account['id'];
                  $_SESSION['UserEmail']   = $Found_Account['email'];
                  
                  
              if($Found_Account && password_verify($UserPass,$Found_Account['password'])){

                Redirect_to("index.php");
                  $_SESSION['SuccessMessage'] = "Welcome back ";
     
                                    
              }else{
                $_SESSION['ErrorMessage'] = "Your Password is incorrect";

                Redirect_to("login.php");
            }
         }  else{
            $_SESSION['ErrorMessage'] = "No User Found!!!!! with this email";
            Redirect_to("login.php");
     }
     }
   
  }


?>



<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
              <?php 
echo ErrorMessage();
echo SuccessMessage();
?>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to add.</h6>


                <form class="pt-3" action="login.php" method="POST">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    
                    <button type="submit" name="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
               
                 
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.php" class="text-primary">Create</a>
                  </div>
                </form>


              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>






<?php require_once "includes/footer.php"; ?>