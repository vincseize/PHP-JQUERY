<?php

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'booking_vuejs';
    $table = 'clients';
    $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);

    function rows_count($pdo, $table){
        $sth = $pdo->prepare("SELECT COUNT(*) AS result FROM $table");
        $sth->execute(); 
        $rows = $sth->fetch();
        $rows_count = $rows['result'];
        return $rows_count;
    }

    function select_table($pdo, $table, $limit_start, $limit){
        $sth = $pdo->prepare("SELECT * FROM $table LIMIT ".$limit_start.",".$limit);
        $sth->execute(); 
        return $sth;
    }

    function table_fields($pdo, $table){
        $sth = $pdo->prepare("DESCRIBE $table");
        $sth->execute();
        $table_fields = $sth->fetchAll(PDO::FETCH_COLUMN);
        return $table_fields;
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
    $link_active = "";

    $start_number = ($page > $n_btn_number) ? $page - $n_btn_number : 1; // Untuk awal link member
    $end_number = ($page < ($n_pages_result - $n_btn_number)) ? $page + $n_btn_number : $n_pages_result; // Untuk akhir link number

    $result_numbers = array();
    for ($i = $start_number; $i <= $end_number; $i++) {
        array_push($result_numbers,$i);
    }

    $sth = $pdo->prepare("DESCRIBE $table");
    $sth->execute();
    $table_fields = table_fields($pdo, $table);

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
                    <?php
                        foreach($table_fields as $field){
                            echo "<th>$field</th>";
                        }
                    ?>
                </tr>

                <?php
                $no = $limit_start + 1; 
                while ($data = $datas->fetch()) { 
                ?>
                    <tr>
                        <td class="align-middle text-center"><?php echo $no; ?></td>
                        <?php
                            foreach($table_fields as $field){
                                echo "<td class='align-middle'>$data[$field]</td>";
                            }
                        ?>
                    </tr>
                <?php
                $no++; 
                }
                ?>

            </table>
        <div>

        <!-- ------------------------------- PAGINATION --------------------------------------------- -->
        <ul class="pagination">

            <?php
                // ------------------------ LINK BTN NUMBERS
                
                // LINK PAGE FIRST AND PREV
                if($page==1){$link_active = ' class="active"';}
                if ($page == 1) { 
                    echo "<li class='disabled'><a>$before_icon</a></li>";
                } else { 
                    $link_prev = ($page > 1) ? $page - 1 : 1;
                    echo "<li><a href='$page_index?page=$link_prev'>$before_icon</a></li>";
                }

                // LINK FIRST PAGE NUMBER
                echo "<li $link_active><a href='$page_index?page=1'>1</a></li>";
                if ($start_number+1 >= $n_btn_number) { 
                    $start_number_minus1 = $start_number-1;
                    echo "<li><a href='$page_index?page=$start_number_minus1'>$etc</a></li>";
                }

                // LINK NUMBERS
                for ($i = $start_number; $i <= $end_number; $i++) {
                    $link_active = ($page == $i) ? ' class="active"' : '';   
                    if ($i != '1' && $i != $n_pages_result) {
                        echo "<li $link_active><a href='$page_index?page=$i'>$i</a></li>";
                    }
                }

                // LINK END PAGE NUMBERS
                if($page==$n_pages_result){$link_active = ' class="active"';}
                $end_number_max1 = $end_number+1;
                if ($end_number_max1 < $n_pages_result) {
                    echo "<li><a href='$page_index?page=$end_number_max1'>$etc</a></li>";
                }
                echo "<li $link_active><a href='$page_index?page=$n_pages_result'>$n_pages_result</a></li>";

                // LINK NEXT AND LAST
                if ($page == $n_pages_result) {
                    echo "<li class='disabled'><a>$next_icon</a></li>";
                } else {
                    $link_next = ($page < $n_pages_result) ? $page + 1 : $n_pages_result;
                    echo "<li><a href='$page_index?page=$link_next'>$next_icon</a></li>";
                }
            ?>

        </ul>
    </div>
</body>
</html>
