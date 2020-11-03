<script>

$("document").ready(function(){

            $("#fileUpload").on('change', function () {

                    //Get count of selected files
                    var countFiles = $(this)[0].files.length;

                    var imgPath = $(this)[0].value;
                    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                    var image_holder = $("#image-holder");
                    image_holder.empty();

                    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                        if (typeof (FileReader) != "undefined") {

                            //loop for each file selected for uploaded.
                            for (var i = 0; i < countFiles; i++) {

                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $("<img />", {
                                        "src": e.target.result,
                                            "class": "thumb-image"
                                    }).appendTo(image_holder);
                                }

                                image_holder.show();
                                reader.readAsDataURL($(this)[0].files[i]);
                            }

                            $('.btnUpload').show();

                        } else {
                            alert("This browser not support FileReader.");
                        }
                    } else {
                        alert("Please, select only jpg png gif !!!");
                    }
            });


});

</script>

<style>

    .hide {
    display: none;
    }

    .btnUpload {
        display: none;
    }

    .img_preview_wrap {
        display: none;
    }

    #imagePreview {
        margin: 15px 0 0 0;
        border: 2px solid #ddd;
    }

</style>


<form action="upload.php?g=<?php echo $_GET['g'];?>" method="post" enctype="multipart/form-data" style="padding-top:14px;padding-bottom:0px;margin-bottom:0;">
    Select image(s) to upload:
    <input id="fileUpload"  name="fileUpload" id="fileUpload" type="file" accept="image/*" />
    <input type="submit" class="btnUpload" value="Upload Image" name="submit">
    <div id="image-holder"></div>
</form>
<br>
