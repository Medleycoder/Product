<?php require_once "includes/header.php"; ?>


<?php 
   if(isset($_POST['submit'])){
      
      $Email                   = $_POST['email'];
      $Password                = $_POST['password'];
      $PasswordHashed          = password_hash($Password,PASSWORD_DEFAULT);
      $ConfirmPassword         = $_POST['conpassword'];
      
      date_default_timezone_set('Asia/Kolkata');
      $Time                    = date(DATE_RFC822); 
      
      

       if( empty($Email) || empty($Password) || empty($ConfirmPassword) ){
           $_SESSION['ErrorMessage'] = 'Field must be filled';
           Redirect_to("register.php");
        
          
       }elseif ($Password !== $ConfirmPassword){
         $_SESSION['ErrorMessage'] = 'Confirm Password should match the password';
         Redirect_to("register.php");
       
        }elseif(strlen($Password)<5){
        
            $_SESSION['ErrorMessage'] = "Password cant be less than 5 character";
            Redirect_to("register.php");
        
        }elseif(CheckEmailExist($Email)){
         
            $_SESSION['ErrorMessage'] = "Email exists!! Please try different Email";
            Redirect_to("login.php");

        
        }else{

       
       $conn;
       $sql       = "INSERT INTO user(email,password,time) VALUES (:EMail,:PAssword,:DAte)";
       $stmt            = $conn->prepare($sql);
       $Execute         = $stmt->execute([
           
           ':EMail'         => $Email,
           ':PAssword'      => $PasswordHashed,
           
           ':DAte'           => $Time,
           
       ]);
       
       if($Execute){
           $_SESSION['SuccessMessage'] = 'Admin  registered successfully';
           Redirect_to('login.php');
       }else{
           $_SESSION['ErrorMessage']   = 'Something techinical issue happened on admin page';
           Redirect_to('register.php');
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
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" action="register.php" method="POST">
                
                

                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                  </div>
                 
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>


                  <div class="form-group">
                    <input type="password" name="conpassword" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Confirm Password">
                  </div>
                
                  <div class="mt-3">
                    <button type="submit" name="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >SIGN UP</button>
                   
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      
    </div>



<?php require_once "includes/footer.php"; ?>