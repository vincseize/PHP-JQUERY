<style>

:root {
  --width-case-bin  : 580px;
  --height-case-bin : 200px;

}

.div_case{
    /*display: inline-block;*/
  /*background-color: transparent;*/
  background: grey;
  border:1px solid grey;
}
.div_img_case{
    /*display: inline-block;*/
  background-color: transparent;
}


.div_input{
  z-index:101; /* // IMPORTANT*/
  position: relative;
}

/*.dragover{
    border:4px dotted blue;
}*/


.div_img_case img, .div_case, .div_img_case{
  width:var(--width-case-bin);
  height:var(--height-case-bin);
  max-width:var(--width-case-bin);
  max-height:var(--height-case-bin);
  padding:0;
  margin: 0;
}
.div_img_case img {
  z-index:100;
  position: absolute;
}

.input_case{
  position: absolute;
  padding:0;
  margin: 0;
  border: none;
  background-color: transparent;
  width:var(--width-case-bin);
  height:var(--height-case-bin);
  max-width:var(--width-case-bin);
  max-height:var(--height-case-bin);
  padding:0;
  margin: 0;
  opacity: 0;
}


[droppable] {
    width: var(--width-case-bin);
    height: var(--height-case-bin);
    border: 4px solid transparent;
    /*margin: 10px 0;
    text-align: center;
    font-weight: bold;
    padding-top: 80px;*/
}

[droppable].over {
    /*border-color: blue;*/
    border: 4px dotted green;
}

</style>

<script type='text/javascript' src='js/jquery-1.9.1.js'></script>

<div id="div_case_001" class="div_case" droppable="true">
    <div class="div_input">
        <input type='file' class="input_case" name="case_0001_bg" onchange="readURL(this);" />
    </div>
    <div class="div_img_case">
        <img id="case_0001_bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" />
    </div>
</div>

<br><br>

<div id="div_case_002" class="div_case" droppable="true">
    <div class="div_input">
        <input type='file'  class="input_case" name="case_0002_bg" onchange="readURL(this);"/>
    </div>
    <div class="div_img_case">
        <img id="case_0002_bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" />
    </div>
</div>

<!-- <div droppable="true">Drop to ME!</div> -->

<script>




$('[droppable="true"]').on('dragenter', function (event) {
        if($(this).hasClass("div_case")){
            // IE needs this event.
            $(this).addClass('over');
            //event.preventDefault();
        }
        event.defaultPrevented;
        return false;
    });

    $('[droppable="true"]').on('dragover', function (event) {
        if($(this).hasClass("div_case")){
            $(this).addClass('over');
            //event.preventDefault();
        }
        event.defaultPrevented;
        return false;
    });

    $('[droppable="true"]').on('dragleave', function (event) {
        if($(this).hasClass("div_case")){
            $(this).removeClass('over');
        }
    });

    $('[droppable="true"]').on('drop', function (event) {
        if($(this).hasClass("div_case")){
            $(this).removeClass('over');
        }
    });

















// upload JPEG files
function UploadFile(file,name,size,type,server) {



            //initiate request
            xhr = new XMLHttpRequest();
            xhr.open('post',server,true);

            //set headers
            xhr.setRequestHeader('Content-Type',"multipart/form-data");
            //xhr.setRequestHeader('X-File-Name',file.fileName);
            xhr.setRequestHeader('X-File-Name',name);
            xhr.setRequestHeader('X-File-Size',size);
            xhr.setRequestHeader('X-File-Type',type);

            //send the file
            xhr.send(file);

  // xhr.upload.onprogress = function(e) {
  //   if (e.lengthComputable) {
  //     var percentComplete = (e.loaded / e.total) * 100;
  //     console.log(percentComplete + '% uploaded');
  //   }
  // };
  // xhr.onload = function() {
  //   if (this.status == 200) {
  //     var resp = JSON.parse(this.response);
  //     console.log('Server got:', resp);
  //     var image = document.createElement('img');
  //     image.src = resp.dataUrl;
  //     document.body.appendChild(image);
  //   };
  // };
  // xhr.send(fd);

}

function readURL(input) {

            // $(this).addClass('div_case_hover');

            if (input.files && input.files[0]) {
                var file    = input.files[0];
                var name    = input.name;
                var size    = file.size;
                var type    = file.type;
                var server  = 'upload_case_bg.php';
                var reader  = new FileReader();
                reader.onload = function (e) {

  e.stopPropagation(); // Stops some browsers from redirecting.
  e.preventDefault();

                    preview = "#"+input.name;
                    $(preview).attr('src', e.target.result);
                    UploadFile(file,name,size,type,server);
                };
                reader.readAsDataURL(file);
            }
        }

</script>
