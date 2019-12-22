<?php

    require "table_pagination_pdo.class.php";
    require "table_pagination.class.php";

    // table 
    function select_table($pdo, $table, $limit_start, $pgn_limit){
        $sth = $pdo->prepare("SELECT * FROM $table ORDER by id DESC LIMIT ".$limit_start.",".$pgn_limit);
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
        // $pgn_rCount = $rows['result'];
        return $rows['result'];
    }

    // 
    $pdo = new PDOConfig('booking_vuejs');
    $table = 'clients';
    $table_fields = table_fields($pdo, $table);
    $n_results_array = ['5','10','15','25','50']; 
    $pgn_limit = 15; 
    $pgn_paramPage   = 'page'; // url var
    $pgn_paramRes = 'n_result'; // url var
    if(isset($_GET[$pgn_paramRes])){$pgn_limit = $_GET[$pgn_paramRes]; }
    $pgn_page = (isset($_GET[$pgn_paramPage])) ? $_GET[$pgn_paramPage] : 1;
    $limit_start = ($pgn_page - 1) * $pgn_limit;
    $datas = select_table($pdo, $table, $limit_start, $pgn_limit);
    $pgn_rCount = rows_count($pdo, $table);

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
                    <th class="text-center"><?php echo $pgn_rCount;?></th>
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
            <select id="select_n_result" data-pgn_paramRes="n_result">
                <?php
                    foreach($n_results_array as $result){
                        $selected = '';
                        if($result==$pgn_limit){$selected=' selected';}
                        echo "<option value='$result' $selected>$result</option>";
                    }
                ?>
            </select>
        <div>
        <!-- ------------------------------- PAGINATION -->
        <?php              
            // VARS
            $pgn_dfltLimit = 15; // n results
            $pgn_rCount    = rows_count($pdo, $table);
            $pgn_paramPage = 'page'; // url var
            $pgn_paramRes  = 'n_result'; // url var
            $pgn_nBtns     = 4; // tot max visible btn = n*2 +1 (without first and last)
            $pgn_ics       = array("icon_before"=>"&#60;","icon_etc"=>"...","icon_next"=>"&#62;");
            // |icon_before|...|1|2|3|4|center nb|5|6|7|8|...|icon_next|

            new Pagination($pgn_dfltLimit,$pgn_rCount,$pgn_nBtns,$pgn_ics,$pgn_paramPage,$pgn_paramRes);        
        ?>
        <script src="table_pagination.js"></script>
        <!-- ------------------------------- PAGINATION -->
    </div>
</body>
</html>
