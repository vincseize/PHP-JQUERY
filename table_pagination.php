<?php

    // DB
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'booking_vuejs';
    $table = 'clients';
    $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);

    // VARS
    $page_index = $_SERVER["PHP_SELF"];
    $n_results_array = ['5','10','15','25','50']; 
    $limit = 15; 
    if(isset($_GET['n_result'])){
        $limit = $_GET['n_result']; 
    }
    
    $n_btn_number = 4; // n*2 +1 (without first and last) max visible btn
    $icon_before = "&#60;";
    $icon_next = "&#62;";
    $icon_etc = "...";

    // DONT TOUCH !Important

    // table 
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

    function rows_count($pdo, $table){
        $sth = $pdo->prepare("SELECT COUNT(*) AS result FROM $table");
        $sth->execute(); 
        $rows = $sth->fetch();
        $rows_count = $rows['result'];
        return $rows_count;
    }

    // pagination

    function pagination_link($link_active, $class_disabled, $page_index, $page, $number){
        $link = "<li $link_active $class_disabled><a href='$page_index?page=$page'>$number</a></li>";
        echo $link;
    }

    function number_page_prev($page, $rows_count, $icon_before, $page_index){
        $link_active = '';
        $link_prev = ($page > 1) ? $page - 1 : 1;
        if ($page == 1) { 
            $class_disabled = "class='disabled'";  
            if($rows_count==0){$class_disabled = "class='disabled'";}
        } else { 
            $class_disabled = '';
            if($rows_count==0){$class_disabled = "class='disabled'";}
        }
        $li = pagination_link($link_active, $class_disabled, $page_index, $link_prev, $icon_before);
    }

    function number_first_page($page, $page_index){
        if($page==1){$link_active = ' class="active"';}else{$link_active = '';}
        $class_disabled = '';
        $li = pagination_link($link_active, $class_disabled, $page_index, 1, 1);
    }

    function number_etc_page_begin($start_number, $n_btn_number, $page_index, $icon_etc){
        $link_active = '';
        $class_disabled = '';
        $start_number_minus1 = $start_number-1;
        if ($start_number+1 >= $n_btn_number) { 
            $li = pagination_link($link_active, $class_disabled, $page_index, $start_number_minus1, $icon_etc);
        }
    }

    function number_page($rows_count, $limit, $start_number, $end_number, $page, $n_pages_result, $page_index){
        $class_disabled = '';
        if($rows_count!=0 && $rows_count>$limit){
            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($page == $i) ? ' class="active"' : '';   
                if ($i != '1' && $i != $n_pages_result) {
                    $li = pagination_link($link_active, $class_disabled, $page_index, $i, $i);
                }
            }
        }
    }

    function number_etc_page_end($page, $n_pages_result, $end_number, $page_index, $icon_etc){
        $class_disabled = '';
        if($page==$n_pages_result){$link_active = ' class="active"';}
        $end_number_max1 = $end_number+1;
        if ($end_number_max1 < $n_pages_result) {
            $link_active = '';
            $li = pagination_link($link_active, $class_disabled, $page_index, $end_number_max1, $icon_etc);
        }
    }

    function number_end_page($rows_count, $limit, $page, $n_pages_result, $page_index){
        if($rows_count!=0 && $rows_count>$limit){
            $class_disabled = '';
            if($page==$n_pages_result){$link_active = ' class="active"';}else{$link_active = '';}
            $li = pagination_link($link_active, $class_disabled, $page_index, $n_pages_result, $n_pages_result);
        }
    }

    function number_page_next($page, $n_pages_result, $rows_count, $page_index, $icon_next){
        $link_next = ($page < $n_pages_result) ? $page + 1 : $n_pages_result;
        if ($page == $n_pages_result) {
            $link_active = '';
            $class_disabled = "class='disabled'";  
            if($rows_count==0){$class_disabled = "class='disabled'";}
        } else {
            $link_active = '';
            $class_disabled = '';
            if($rows_count==0){$class_disabled = "class='disabled'";}
        }
        $li = pagination_link($link_active, $class_disabled, $page_index, $link_next, $icon_next);
    }

    //

    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $limit_start = ($page - 1) * $limit;
    $datas = select_table($pdo, $table, $limit_start, $limit);
    $rows_count = rows_count($pdo, $table);
    $n_pages_result = ceil($rows_count / $limit);
    $start_number = ($page > $n_btn_number) ? $page - $n_btn_number : 1;
    $end_number = ($page < ($n_pages_result - $n_btn_number)) ? $page + $n_btn_number : $n_pages_result;
    $result_numbers = array();
    for ($i = $start_number; $i <= $end_number; $i++) {
        array_push($result_numbers,$i);
    }
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
            <select id="select_n_result">
                <?php
                    foreach($n_results_array as $result){
                        $selected = '';
                        if($result==$limit){$selected=' selected';}
                        echo "<option value='$result' $selected>$result</option>";
                    }
                ?>
            </select>
        <div>

        <!-- ------------------------------- PAGINATION --------------------------------------------- -->
        <ul class="pagination">

            <?php
                // ------------------------ BTN NUMBERS PAGES, in order !important
                
                // NUMBER PAGE PREV
                number_page_prev($page, $rows_count, $icon_before, $page_index);

                // NUMBER FIRST PAGE
                number_first_page($page, $page_index);

                // NUMBER icon_etc_begin PAGE
                number_etc_page_begin($start_number, $n_btn_number, $page_index, $icon_etc);

                // NUMBERS PAGE
                number_page($rows_count, $limit, $start_number, $end_number, $page, $n_pages_result, $page_index);

                // NUMBER icon_etc_end PAGE
                number_etc_page_end($page, $n_pages_result, $end_number, $page_index, $icon_etc);

                // NUMBER END PAGE
                number_end_page($rows_count, $limit, $page, $n_pages_result, $page_index);

                // NUMBER PAGE NEXT 
                number_page_next($page, $n_pages_result, $rows_count, $page_index, $icon_next);

            ?>

        </ul>
    </div>
</body>
</html>
<script>
    document.getElementById('select_n_result').addEventListener('change', function() {
        var url = location.href;
        window.location.href = url+'&n_result='+this.value;
    });
</script>
