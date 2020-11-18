<?php 

session_start(); 

require '../session.php';
require '../fcts.php';

$dir = 'server'.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.$_SESSION["g"].'_'.$_SESSION["signin"];
if (file_exists($dir)) {
  rrmdir($dir);
}
mkdir($dir);
sleep(1);
?>

<!DOCTYPE html>
<!--
/*
 * jQuery File Upload Demo
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */
-->
<html lang="en">
  <head>
    <!-- Force latest IE rendering engine or ChromeFrame if installed -->
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <![endif]-->
    <meta charset="utf-8" />
    <title><?php echo $_SESSION["TITLE_SITE"];?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" href="../img/favicons/favicon-16.svg" type="image/svg+xml" />

    <script src="js/jquery.min.js"></script>

    <link rel="stylesheet" href="../css/navbar.css"/>
    <link rel="stylesheet" href="../css/galleries.css"/>

    <!-- Bootstrap styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <!-- Generic page styles -->
    <style>

      .BtBack {
        position: fixed;
        z-index: 9999;
        top: 30px;
        right: 20px;
        width: 100px !important;
        font-size: 20px;
        font-weight: bold;
        /* display: none; */
      }

.title{
  margin-top: 100px !important;
  margin-left: 15px;
}

      #fileupload {
        min-height: 55vh;
        border: 4px dashed rgba(28,110,164,0.20);
        border-radius: 10px;
        /* margin: 15px !important; */
        margin-top: 20px !important;
      }

      .margin {
        margin: 15px !important;
      }

      @media (max-width: 651px) {

        #fileupload {
          min-height: 45vh;
          margin-top: 220px !important;
        }

        /* #title,
        #description {
          display: none;
        } */
      }

    </style>
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="css/blueimp-gallery.min.css"/>
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css" />
    <link rel="stylesheet" href="css/jquery.fileupload-ui.css" />
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript
      ><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"
    /></noscript>
    <noscript
      ><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"
    /></noscript>
  </head>
  <body>
    <div class="container">

    <?php
      require '../indexNavbar.php';
    ?>

