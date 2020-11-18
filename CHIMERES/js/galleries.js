
$(document).ready(function(){


    // VARIABLES
    const rangeInput = document.querySelector('input[type = "range"]');
    const imageList = document.querySelector(".image-list");
    const searchInput = document.querySelector('input[type="search"]');
    const btns = document.querySelectorAll(".view-options button");
    // const photosCounter = document.querySelector(".toolbar .counter span");
    const photosCounter = document.querySelector(".total2");
    const imageListItems = document.querySelectorAll(".image-list li");
    // const captions = document.querySelectorAll(".image-list figcaption p:first-child");
    const captions = document.querySelectorAll(".figcaption");
    const myArray = [];
    let counter = 1;
    const active = "active";
    const listView = "list-view";
    const gridView = "grid-view";
    const dNone = "d-none";

    const url_string = $(location).attr('href');

    const BTAddGallery = document.getElementById("BTAddGallery");
    const BTEditGallery = document.getElementById("BTEditGallery");
    const inputG = document.getElementById("GalleryNameAdd");
    const GalleryNameAddInfos = document.getElementById("GalleryNameAddInfos");

    const minLengthG = 1;
    const maxLengthG = 16;

    const imgGridGallery = document.querySelector(".imgGridGallery");


    try {
      $(inputG).bind("change paste keyup", function() {
        var value = $(this).val();
        if (value.length < minLengthG){
            $(BTAddGallery).attr("style", "display:none");
        }
        if (value.length > maxLengthG){
            $(GalleryNameAddInfos).text("Name is long");
            $(BTAddGallery).attr("style", "display:none");
        } 
        if ((value.length >= minLengthG) && (value.length < maxLengthG)){
            $(BTAddGallery).attr("style", "display:block");
        }
    });
  } catch (error) {
    // console.error(error);
  }

    try {
      BTAddGallery.addEventListener("click", function() {
        addGalleryFolder();
      }, false);
    } catch (error) {
        // console.error(error);
    }

    try {
      BTEditGallery.addEventListener("click", function() {
        editGalleryFolder();
      }, false);
    } catch (error) {
        // console.error(error);
    }

    function cleanGalleryName(gallery){
      // gallery = gallery.replace(/[^a-zA-Z ]/g, "");
      // gallery = gallery.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
      gallery = gallery.replace(/[`~!@#$%^&*()|+\=?;:'",.<>\{\}\[\]\\\/]/gi, '');
      return gallery;
    }

    function addGalleryFolder(){
      // console.log('addGalleryFolder');
      gallery = document.getElementById("GalleryNameAdd").value;
      // gallery = gallery.replace(/[^a-zA-Z ]/g, "");
      gallery = cleanGalleryName(gallery);
      if(gallery.length === 0) {
        alert('At Least one Character!');
        // window.location = "edit.php?g="+folder;
      } else {
      // console.log(gallery);
      // window.location = "edit.php?g="+gallery;

        $.ajax({
            url: "createFolder.php",                        
            type: "GET",
            data : 'folder=' + gallery,
            success: function(msg){
                alert(msg);
                if(msg='Gallery Already Exist'){
                  // alert('gae');
                  window.location = "edit.php?g="+gallery;
                } 
                if(msg='Gallery Created'){
                  // alert('gae');
                  window.location = "indexGallery.php?g="+gallery;;
                } 
                // Gallery Created
                // else {window.location = "indexGallery.php?g="+gallery;}
                // indexGallery.php?g=Clem

            },
            error : function(msg, statut, erreur){
              alert(msg);
              // window.location = "edit.php?g=new&add="+gallery;
            },
            complete : function(msg, statut){
              // if(msg='Gallery Already Exist'){
              //   // alert('gae');
              //   window.location = "edit.php?g=new&add="+gallery;
              // } else {window.location = "edit.php?g="+gallery;}
              
            }
        });
      }


    }

    function editGalleryFolder(){
      // console.log('editGalleryFolder');
      gallery = document.getElementById("newGalleryName").value;
      folder = document.getElementById("oldGalleryName").value;
      if(gallery.length === 0) {
        alert('At Least one Character!');
        window.location = "edit.php?g="+folder;
      } else {


        // gallery = gallery.replace(/[^a-zA-Z ]/g, "");
        gallery = cleanGalleryName(gallery);
        // console.log(gallery);
        // window.location = "edit.php?g="+gallery;

        $.ajax({
            url: "createFolder.php",                        
            type: "GET",
            // data : 'u=' + gallery,
            data: {'oldFolderName': folder, 'u': gallery},
            // oldGalleryName
            success: function(msg){
                // alert("Gallery Updated");
                alert(msg);
            },
            error : function(msg, statut, erreur){
              alert(msg);
              // alert(msg);alert(msg);
            },
            complete : function(msg, statut){
              window.location = "edit.php?g="+gallery;
            }
        });

      }

    }

    function goEditGallery(gallery){
      // console.log(gallery);
      window.location = "edit.php?g="+gallery;
    }

    function goEditImage(gallery,image){
      window.location = "edit.php?g="+gallery+"&i="+image;
    }

    function hidePopup(){
      $('.cd-popup').removeClass('is-visible');
    }

    function initEditGalleriesImages(){


      // function imgGridGallery_GO(){
        $(".imgGridGallery").each(function(){
          $(this).click(function() {
            gallery = $(this).attr("data-gallery");
            img = $(this).attr("data-image");
            let url_player = "img/galleryPlayer/index.php?g="+gallery+'&i='+img;
            window.location = url_player;
          });
        });

      $(".iconEditG").each(function(){
        $(this).click(function() {
          hidePopup();
          // $('.cd-popup_DelImg').removeClass('is-visible');
          gallery = $(this).attr("data-gallery");
          // console.log(gallery);
          goEditGallery(gallery);
        });
      });

      $(".iconEditI").each(function(){
        $(this).click(function() {
          hidePopup();
          // $('.cd-popup_DelImg').removeClass('is-visible');
          gallery = $(this).attr("data-gallery");
          image = $(this).attr("data-image");
          // console.log(gallery);
          goEditImage(gallery,image);
        });
      });

    }


    // SET VIEW
    for (const btn of btns) {
      btn.addEventListener("click", function() {
        const parent = this.parentElement;
        document.querySelector(".view-options .active").classList.remove(active);
        parent.classList.add(active);
        this.disabled = true;
        document.querySelector('.view-options [class^="show-"]:not(.active) button').disabled = false;
    
        if (parent.classList.contains("show-list")) {
          parent.previousElementSibling.previousElementSibling.classList.add(dNone);
          imageList.classList.remove(gridView);
          imageList.classList.add(listView);
        } else {
          parent.previousElementSibling.classList.remove(dNone);
          imageList.classList.remove(listView);
          imageList.classList.add(gridView);
        }
      });
    }
    
    // SET THUMBNAIL VIEW - CHANGE CSS VARIABLE
    // rangeInput.addEventListener("input", function() {
    //   document.documentElement.style.setProperty("--minImgWidth",`${this.value}px`);
    // });

    try {
      rangeInput.addEventListener("input", function() {
        document.documentElement.style.setProperty("--minImgWidth",`${this.value}px`);
      }, false);
      } catch (error) {
        // console.error(error);
      }

    
    // SEARCH FUNCTIONALITY
    for (const caption of captions) {
      myArray.push({
        id: counter++,
        text: caption.textContent
      });
    }
    
    searchInput.addEventListener("keyup", keyupHandler);
    
    function keyupHandler() {
        // console.log('x');
      for (const item of imageListItems) {
        item.classList.add(dNone);
      }
      const text = this.value;
      // const filteredArray = myArray.filter(el => el.text.includes(text)); // search exact case
      const filteredArray = myArray.filter(el => el.text.toLowerCase().includes(text)); // search upper and lowercase
      if (filteredArray.length > 0) {
        for (const el of filteredArray) {
          document.querySelector(`.image-list li:nth-child(${el.id})`).classList.remove(dNone);
          $(".cancel").css("display", "none");
        }
      }
      if (filteredArray.length == 0) {
        $(".cancel").css("display", "block");
      }
      photosCounter.textContent = filteredArray.length + ' / ';

    }
    
    $("#CANCEL").click(function(){
      location.reload();
      $("#CANCEL").hide();
    });
    
// ---------------------- Init

initEditGalleriesImages();
// initEditGallery();
// initEditImage();


});


    
    
 