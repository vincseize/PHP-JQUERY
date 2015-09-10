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
/*
function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    // return $dst;
}
*/


function smart_resize_image_OLD($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = false, 
                              $use_linux_commands = false,
  			      $quality = 100
  		 ) {
      
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;
 
    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;
 
    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );
 
      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;
	  
	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }
 
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }
    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);
 
      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }
 
    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }
 
    return true;
  }



function smart_resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}
  
  
  
  
function merge($width,$height) {

    $nowtime = time();

    $array_variable = get_variable();

    $bg = $array_variable[0];
    $over = $array_variable[1];
    $outputFile = $array_variable[2];
    $result = $array_variable[3];
    $path_to_save = $array_variable[4];
    $n = $array_variable[5];

    $tmp_img_rezized =$path_to_save."/tmp_".$nowtime.".jpg";
    $tmp_img =$path_to_save."/tmp_".$n.".png";
    // $result_jpg_compressed = $path_to_save.'/'.$n.'.JPG';

    
    // resize_image
    //$bg = resize_image($bg, $width, $width); 
    // smart_resize_image($bg,null,$width,$height,false,$tmp_img_rezized,true);
    
    //copy($bg, $tmp_img_rezized);
    // smart_resize_image($tmp_img_rezized,$width,$height);
    
    list($orwidth, $orheight) = getimagesize($bg);
   
    
    //$filename = $path_to_save.'/toto.jpg';
    $tmp = imagecreatetruecolor($width, $height);
    //$source = imagecreatefromjpeg($tmp_img_rezized);
    $source = imagecreatefromjpeg($bg);
    imagecopyresampled($tmp, $source, 0, 0, 0, 0, $width, $height, $orwidth, $orheight); 
    imagejpeg($tmp, $tmp_img_rezized, 70);
   
   
   
   // Chargement
// $thumb = imagecreatetruecolor($newwidth, $newheight);
//$source = imagecreatefromjpeg($filename);

// Redimensionnement
//imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

   
   
   
   
   
   
    
    // $base_image = imagecreatefrompng($bg);
    // $bg = $tmp_img_rezized;
    // jpg2png($bg, $outputFile);
    jpg2png($tmp_img_rezized, $outputFile);

  
    
    
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
    @unlink($tmp_img);
    @unlink($tmp_img_rezized);

    // if necessery !!!!!!!!!!!!!!!!!!!
    @unlink($outputFile);
    @unlink($over);

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

        
	// $fp = fopen ($w."_".$h.".txt",'w');
	// fclose ($fp);
        
        //$w = 962;
        // $h = 541;

        //$w = 1024;
        //$h = 768;
        
        
        merge($w,$h);

        write_comments();

}




?>



