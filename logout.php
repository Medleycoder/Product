<?php require_once "includes/function.php";
      require_once "includes/session.php";

      $_SESSION['UserId']      = null;
      $_SESSION['UserEmail']   = null;
      

      session_destroy();
      Redirect_to("login.php");