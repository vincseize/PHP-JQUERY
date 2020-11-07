<?php
  require 'indexHead.php';
  ?>

  <body>
  <div class="container">

      <?php
      require 'indexNavbar.php';
      ?>


<div class="marginLoginEdit editDiv">
        <br><br>
          <span>


<?php
function writeBack($url){
    echo "<br><br>";
    echo "<input type='button' value='BACK' onclick=\"location.href='".$url."'\" class='backEdit'>";
}

if ($_GET['g']) {

        $maxFileSize = 1024000; //1Mo
        $maxFileSize = 2048000; //2Mo
        $maxFileSize = 4096000; //4Mo
        $maxFileSize = 8192000; //8Mo
        $maxFileSize = 16384000; //16Mo

        $gallery = $_GET['g'];
        $url = "indexGallery.php?g=".$gallery;

        // This is an array that holds all the valid image MIME types
        $valid_types = array("jpg", "jpeg", "gif", "png");

        $target_dir = 'img'.DIRECTORY_SEPARATOR.'galleries'.DIRECTORY_SEPARATOR.$_GET['g'];
        $target_file = $target_dir .DIRECTORY_SEPARATOR. basename($_FILES["fileUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $imageFileName = pathinfo($target_file, PATHINFO_FILENAME);

        // echo $imageFileName;
        // exit;

        $target_file_comp = $target_dir .DIRECTORY_SEPARATOR . $imageFileName .DIRECTORY_SEPARATOR.$imageFileType;

        $uploadOk = 1;

        // echo $imageFileType."<br>";


        // echo $target_file."<br>";
        // echo $target_file_comp."<br>";
        // exit;

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileUpload"]["size"] > $maxFileSize) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
        }

        // Unallow certain file formats
        // if (!in_array($imageFileType, $valid_types)){
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, <br>only JPG, JPEG, PNG & GIF files <br>are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Your file was not uploaded.";
        writeBack($url);
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            // echo  htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";
            $compressed = compressGD($target_file, $target_file_comp, 50);
            // header("location:indexGallery.php?g=".$_GET['g']); 
            echo "<script>window.location.replace(\"indexGallery.php?g=".$_GET['g']."\");</script>";
        } else {
            echo "Sorry, <br>error on uploading.";
            writeBack($url);
        }
        }

}

?>



<span>
        </div>



    </div>



</body>

<script type="text/javascript" src="js/navbar.js"></script>

</html>