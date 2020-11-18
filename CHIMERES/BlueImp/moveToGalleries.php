<?php

    session_start(); 

    function copyFiles_toGallery($gallery,$file){

        // $serv_dir = 'server/php/files/'.$_SESSION["g"].'_'.$_SESSION["signin"];
  

        sleep(2);


        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $name = pathinfo($file, PATHINFO_FILENAME);
        // rename($serv_dir.'/'.$name.'.'.$ext, $serv_dir.'/a'.$name.'.'.strtolower($ext));
        // $file = 'a'.$file;

        $filename = $name.'.'.$ext;


        $myfile = fopen('server/php/files/infos.txt', "w") or die("Unable to open file!");
        $txt = $filename."\n";
        fwrite($myfile, $txt);
        fclose($myfile);


        // $path_file = $file;

        // rename_win('server/php/files/'.$gallery.'_'.$_SESSION["signin"]);
        // rename('server/php/files/'.$gallery.'_'.$_SESSION["signin"].'/IMG_3552.JPG', 'server/php/files/'.$gallery.'_'.$_SESSION["signin"].'/aIMG_3552.jpg');


        // $serv_dir = 'server/php/files/'.$gallery.'_'.$_SESSION["signin"];


        // $sanitize = sanitize_recursive($_SESSION["SERVER_FILES_UPLOAD"]);


        // Rename UPPER ext
        // $name = pathinfo($path_file, PATHINFO_FILENAME);
        // $ext = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));
        // $newfile = $name.'.'.$ext;
        // $myfile = fopen('server/php/files/'.$gallery.'_'.$_SESSION["signin"].'/toto.txt', "w");
        // fclose($myfile);

        // getDirContents('server/php/files/'.$gallery.'_'.$_SESSION["signin"].'/');



        // $file_toRename = 'server/php/files/'.$gallery.'_'.$_SESSION["signin"].'/'.$filename;
        // $file_toRename = $file;
        // $file = 'server/php/files/'.$gallery.'_'.$_SESSION["signin"].'/'.$newfile;
        // rename_win($path_file, $file);
        // $file_toRename_thumb = 'server/php/files/'.$gallery.'_'.$_SESSION["signin"].'/thumbnail/'.$filename;
        // $file_thumb = 'server/php/files/'.$gallery.'_'.$_SESSION["signin"].'/thumbnail/'.$newfile;
        // rename_win($file_toRename_thumb, $file_thumb);

        // copy to real gallery
        // $file_copy = '../img/galleries/'.$gallery.'/'.$filename;
        $file = 'server/php/files/'.$_SESSION["g"].'_'.$_SESSION["signin"].'/'.$filename;
        $file_copy = '../'.$_SESSION["GALLERY_PATH"].'/'.$filename;
        copy($file, $file_copy);

        $file_thumb = 'server/php/files/'.$_SESSION["g"].'_'.$_SESSION["signin"].'/thumbnail/'.$filename;
        $file_copy_thumb = '../img/galleries/'.$_SESSION["g"].'/thumbnails/'.$filename;
        copy($file_thumb, $file_copy_thumb);
    }

    // if (isset($_POST['gallery'])) {
        $gallery = $_SESSION["g"];
        $files = glob('server/php/files/'.$_SESSION["g"].'_'.$_SESSION["signin"].'/*.{jpg,jpeg,png,gif,mp4}', GLOB_BRACE);
        foreach($files as $file) {
            copyFiles_toGallery($gallery,$file);
        }

    // }
?>