<span class="title"><strong>GALLERY</strong> | <?php echo $_SESSION["g"];?></span>

    <button type="submit" id="BtBack" class="btn btn-primary BtBack" data-target="../indexGallery.php?g=<?php echo $_SESSION["g"];?>">
      <span>Back</span>
    </button>

      <!-- <button type="button" class="btn btn-primary">BACK</button> -->
      <!-- <a id="BtBack" class="BtBack" href="../indexGallery.php?g=<?php echo $_SESSION["g"];?>" class="btn btn-primary btn-lg" role="button">BACK</a> -->

     


      <!-- The file upload form used as target for the file upload widget -->
      <form
        id="fileupload"
        action="index.php"
        method="POST"
        enctype="multipart/form-data"
        class="margin"
        >
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript
          ><input
            type="hidden"
            name="redirect"
            value="../indexGallery.php?g=<?php echo $_SESSION["g"];?>"
        /></noscript>





        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
          <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Add files...</span>
              <input type="file" name="files[]" multiple />
            </span>
            <button type="submit" class="btn btn-primary start">
              <i class="glyphicon glyphicon-upload"></i>
              <span>Start upload</span>
            </button>
            <button type="reset" class="btn btn-warning cancel">
              <i class="glyphicon glyphicon-ban-circle"></i>
              <span>Cancel upload</span>
            </button>
            <button type="button" class="btn btn-danger delete">
              <i class="glyphicon glyphicon-trash"></i>
              <span>Delete selected</span>
            </button>
            <input type="checkbox" class="toggle" />
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
          </div>
          <!-- The global progress state -->
          <div class="col-lg-5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div
              class="progress progress-striped active"
              role="progressbar"
              aria-valuemin="0"
              aria-valuemax="100"
            >
              <div
                class="progress-bar progress-bar-success"
                style="width: 0%;"
              ></div>
            </div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
          </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped">
          <tbody class="files"></tbody>
        </table>
      </form>
      <div class="panel panel-default margin">
        <div class="panel-heading">
          <h3 class="panel-title">Notes</h3>
        </div>
        <div class="panel-body">
          <ul>
            <li>
              The maximum file size for uploads in this demo is
              <strong>13 MO</strong> (to increase).
            </li>
            <li>
              Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in
              this demo (soon <strong>mp4</strong>).
            </li>
            <li>
              You can <strong>drag &amp; drop</strong> files from your desktop
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- The blueimp Gallery widget -->
    <div
      id="blueimp-gallery"
      class="blueimp-gallery blueimp-gallery-controls"
      aria-label="image gallery"
      aria-modal="true"
      role="dialog"
      data-filter=":even"
    >
      <div class="slides" aria-live="polite"></div>
      <h3 class="title"></h3>
      <a
        class="prev"
        aria-controls="blueimp-gallery"
        aria-label="previous slide"
        aria-keyshortcuts="ArrowLeft"
      ></a>
      <a
        class="next"
        aria-controls="blueimp-gallery"
        aria-label="next slide"
        aria-keyshortcuts="ArrowRight"
      ></a>
      <a
        class="close"
        aria-controls="blueimp-gallery"
        aria-label="close"
        aria-keyshortcuts="Escape"
      ></a>
      <a
        class="play-pause"
        aria-controls="blueimp-gallery"
        aria-label="play slideshow"
        aria-keyshortcuts="Space"
        aria-pressed="false"
        role="button"
      ></a>
      <ol class="indicator"></ol>
    </div>
    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-upload fade{%=o.options.loadImageFileTypes.test(file.type)?' image':''%}">
              <td>
                  <span class="preview"></span>
              </td>
              <td>
                  <p class="name">{%=file.name%}</p>
                  <strong class="error text-danger"></strong>
              </td>
              <td>
                  <p class="size">Processing...</p>
                  <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
              </td>
              <td>
                  {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                    <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                        <i class="glyphicon glyphicon-edit"></i>
                        <span>Edit</span>
                    </button>
                  {% } %}
                  {% if (!i && !o.options.autoUpload) { %}
                      <button class="btn btn-primary start" disabled>
                          <i class="glyphicon glyphicon-upload"></i>
                          <span>Start</span>
                      </button>
                  {% } %}
                  {% if (!i) { %}
                      <button class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-download fade{%=file.thumbnailUrl?' image':''%}">
              <td>
                  <span class="preview">
                      {% if (file.thumbnailUrl) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                      {% } %}
                  </span>
              </td>
              <td>
                  <p class="name">
                      {% if (file.url) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                      {% } else { %}
                          <span>{%=file.name%}</span>
                      {% } %}
                  </p>
                  {% if (file.error) { %}
                      <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                  {% } %}
              </td>
              <td>
                  <span class="size">{%=o.formatFileSize(file.size)%}</span>
              </td>
              <td>
                  {% if (file.deleteUrl) { %}
                      <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                          <i class="glyphicon glyphicon-trash"></i>
                          <span>Delete</span>
                      </button>
                      <input type="checkbox" name="delete" value="1" class="toggle">
                  {% } else { %}
                      <button class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
    </script>
    <script
      src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"
      integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
      crossorigin="anonymous"
    ></script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="js/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="js/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="js/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="js/demo.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
      <script src="js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->

      <script>

$(document).ready(function() {

      function back(url){
        event.preventDefault(); 
        console.log(url);
        location.replace(url);
      }

      const BtBack = document.getElementById("BtBack");
      BtBack.addEventListener("click", function(){back($(this).data('target'));}, false);

      $('.panel').delay(3000).fadeOut('slow');

      function hideBorder() {     
        $('#fileupload').css('border', '4px solid white');
      }

      setTimeout(hideBorder, 3000)


});
      </script>


  </body>
</html>
