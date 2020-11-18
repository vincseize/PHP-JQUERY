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

/* global $ */





$(function () {
  'use strict';


  let url_string = window.location.href;
  let url = new URL(url_string);
  const gallery = url.searchParams.get("g");

  let href = url_string.substring(0, url_string.lastIndexOf('/')) + "/";
  
  function moveToGalleries(){
    console.log("fileuploaddone event fired");
    console.log(gallery);
    $.ajax({
      url: 'moveToGalleries.php', //This is the current doc
      type: "POST",
      data: ({'gallery': gallery}),
      success: function(data){
          console.log(data);
      }
    }); 
  }







  // Initialize the jQuery File Upload widget:
  $('#fileupload').fileupload({
    // Uncomment the following to send cross-domain cookies:
    //xhrFields: {withCredentials: true},
    // url: 'server/php/',
    url: ''+href+'server/php/index.php?g='+gallery+'',
    disableImageResize: false,
    imageMaxWidth: 1200,
    // imageMaxHeight: 800,
    // imageCrop: true

    // disableImageResize: false,
    // imageMaxWidth: 800,
    // imageMaxHeight: 800,
    // imageCrop: true

  });

  // Enable iframe cross-domain access via redirect option:
  $('#fileupload').fileupload(
    'option',
    'redirect',
    window.location.href.replace(/\/[^/]*$/, '/cors/result.html?%s')
  );

  $("#fileupload").bind("fileuploaddone", function (e, data) {
    moveToGalleries();
  });

  if (window.location.hostname === 'blueimp.github.io') {
    // Demo settings:
    $('#fileupload').fileupload('option', {
      url: '//jquery-file-upload.appspot.com/',
      // Enable image resizing, except for Android and Opera,
      // which actually support image resizing, but fail to
      // send Blob objects via XHR requests:
      disableImageResize: /Android(?!.*Chrome)|Opera/.test(
        window.navigator.userAgent
      ),
      maxFileSize: 999000,
      acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
    });
    // Upload server status check for browsers with CORS support:
    if ($.support.cors) {
      $.ajax({
        url: '//jquery-file-upload.appspot.com/',
        type: 'HEAD'
      }).fail(function () {
        $('<div class="alert alert-danger"></div>')
          .text('Upload server currently unavailable - ' + new Date())
          .appendTo('#fileupload');
      });
    }
  } else {
    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
      // Uncomment the following to send cross-domain cookies:
      //xhrFields: {withCredentials: true},
      url: $('#fileupload').fileupload('option', 'url'),
      dataType: 'json',
      context: $('#fileupload')[0]
    })
      .always(function () {
        $(this).removeClass('fileupload-processing');
      })
      .done(function (result) {
        $(this)
          .fileupload('option', 'done')
          // eslint-disable-next-line new-cap
          .call(this, $.Event('done'), { result: result });
      });
  }
});
