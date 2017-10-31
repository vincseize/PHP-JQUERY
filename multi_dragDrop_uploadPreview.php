<style>

:root {
  --width-case-bin  : 580px;
  --height-case-bin : 200px;

  --width-case-bin-pb  : var(--width-case-bin);
  --height-case-bin-pb : 5px;
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




<style>
  .progressBar {
    margin: 0;
    padding: px;
    border: 1px solid #000;
    font-size: 0.6em;
    clear: both;
    opacity: 1.0;
    -moz-transition: opacity 1s linear;
    -o-transition: opacity 1s linear;
    -webkit-transition: opacity 1s linear;
    z-index: 9000;
    position:relative;
    /*top: calc(var(--height-case-bin)-5);*/
    top: 0;
    width:var(--width-case-bin-pb);
    height:var(--height-case-bin-pb);
    display: none;
  }
  .loading {
    opacity: 0.1;
    height:var(--height-case-bin-pb);
  }
  .percent {
    background-color: #99ccff;
    height: auto;
    width: 0;
    height:var(--height-case-bin-pb);
    text-shadow: #fff 1px 1px 1px;

  }
</style>





<script type='text/javascript' src='js/jquery-1.9.1.js'></script>






<div id="div_case_0001" class="div_case" droppable="true">
    <div class="div_input">
        <input type='file' class="input_case" name="case_0001_bg" onchange="uploadIMG(this);" />
    </div>
    <div class="div_img_case">
        <!-- grey img -->
        <img id="case_0001_bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" />
        <div id="case_0001_progressBar" class="progressBar"><div id="case_0001_progressPercent" class="percent">0%</div></div>
    </div>

</div>

<br><br>

<div id="div_case_0002" class="div_case" droppable="true">
    <div class="div_input">
        <input type='file'  class="input_case" name="case_0002_bg" onchange="uploadIMG(this);"/>
    </div>
    <div class="div_img_case">
        <img id="case_0002_bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" />
        <div id="case_0002_progressBar" class="progressBar"><div id="case_0002_progressPercent" class="percent">0%</div></div>
    </div>
</div>




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









// var progress = document.querySelector('.percent');
// var progressBar = document.querySelector('.progressBar');


  //
  // function errorHandler(evt) {
  //   switch(evt.target.error.code) {
  //     case evt.target.error.NOT_FOUND_ERR:
  //       alert('File Not Found!');
  //       break;
  //     case evt.target.error.NOT_READABLE_ERR:
  //       alert('File is not readable');
  //       break;
  //     case evt.target.error.ABORT_ERR:
  //       break; // noop
  //     default:
  //       alert('An error occurred reading this file.');
  //   };
  // }




function progressHandler(event, progressPercent,progressBar,name) {
    var percentLoaded = Math.round((event.loaded / event.total) * 100);

    var caseName =  name.split("_")[0]+"_"+name.split("_")[1];

console.log(progressPercent);
console.log(progressBar);
console.log(name);
console.log('-------CN----------');
console.log(caseName);
console.log('-----------------');


var progressPercent = document.querySelector('.percent');
var progressBar = document.querySelector('.progressBar');

console.log('-----------------');
console.log(progressPercent);
console.log(progressBar);
console.log('-----------------');
    // var progressPercent = document.querySelector('div.case_0002_progressPercent');
    // var progressBar = document.querySelector('div.case_0002_progressBar');

//     var progressPercent = document.getElementById('case_0002_progressPercent');
//     var progressBar = document.getElementById('case_0002_progressBar');
//
//
//
// console.log(progressPercent);
// console.log(progressBar);

console.log(caseName+"_progressPercent");
      if (percentLoaded <= 100) {
        // progressPercent.style.width = percentLoaded + '%';
        // progressPercent.textContent = percentLoaded + '%';

document.getElementById(caseName+"_progressBar").style.display='block';
document.getElementById(caseName+"_progressPercent").style.width=percentLoaded + '%';
document.getElementById(caseName+"_progressPercent").textContent=percentLoaded + '%';
      }

}

// upload JPEG files
function UploadFile(file,name,size,type,server,progressPercent,progressBar) {
    console.log('-----------------');
console.log(name);
console.log(progressPercent);
console.log(progressBar);
console.log('-----------------');


            //progressBar.style.display = 'block';
            $('.progressBar').hide();
            progressPercent.style.width = '0%';
            progressPercent.textContent = '0%';

            //initiate request
            xhr = new XMLHttpRequest();

            xhr.upload.addEventListener("progress", function (evt) {
                progressHandler(evt, progressPercent,progressBar,name);
            }, false);


            xhr.open('post',server,true);

            //set headers
            xhr.setRequestHeader('Content-Type',"multipart/form-data");
            //xhr.setRequestHeader('X-File-Name',file.fileName);
            xhr.setRequestHeader('X-File-Name',name);
            xhr.setRequestHeader('X-File-Size',size);
            xhr.setRequestHeader('X-File-Type',type);

            //send the file
            xhr.send(file);

    }

// https://stackoverflow.com/questions/12502482/creating-progress-bar-for-uploading-files-using-jquery-and-ajax

function uploadIMG(input) {

            // $(this).addClass('div_case_hover');

            if (input.files && input.files[0]) {
                var file    = input.files[0];
                var name    = input.name;
                var size    = file.size;
                var type    = file.type;
                var server  = 'upload_case_bg.php';

                var progressPercent = document.querySelector('.percent');
                var progressBar = document.querySelector('.progressBar');

                var reader  = new FileReader();
                reader.onload = function (e) {

                    preview = "#"+input.name;
                    $(preview).attr('src', e.target.result);
                    UploadFile(file,name,size,type,server,progressPercent,progressBar);

                    e.stopPropagation(); // Stops some browsers from redirecting.
                    e.preventDefault();

                };

                //  reader.onerror = errorHandler;
                //  reader.onprogress = updateProgress;
                //  reader.onabort = function(e) {
                //    alert('File read cancelled');
                //  };

                reader.readAsDataURL(file);
            }
        }

</script>
