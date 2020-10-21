<?php
  require 'indexHead.php';
?>

<?php 

  if(isset($_POST['Submit'])){
      $logins = array('root' => 'aaa','username1' => 'password1','username2' => 'password2');
      $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
      $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
      if (isset($logins[$Username]) && $logins[$Username] == $Password){
          /* Success: Set session variables and redirect to Protected page  */
          $_SESSION['UserData']['Username']=$logins[$Username];
          header("location:index.php");
          exit;
      } else {
      /*Unsuccessful attempt: Set error message */
      $msg="<span style='color:red'>Invalid Login</span>";
      }
  }

?>



<style>

    .loginTable{
      width: 80%;
      max-width: 500px;
      margin: auto;
      margin-top: 33vh;
      margin-left: auto;
      margin-right: auto;
    }

    .buttonForm{
        cursor: pointer;
        font-size: 1.5em;
    }

    .BTlogout{
      width: auto !important;
      z-index: 1;
      position: absolute;
      right: 25px;
      margin: 5px !important;
      top: 12px !important;
    }

    .BTlogin{
        /* cursor: pointer;
        font-size: 1.5em; */
    }

    .BTCancel{
        background-color: darkgray !important;
    }

    .BTCancel:hover{
        background-color: gray !important;
    }

* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

input[type=password], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

/* 
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
} */

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

input[type=button] {
  background-color: darkred;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: left;
}

input[type=button]:hover {
  background-color: red;
}

</style>

<body>
    <div class="container">

        <?php
        require 'indexNavbar.php';
        ?>

        <?php if (isset($_SESSION['UserData']['Username'] )) {?>
                <input class="BTlogout buttonForm" id="BTlogout" type="button" onclick="location.href='logout.php'" value="Logout"/>
        <?php } ?>

        <?php 
        
          if (!isset($_SESSION['UserData']['Username'] )) {
            require 'loginForm.php';
          } 
        ?>

    </div>



</body>

<script type="text/javascript" src="js/navbar.js"></script>

</html>



