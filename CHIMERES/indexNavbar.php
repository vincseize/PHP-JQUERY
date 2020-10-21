<div class="header bar bar-2" style="position: fixed;z-index:1;overflow: hidden;">

<div id="divLogo" class="icon-1 divLogo"><img class="iconLogo" src="img/logoNavbar.png"></div>
<div class="icon icon-3"></div>
<div id="titleSiteName" class="titleSiteName titleSite">
  <?php echo $nameGallerie; ?>
</div>

<?php 

$fileName =  basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
if ($fileName == "login.php" ) {
    $styleDiplayNone = ' style="display:none !important"';
    $styleOpacityNone = ' style="opacity:0 !important"';
} else {
    $styleDiplayNone = ' style="display:block !important"';
    $styleOpacityNone = ' style="opacity:100 !important"';
}
?>



    <div class="search" <?php echo $styleDiplayNone;?>>
        <form>
            <input id="searchInput" type="search" class="searchInputIcon" placeholder="search..." />
            <button id="close-icon" class="close-icon" type="reset"></button>
        </form>
    </div>

    <div <?php echo $styleDiplayNone;?>>
        <img id="iconParam" class="iconParam" src="img/favicons/icon_param.png" <?php echo $styleDiplayNone;?>>
    </div>

</div>