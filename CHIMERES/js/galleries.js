
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
    
    // const iconEditG = document.querySelector(".iconEditG");
    // const iconEditI = document.querySelector(".iconEditI");

    const url_string = $(location).attr('href');
    // const url = new URL(url_string);
    // const gallery = url.searchParams.get("g");


    function goEditGallery(gallery){
      console.log(gallery);
      window.location = "edit.php?g="+gallery;
    }

    function goEditImage(gallery,image){
      console.log(image);
      window.location = "edit.php?g="+gallery+"&i="+image;
    }

    function initEditGallery(){
      $(".iconEditG").each(function(){
        $(this).click(function() {
          gallery = $(this).attr("data-gallery");
          // console.log(gallery);
          goEditGallery(gallery);
        });
      });
    }

    function initEditImage(){
      $(".iconEditI").each(function(){
        $(this).click(function() {
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

initEditGallery();
initEditImage();


});


    
    
 