<div class="header bar bar-2" style="position: fixed;z-index:1;overflow: hidden;">

<div id="divLogo" class="icon-1 divLogo"><img class="iconLogo" src="img/logoNavbar.png"></div>
<div class="icon icon-3"></div>
<div id="titleSiteName" class="titleSiteName titleSite">
  <?php echo $nameGallerie; ?>
</div>

<?php 



$fileName =  basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
// if ($fileName == "login.php" || $fileName == "edit.php") {
if ($fileName == "login.php" || isset($_GET['i']) ) {
    // $styleDiplayNone = ' style="display:none !important"';
    $styleOpacityNone = ' style="opacity:0 !important;z-index:-1;position:absolute;top:-100px;"';
} else {
    // $styleDiplayNone = ' style="display:block !important"';
    $styleOpacityNone = ' style="opacity:100 !important"';
}

if (!isset($_SESSION['UserData']['Username'] ) && $fileName == "edit.php") {
    header("location:logout.php");  
}

?>

        <div class="search" 
        <?php echo $styleOpacityNone;?>
        >
            <form>
                <input id="searchInput" type="search" class="searchInputIcon" placeholder="search..." />
                <button id="close-icon" class="close-icon" type="reset"></button>
            </form>
        </div>


    <div>
        <?php if (isset($_SESSION['UserData']['Username'] )) {?>
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