<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'booking_vuejs';
$table = 'clients';
$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);


function rows_count($pdo, $table){
    $sql = $pdo->prepare("SELECT COUNT(*) AS result FROM $table");
    $sql->execute(); 
    $rows = $sql->fetch();
    $rows_count = $rows['result'];
    return $rows_count;
}

function select_table($pdo, $table, $limit_start, $limit){
    $sql = $pdo->prepare("SELECT * FROM $table LIMIT ".$limit_start.",".$limit);
    $sql->execute(); 
    return $sql;
}






$page_index = $_SERVER["PHP_SELF"];
$limit = 15; 
$n_btn_number = 4; // n*2 +1 (without first and last) max visible btn
$before_icon = "&#60;";
$next_icon = "&#62;";
$etc = "...";


// dont touch
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$limit_start = ($page - 1) * $limit;



$datas = select_table($pdo, $table, $limit_start, $limit);
$rows_count =rows_count($pdo, $table);
$n_pages_result = ceil($rows_count / $limit);


$start_number = ($page > $n_btn_number) ? $page - $n_btn_number : 1; // Untuk awal link member
$end_number = ($page < ($n_pages_result - $n_btn_number)) ? $page + $n_btn_number : $n_pages_result; // Untuk akhir link number

$result_numbers = array();
for ($i = $start_number; $i <= $end_number; $i++) {
    array_push($result_numbers,$i);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <mta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagination dengan PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <style>
        .align-middle {
            vertical-align: middle !important;
        }
        .navbar{
            border-radius: 0 !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#" style="color: white;"><b>Pagination</b></a>
            </div>
        </div>
    </nav>

    <div style="padding: 0 15px;">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th class="text-center"><?php echo $rows_count;?></th>
                    <th>id</th>
                    <th>nom</th>
                    <th>email</th>
                    <th>created</th>
                    <th>updated</th>
                </tr>
                <?php

                $no = $limit_start + 1; 
                while ($data = $datas->fetch()) { 
                ?>
                    <tr>
                        <td class="align-middle text-center"><?php echo $no; ?></td>
                        <td class="align-middle"><?php echo $data['id']; ?></td>
                        <td class="align-middle"><?php echo $data['nom']; ?></td>
                        <td class="align-middle"><?php echo $data['email']; ?></td>
                        <td class="align-middle"><?php echo $data['created']; ?></td>
                        <td class="align-middle"><?php echo $data['updated']; ?></td>
                    </tr>
                <?php
                $no++; 
                }
                ?>
            </table>
        <div>

        <ul class="pagination">

            <!-- LINK BTN NUMBERS -->


            <!-- LINK PAGE FIRST AND PREV -->
            <?php   
                if ($page == 1) { 
            ?>
            <li class="disabled"><a>&#60;</a></li>

            <?php
            } else { 
                $link_prev = ($page > 1) ? $page - 1 : 1;
            ?>
                <li><a href="<?php echo $page_index;?>?page=<?php echo $link_prev; ?>"><?php echo $before_icon;?></a></li>
            <?php
            }
            ?>

            <!-- LINK FIRST PAGE NUMBER -->
            <li><a href="<?php echo $page_index;?>?page=1">1</a></li>

            <?php
            if ($start_number+1 >= $n_btn_number) { 
            ?>
                <li><a href="<?php echo $page_index;?>?page=<?php echo $start_number-1;?>"><?php echo $etc;?></a></li>
            <?php
            }
            ?>

            <!-- LINK NUMBERS -->
            <?php
            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($page == $i) ? 'class="active"' : '';
            ?>
            

                <?php
                    if ($i != '1' && $i != $n_pages_result) {
                ?>

                <li <?php echo $link_active; ?>><a href="<?php echo $page_index;?>?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            
                      
            
                <?php
                    }


            }
            ?>

            <!-- LINK END PAGE NUMBERS -->
            <?php
                if ($end_number+1 < $n_pages_result) {
                ?>
                <li><a href="<?php echo $page_index;?>?page=<?php echo $end_number+1;?>"><?php echo $etc;?></a></li>
            <?php
                }
            ?>

            <li><a href="<?php echo $page_index;?>?page=<?php echo $n_pages_result;?>"><?php echo $n_pages_result;?></a></li>

            <!-- LINK NEXT AND LAST -->
            <?php
            if ($page == $n_pages_result) {
            ?>
                <li class="disabled"><a href="#"><?php echo $next_icon;?></a></li>
            <?php
            } else {
                $link_next = ($page < $n_pages_result) ? $page + 1 : $n_pages_result;
            ?>
                <li><a href="<?php echo $page_index;?>?page=<?php echo $link_next; ?>"><?php echo $next_icon;?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</body>
</html>
