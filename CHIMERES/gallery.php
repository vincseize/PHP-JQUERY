<section class="gallery">

        <div class="container containerGallery">

            <div class="toolbar">
              <ul class="view-options">
                <li class="zoom">
                  <input type="range" min="180" max="380" value="280">
                </li>
                <li class="show-grid active">
                  <button disabled>
                    <img src="img/grid-view.png" alt="grid view">  
                  </button>
                </li>
                <li class="show-list">
                  <button>
                    <img src="img/list-view.png" alt="list view">  
                  </button>
                </li>
              </ul>
            </div>

            <ol class="image-list grid-view">

            <!-- <a href="#0" class="iconDeleteI">View Pop-up</a> -->

                <?php 
                      if (isset($_SESSION['UserData']['Username'] )) {
                        require 'uploadForm.php';
                      } 
                      checkFirst_iconGallery($_GET['g']);
                      gridFolder('img'.DIRECTORY_SEPARATOR.'galleries'.DIRECTORY_SEPARATOR.$_GET['g']);
                ?>
            </ol>

        </div>

      </section>
   
          <!-- 
      <footer>
        <div class="container">
            <small>Footer</small>
            <small>
              Made with <span>❤</span> 
              by <a href="http://georgemartsoukos.com/" target="_blank">George Martsoukos</a>
            </small>       
        </div>
      </footer>

-->

<script>

jQuery(document).ready(function($){

  function closePopup(){
      console.log('closePopup');
      $('#cd-popup_DelImg').css('display','none');
      $('#cd-popup_DelGallery').css('display','none');
			$(this).removeClass('is-visible');
  }

  function goDeleteImage(gallery,image){
      console.log(gallery);
      console.log(image);
      let url = "edit.php?g="+gallery+"&d="+image;
      console.log(url);
      // window.location = "edit.php?g="+gallery+"&d="+image;
      $("#btPopupYES_img").attr("href", url);
      $("#span_del_img").html(image);
      
  }

  //open popup Confirm
  // cd-popup_DelImg-triggerDES
	$('.iconDeleteI').on('click', function(event){
    event.preventDefault();
    $('#cd-popup_DelImg').css('display','block');
    $('#cd-popup_DelImg').addClass('is-visible');
    // send href to yes button

    gallery = $(this).attr("data-gallery");
    image = $(this).attr("data-image");
    // console.log(gallery);
    console.log(image);
    goDeleteImage(gallery,image);
    

  });
  









	
	//close popup Confirm
	$('.cd-popup_DelImg').on('click', function(event){
		if( $(event.target).is('.cd-popup_DelImg-close') || $(event.target).is('.cd-popup_DelImg') ) {
      event.preventDefault();
      closePopup();
		}
	});
	//close popup Confirm when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
        closePopup();
	    }
    });

  // //close popup Confirm when clicking NO button
  // $('#btPopupNO_img').on('click', function(event){
  //     // console.log('NO');
  //     closePopup();
  // });
  
  // // close Confirm when clicking YES button
  // $('#btPopupYES_img').on('click', function(event){
  //     // console.log('YES');
  //     // console.log($(this));
  //     closePopup();
  // });

  // // close Confirm when clicking X (close) button
  // $('.cd-popup-close').on('click', function(event){
  //     // console.log('YES');
  //     // console.log($(this));
  //     closePopup();
  // });

  $('.closePopup').on('click', function(event){
      // console.log('NO');
      closePopup();
  });

});

</script>