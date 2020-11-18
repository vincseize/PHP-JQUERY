<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<div class="header bar bar-2" style="position: fixed;z-index:1;overflow: hidden;">

    <div id="divLogo" class="icon-1 divLogo"><img class="iconLogo" src="<?php echo $_SESSION["ROOT_URL_IMG"];?>/img/logoNavbar.png"></div>
    <div class="icon icon-3"></div>
    <div id="titleSiteName" class="titleSiteName titleSite">
    <?php echo $_SESSION["NAME_GALLERY"]; ?>
    </div>

    <?php 

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $fileName =  basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

    if ($fileName == "login.php" || $fileName == "upload.php" || $fileName == "edit.php" || strpos($actual_link, 'BlueImp') !== false) {
        $styleOpacityNone = ' style="opacity:0 !important;position:absolute;top:-100px;z-index:-1;"';
    } else {
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
        <?php if (isset($_SESSION['UserData']['Username'] ) && $fileName != "edit.php" && $fileName == "index.php" && strpos($actual_link, 'BlueImp') === false) {?>
            <img id="iconAdd" class="iconAdd" src="<?php echo $_SESSION["ROOT_URL_IMG"];?>/img/icon_add.png">
        <?php } ?>

        <?php if (isset($_SESSION['UserData']['Username'] ) && $fileName != "edit.php" && $fileName != "index.php" && isset($_GET["g"])) 
        {?>
            <img id="iconUpload" class="iconUpload" src="<?php echo $_SESSION["ROOT_URL_IMG"];?>/img/icon_upload.png">
        <?php } ?>
    </div>

    
    <div <?php 
    echo $styleOpacityNone;
    ?>
    >
        <img id="iconParam" class="iconParam" src="<?php echo $_SESSION["ROOT_URL_IMG"];?>/img/icon_param.png">
    </div>
</div>
<!--<div class="popup-container">-->
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
<!--</div>-->

<script>

jQuery(document).ready(function($){

    const titleSiteName = document.getElementById("titleSiteName");
    const logo = document.getElementById("divLogo");

    titleSiteName.addEventListener("click", function() {
        goHome();
    }, false);
    logo.addEventListener("click", function() {
        goHome();
    }, false);

    $('.closePopup').on('click', function(event){
        $('*[data-divGallery]').css("border","none");
        closePopup();
    });

    $('.iconDeleteG').on('click', function(event){
        event.preventDefault();
        let gallery = $(this).attr("data-gallery");
        // let divgGallery = $(this).attr('data-gallery');
        $('*[data-divGallery="'+gallery+'"]').css("border","red solid 4px");
        $('#cd-popup_DelGallery').css('display','block');
        $('#cd-popup_DelGallery').addClass('is-visible');
        goDeleteGallery(gallery);   
    });

    function goDeleteGallery(gallery){
        let url = "edit.php?g="+gallery+"&dg="+gallery;
        $("#btPopupYES_gal").attr("href", url);
        $("#span_del_gallery").html(gallery);
        
    }

    function goHome() {
        let url_string = window.location.href;
        if(url_string.includes('BlueImp')){ 
            window.location = "../index.php";
        } else { 
            window.location = "index.php";
        }
    }

    function closePopup(){
        console.log('closePopup');
        $('#cd-popup_DelImg').css('display','none');
        $('#cd-popup_DelGallery').css('display','none');
        $(this).removeClass('is-visible');
    }

});

</script>

