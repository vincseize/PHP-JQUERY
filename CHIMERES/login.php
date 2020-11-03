<?php
  require 'indexHead.php';
?>

<?php 

  if(isset($_POST['Submit'])){
      $logins = array('root' => 'normandus','admin' => 'aaa','username2' => 'password2');
      $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
      $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
      if (isset($logins[$Username]) && $logins[$Username] == $Password){
          $_SESSION['UserData']['Username']=$logins[$Username];
          header("location:index.php");
          exit;
      } else {
      $msg="<span style='color:red'>Invalid Login</span>";
      }
  }

?>

<body>
    <div class="container">

        <?php
        require 'indexNavbar.php';
        ?>

        <?php if (isset($_SESSION['UserData']['Username'] )) {?>
                <input class="BTlogout buttonForm" id="BTlogout" type="button" onclick="location.href='logout.php'" value="Logout"/>
        <?php } ?>

        <?php 
          // echo $fileName;
          
          if (!isset($_SESSION['UserData']['Username']) && $fileName == "login.php") {
            require 'loginForm.php';
          } 
        ?>

    </div>



</body>

<script type="text/javascript" src="js/navbar.js"></script>

</html>



