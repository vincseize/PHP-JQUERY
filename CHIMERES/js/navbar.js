const titleSiteName = document.getElementById("titleSiteName");
const logo = document.getElementById("divLogo");
const b = document.getElementById("close-icon");
const sp = document.getElementById("searchInput");

const imgF = document.getElementById("imgFolder");
const iconUpload = document.getElementById("iconUpload");
const iconAdd = document.getElementById("iconAdd");
const iconParam = document.getElementById("iconParam");

const href = $(location).attr('href');

titleSiteName.addEventListener("click", function() {
  goHome();
}, false);
logo.addEventListener("click", function() {
  goHome();
}, false);
b.addEventListener("click", function() {
  hideClearButton();
}, false);
sp.addEventListener("input", function() {
  showClearButton();
}, false);

try {
  imgF.addEventListener("imgFolder", function() {
    imgFolder();
  }, false);
  } catch (error) {
    // console.error(error);
}

try {
  iconParam.addEventListener("click", function() {
    settings();
  }, false);
  } catch (error) {
    // console.error(error);
}

try {
  iconUpload.addEventListener("click", function() {
    upload();
  }, false);
  } catch (error) {
    // console.error(error);
}

try {
  iconAdd.addEventListener("click", function() {
    addCategorie();
  }, false);
  } catch (error) {
    // console.error(error);
}

sp.addEventListener('input', evt => {
  const value = sp.value.trim()
  if (value) {
    // console.log('not empty')
  } else {
    hideClearButton()
  }
})

// Fcts

function settings() {
  window.location = "login.php";
}

function addCategorie(){
  console.log('categorie add');
  window.location = "edit.php?g=new&add=gallerie";
}

function upload() {
  console.log('upload');
  console.log(href);
}

function imgFolder(folder) {
  window.location = "indexGallery.php?g="+folder;
}

function goHome() {
  // console.log('goHome');
  // b.style.opacity = 0;
  window.location = "index.php";
}

function reload() {
  // console.log('reload');
  window.location = href;
}

function hideClearButton() {
  b.style.opacity = 0;
  reload();
}

function showClearButton() {
  b.style.opacity = 100;
}

function topFunction() {
  window.location.href = "#top";
}

function toggleParamIcon() {
  if(LOGGED==true){
    $('#iconParam').css('opacity', LOGGED ? '1' : '0.8');
  }
}

// Events

  window.addEventListener("scroll", function() { 
    
    let scrollHeight = $(document).height();
    let scrollPosition = $(window).height() + $(window).scrollTop();
  
    if ($(this).scrollTop() > 0) {
      $('.header').fadeOut(1000);
      $('.toolbar').fadeOut(1000);
      $('.divTotal2').fadeOut(1000);
    } else {
      $('.header').fadeIn(1000);
      $('.toolbar').fadeIn(1000);
      $('.divTotal2').fadeIn(1000);
    }
  
    if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
      // when scroll to bottom of the page
      $('.footerHome').fadeIn(500);
      // console.log('bottom');
    } else {
      $('.footerHome').fadeOut(1000);
      // console.log('not b');
    }

    if ( scrollPosition > scrollHeight * 2) {
      $('.scrollTopButton').fadeIn(1000);
      // console.log(scrollPosition);
      // console.log(scrollHeight);
    } else {
      $('.scrollTopButton').fadeOut(500);
    }


});


// window.addEventListener("load", function() { 
//     const iconParam = document.getElementById("iconParam");
//     if(LOGGED==true){
//       // console.log(LOGGED);
//       // $('#iconParam').css('opacity', '1');
//       $('#iconParam').css('opacity', LOGGED ? '1' : '0.8');
//     }
// });

// ------------------------ Init

function init() {
  toggleParamIcon();
}

init();





