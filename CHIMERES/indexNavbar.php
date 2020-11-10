<div class="header bar bar-2" style="position: fixed;z-index:1;overflow: hidden;">

<div id="divLogo" class="icon-1 divLogo"><img class="iconLogo" src="img/logoNavbar.png"></div>
<div class="icon icon-3"></div>
<div id="titleSiteName" class="titleSiteName titleSite">
  <?php echo $nameGallerie; ?>
</div>

<?php 


$fileName =  basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
// if ($fileName == "login.php" || $fileName == "edit.php") {
if ($fileName == "login.php" || $fileName == "upload.php" || $fileName == "edit.php") {
    // $styleDiplayNone = ' style="display:none !important"';
    $styleOpacityNone = ' style="opacity:0 !important;position:absolute;top:-100px;z-index:-1;"';
} else {
    // $styleDiplayNone = ' style="display:block !important"';
    $styleOpacityNone = ' style="opacity:100 !important"';
}

if (!isset($_SESSION['UserData']['Username'] ) && $fileName == "edit.php") {
    header("location:logout.php");  
}

?>

    <div class="search"  >
        <form <?php echo $styleOpacityNone;?>>
            <input id="searchInput" type="search" class="searchInputIcon" placeholder="search..." />
            <button id="close-icon" class="close-icon" type="reset"></button>
        </form>
    </div>


    <div>
        <?php if (isset($_SESSION['UserData']['Username'] ) && $fileName != "edit.php" && $fileName == "index.php") {?>
            <img id="iconAdd" class="iconAdd" src="img/icon_add.png">
        <?php } ?>

        <?php if (isset($_SESSION['UserData']['Username'] ) && $fileName != "edit.php" && $fileName != "index.php" && isset($_GET["g"])) 
        {?>
            <img id="iconUpload" class="iconUpload" src="img/icon_upload.png">
        <?php } ?>
    </div>

    
    <div <?php 
    echo $styleOpacityNone;
    ?>
    >
        <img id="iconParam" class="iconParam" src="img/icon_param.png">
    </div>
    



</div>

<div class="cd-popup cd-popup_DelImg" id="cd-popup_DelImg" role="alert">
   <div class="cd-popup-container">
      <p>Are you sure you want to delete IMG</p>
      <p id="span_del_img">this element?</p>
      <ul class="cd-buttons">
         <li><a id="btPopupYES_img" class="btPopupYES closePopup" href="#">Yes</a></li>
         <li><a id="btPopupNO_img " class="btPopupNO closePopup" href="#">No</a></li>
      </ul>
      <a href="#" class="cd-popup-close img-replace closePopup"></a>
   </div> 
</div> 



<div class="cd-popup cd-popup_DelGallery" id="cd-popup_DelGallery" role="alert">
   <div class="cd-popup-container">
      <p>Are you sure you want to delete GALLERY</p>
      <p id="span_del_gallery">this element?</p>
      <ul class="cd-buttons">
         <li><a id="btPopupYES_gal" class="btPopupYES closePopup" href="#">Yes</a></li>
         <li><a id="btPopupNO_gal " class="btPopupNO closePopup" href="#">No</a></li>
      </ul>
      <a href="#" class="cd-popup-close img-replace closePopup"></a>
   </div> 
</div> 

<script>



jQuery(document).ready(function($){

    function closePopup(){
      console.log('closePopup');
      $('#cd-popup_DelImg').css('display','none');
      $('#cd-popup_DelGallery').css('display','none');
			$(this).removeClass('is-visible');
  }

  $('.closePopup').on('click', function(event){
      // console.log('NO');
      closePopup();
  });


$('.iconDeleteG').on('click', function(event){
    event.preventDefault();
    $('#cd-popup_DelGallery').css('display','block');
    $('#cd-popup_DelGallery').addClass('is-visible');
    // send href to yes button
    // send href to yes button

    gallery = $(this).attr("data-gallery");

    console.log(gallery);
    goDeleteGallery(gallery);
    

  });
  

  function goDeleteGallery(gallery){
      console.log(gallery);
      let url = "edit.php?g="+gallery+"&dg="+gallery;
      console.log(url);
    //   window.location = "edit.php?g="+gallery+"&dg="+gallery;
      $("#btPopupYES_gal").attr("href", url);
      $("#span_del_gallery").html(gallery);
      
  }




});

</script>

