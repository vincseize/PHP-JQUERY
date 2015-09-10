<?php


include('inc_var_crud_draw.php');
$path_folder_save = $path_folder_save ; // to do

function get_variable() {

            $path_to_save = 'imagesVillagesBattles';

            $bg = $_GET['village'];
            $n = $_GET['N'];
            $typeAttaque = $_GET['typeAttaque'];
            $comment = $_GET['comment'];
            $auteurAttaque = $_GET['auteurAttaque'];
            $date = $_GET['date'];

            $over = $path_to_save.'/over.png';
            $outputFile = $path_to_save.'/'.$n.'.png';

            $result = $path_to_save.'/'.$n.'_'.$auteurAttaque.'_'.$date.'.JPG';
            //$result_jpg_compressed = $path_to_save.'/'.$n.'.JPG';

            // return array($bg,$over,$outputFile,$result,$width,$height);
            return array($bg,$over,$outputFile,$result,$path_to_save,$n,$typeAttaque,$comment,$auteurAttaque,$date);


}


function png2jpg($originalFile, $outputFile, $quality) {

    $image = imagecreatefrompng($originalFile);
    imagejpeg($image, $outputFile, $quality);
    imagedestroy($image);
}


function jpg2png($originalFile, $outputFile) {

    $imageObject = imagecreatefromjpeg($originalFile);
    imagepng($imageObject, $outputFile);

}


function write_comments() {

    $array_variable = get_variable($path_folder_save);
    $path_to_save = $array_variable[4];
    $n = $array_variable[5];
    // var for comments
    $typeAttaque = $array_variable[6];
    $comment = $array_variable[7];
    $auteurAttaque = $array_variable[8];
    $date = $array_variable[9];

    // $comments_file = $path_to_save."/".$n.".txt";
    $comments_file = $path_to_save.'/'.$n.'_'.$auteurAttaque.'_'.$date.'.txt';

    @unlink($comments_file);


    $fp = fopen($comments_file, 'wb');
    fwrite($fp, $typeAttaque);
    fwrite($fp, ";");
    fwrite($fp, $comment);
    fwrite($fp, ";");
    fwrite($fp, $auteurAttaque);
    fwrite($fp, ";");
    fclose($fp);

}



function merge($width,$height) {

    $array_variable = get_variable();

    $bg = $array_variable[0];
    $over = $array_variable[1];
    $outputFile = $array_variable[2];
    $result = $array_variable[3];
    $path_to_save = $array_variable[4];
    $n = $array_variable[5];

    $tmp_img =$path_to_save."/tmp_".$n.".png";
    // $result_jpg_compressed = $path_to_save.'/'.$n.'.JPG';

    // $base_image = imagecreatefrompng($bg);
    jpg2png($bg, $outputFile);

    $base_image=imagecreatefrompng($outputFile);
    $top_image = imagecreatefrompng($over);

    // $merged_image = $result;
    imagesavealpha($top_image, true);
    imagealphablending($top_image, true);

    imagecopy($base_image, $top_image, 0, 0, 0, 0, $width, $height);
    imagepng($base_image, $result);

    // rename to temp for compression
    rename($result, $path_to_save."/tmp_".$n.".png");

    // compress IMG
    $img = imagecreatefrompng($tmp_img);
    // imagejpeg($img,$result_jpg_compressed,75);
    imagejpeg($img,$result,75);
    unlink($tmp_img);
    unlink($tmp_img);

    // if necessery !!!!!!!!!!!!!!!!!!!
    unlink($outputFile);
    unlink($over);

}




if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
{
        // Get the data
        $imageData=$GLOBALS['HTTP_RAW_POST_DATA'];

        $array_variable = get_variable($path_folder_save);

        // $over = 'imagesVillagesBattles/over.png';
        $over = $array_variable[1];
        // $n = $array_variable[5];

        // Remove the headers (data:,) part.
        // A real application should use them according to needs such as to check image type
        $filteredData=substr($imageData, strpos($imageData, ",")+1);

        // Need to decode before saving since the data we received is already base64 encoded
        $unencodedData=base64_decode($filteredData);

        $f = fopen($over, 'wb');
        stream_filter_append($fh, 'convert.base64-decode');
        // Do a lot of writing here. It will be automatically decoded from base64.
        fclose($f);
        file_put_contents($over, $unencodedData);


        $size = getimagesize($over);
        $w = $size[0];
        $h = $size[1];


        merge($w,$h);

        write_comments();

}




?>



