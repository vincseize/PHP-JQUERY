<?php
    //   $posts = [['id' => 1], ['id' => 2] ...];
      $posts = $images;

      $postChunks = array_chunk($posts, 6); // 6 is used to have 4 items in a row
      foreach ($postChunks as $posts) {
        print_r("<br>---- BEGIN container<br>");
              foreach ($posts as $img) {
                //   <div class="col-md-3">
                print_r("div--".$img."--div<br>");
                //   </div>     
              }
              print_r("<br>---- END container");
      }
?>
