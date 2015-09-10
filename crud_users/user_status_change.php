<?php

include_once("../inc_connect.php");

    
    //$fp = fopen("tata.txt", 'w');
    //fwrite($fp, 'tototo');
    //fclose($fp);


if(isset($_POST['checked'])){

    $data=$_POST['checked'];
 
 
    //$fp = fopen($data, 'w');
    //fwrite($fp, 'tototo');
    //fclose($fp); 
 
 
 
 
 
 
    $tmp = explode("_", $data); 
    $id=$tmp[0];
    $checked=$tmp[1];
    if($checked=='false'){$checked=0;}
    // if($checked=='true'){$checked=1;}
    else{$checked=1;}
     
    //$sql = "UPDATE users SET actif='?', WHERE id='?'";
    //$q = $dbh->prepare($sql);
    //$d = array($checked, $id);      
    //$q->execute($d);
    
    
    $sql = "UPDATE users_zemelattitude SET actif=? WHERE id=?";
    $q = $dbh->prepare($sql);
    $q->execute(array($checked,$id));
  
    
    
    // $mame = $_POST['data'];
    // print $mame;
    // $q = $dbh->prepare("SELECT * FROM users WHERE name = :name");
    // $q->bindValue(':name', 'Atomiz');
    // $q->execute();
    


}

?>