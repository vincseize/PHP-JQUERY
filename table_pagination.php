<?php

    class PDOConfig extends PDO
    {
        private $server;
        private $host;
        private $database;
        private $username;
        private $password;

        public function __construct($database = 'booking_vuejs')
        {
            $this->server = 'mysql';
            $this->host = 'localhost';
            $this->database = $database;
            $this->username = 'root';
            $this->password = '';

            $pdo = $this->server . ':dbname=' . $this->database . ";host=" . $this->host;

            parent::__construct( $pdo, $this->username, $this->password );

            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        }
    }

    class Pagination
    {

        public $url;
        public $page;
        public $limit;
        public $rows_count;
        public $nPages;
        public $nBtns;
        public $startNumber;
        public $endNumber;
        public $icons;

        public function __construct($url,$page,$limit,$rows_count,$nBtns,$icons){
            $this->url                 = $url;
            $this->page                = $page;
            $this->limit               = $limit;
            $this->rows_count          = $rows_count;
            $this->nPages              = ceil($this->rows_count / $this->limit);
            $this->nBtns               = $nBtns;
            $this->startNumber         = ($this->page > $this->nBtns) ? $this->page - $this->nBtns : 1;
            $this->endNumber           = ($this->page < ($this->nPages - $this->nBtns)) ? $this->page + $this->nBtns : $this->nPages;
            $this->icon_before         = $icons['icon_before'];
            $this->icon_etc            = $icons['icon_etc'];
            $this->icon_next           = $icons['icon_next'];
            $this->btn_class_disabled  = " class='disabled'";
            $this->btn_class_enabled   = " class='active'";
            $this->pagination_ui();
        }

        public function pagination_ui(){
            // Order fcts !important!
            $this->number_page_prev();
            $this->number_first_page();
            $this->number_etc_page_begin();
            $this->number_page();
            $this->number_etc_page_end();
            $this->number_end_page();
            $this->number_page_next();
        }

        public function pagination_link($link_active, $class_disabled, $page, $number){
            $link = "<li $link_active $class_disabled><a href='$this->url?page=$page&n_result=$this->limit'>$number</a></li>";
            echo $link;
        }

        public function number_page_prev(){
            $link_active = '';
            $link_prev = ($this->page > 1) ? $this->page - 1 : 1;
            if ($this->page == 1) { 
                $class_disabled = $this->btn_class_disabled; 
                if($this->rows_count==0){$class_disabled = $this->btn_class_disabled;}
            } else { 
                $class_disabled = '';
                if($this->rows_count==0){$class_disabled = $this->btn_class_disabled;}
            }
            $li = $this->pagination_link($link_active, $class_disabled, $link_prev, $this->icon_before, $this->limit);
        }

        public function number_first_page(){
            if($this->page==1){$link_active = $this->btn_class_enabled;}else{$link_active = '';}
            $class_disabled = '';
            $li = $this->pagination_link($link_active, $class_disabled, 1, 1, $this->limit);
        }

        public function number_etc_page_begin(){
            $link_active = '';
            $class_disabled = '';
            $start_number_minus1 = $this->startNumber-1;
            if ($this->startNumber+1 >= $this->nBtns) { 
                $li = $this->pagination_link($link_active, $class_disabled, $start_number_minus1, $this->icon_etc, $this->limit);
            }
        }

        public function number_page(){
            $class_disabled = '';
            if($this->rows_count!=0 && $this->rows_count>$this->limit){
                for ($i = $this->startNumber; $i <= $this->endNumber; $i++) {
                    $link_active = ($this->page == $i) ? $this->btn_class_enabled : '';   
                    if ($i != '1' && $i != $this->nPages) {
                        $li = $this->pagination_link($link_active, $class_disabled, $i, $i, $this->limit);
                    }
                }
            }
        }

        public function number_etc_page_end(){
            $class_disabled = '';
            if($this->page==$this->nPages){$link_active = $this->btn_class_enabled;}
            $end_number_max1 = $this->endNumber+1;
            if ($end_number_max1 < $this->nPages) {
                $link_active = '';
                $li = $this->pagination_link($link_active, $class_disabled, $end_number_max1, $this->icon_etc, $this->limit);
            }
        }

        public function number_end_page(){
            if($this->rows_count!=0 && $this->rows_count>$this->limit){
                $class_disabled = '';
                if($this->page==$this->nPages){$link_active = $this->btn_class_enabled;}else{$link_active = '';}
                $li = $this->pagination_link($link_active, $class_disabled, $this->nPages, $this->nPages, $this->limit);
            }
        }

        public function number_page_next(){
            $link_next = ($this->page < $this->nPages) ? $this->page + 1 : $this->nPages;
            if ($this->page == $this->nPages) {
                $link_active = '';
                $class_disabled = $this->btn_class_disabled;  
                if($this->rows_count==0){$class_disabled = $this->btn_class_disabled;}
            } else {
                $link_active = '';
                $class_disabled = '';
                if($this->rows_count==0){$class_disabled = $this->btn_class_disabled;}
            }
            $li = $this->pagination_link($link_active, $class_disabled, $link_next, $this->icon_next, $this->limit);
        }
    }

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

    // 
    $pdo = new PDOConfig();
    $table = 'clients';
    $table_fields = table_fields($pdo, $table);
    $n_results_array = ['5','10','15','25','50']; 
    $limit = 15; 
    if(isset($_GET['n_result'])){$limit = $_GET['n_result']; }
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $limit_start = ($page - 1) * $limit;
    $datas = select_table($pdo, $table, $limit_start, $limit);
    $rows_count = rows_count($pdo, $table);

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
        <ul class="pagination"> <!-- // class from bootstrap -->
            <?php              
                // --------------------------- PAGINATION VARS ---------------------------
                $pgn_getPage   = 'page'; // url var
                $pgn_getResult = 'n_result'; // url var
                $pgn_rowsCount = rows_count($pdo, $table);
                $pgn_url       = $_SERVER["PHP_SELF"];
                $pgn_limit     = 15; // n results
                $pgn_icons     = array("icon_before"=>"&#60;","icon_etc"=>"...","icon_next"=>"&#62;"); // before, next, ...
                $pgn_nBtns = 4;  // tot max visible btn = n*2 +1 (without first and last)
                // |icon_before|...|1|2|3|4|center nb|5|6|7|8|...|icon_next|

                // DONT CHANGE
                $pgn_page      = (isset($_GET[$pgn_getPage])) ? $_GET[$pgn_getPage] : 1;
                if(isset($_GET[$pgn_getResult])){$pgn_limit = $_GET[$pgn_getResult]; }

                // --------------------------- PAGINATION UI result---------------------------
                new Pagination($pgn_url,$pgn_page,$pgn_limit,$pgn_rowsCount,$pgn_nBtns,$pgn_icons);
            ?>
        </ul>
        <!-- ------------------------------- PAGINATION --------------------------------------------- -->
    </div>
</body>
</html>
<script>
    document.getElementById('select_n_result').addEventListener('change', function() {
        var url = window.location.href.split('?')[0];
        window.location.href = url+'?n_result='+this.value;
    });
</script>
