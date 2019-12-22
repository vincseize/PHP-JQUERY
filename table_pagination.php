<?php

    class PDOConfig extends PDO
    {
        private $server;
        private $host;
        private $database;
        private $username;
        private $password;

        public function __construct($database)
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
        public $pgn_limit;
        public $pgn_rCount;
        public $pgn_nBtns;
        public $pgn_ics;
        public $pgn_page;
        public $pgn_paramPage;
        public $pgn_paramRes;
        
        public $pgn_nPages;
        public $pgn_startNb;
        public $pgn_endNb;
        public $pgn_url;
        public $pgn_sep;

        // public $link;

        public function __construct($pgn_limit,$pgn_rCount,$pgn_nBtns,$pgn_ics,$pgn_page,$pgn_paramPage,$pgn_paramRes){
            $this->pgn_url        = $_SERVER["REQUEST_URI"];
            $this->pgn_sep        = "&";
            parse_str($_SERVER['QUERY_STRING'], $output);
            if (count($output, COUNT_NORMAL) == 0 ) {
                $this->pgn_sep = "?";
            }
            $this->pgn_page       = $pgn_page;
            $this->pgn_limit      = $pgn_limit;
            $this->pgn_rCount  = $pgn_rCount;
            $this->pgn_nPages     = ceil($this -> pgn_rCount / $this -> pgn_limit);
            $this->pgn_paramPage  = $pgn_paramPage;
            $this->pgn_paramRes   = $pgn_paramRes;
            $this->pgn_nBtns      = $pgn_nBtns;
            $this->pgn_startNb    = ($this->pgn_page > $this->pgn_nBtns) ? $this->pgn_page - $this->pgn_nBtns : 1;
            $this->pgn_endNb      = ($this->pgn_page < ($this->pgn_nPages - $this->pgn_nBtns)) ? $this->pgn_page + $this->pgn_nBtns : $this->pgn_nPages;
            $this->pgn_iconBefore = $pgn_ics['icon_before'];
            $this->pgn_iconEtc    = $pgn_ics['icon_etc'];
            $this->pgn_iconNext   = $pgn_ics['icon_next'];
            $this->pgn_btn_clDis  = " class='disabled'";
            $this->pgn_btn_clEna  = " class='active'";

            $link = $this->pagination_ui();
            echo $link;
        }

        public function pagination_ui(){
            // Order fcts !important!
            $link = $this->number_page_prev();
            $link .= $this->number_first_page();
            $link .= $this->number_etc_page_begin();
            $link .= $this->number_page();
            $link .= $this->number_etc_page_end();
            $link .= $this->number_end_page();
            $link .= $this->number_page_next();
            return $link;
        }

        // ** Remove a query string parameter from an URL.
        // *
        // * @param string $url
        // * @param string $param
        // *
        // * @return string
        // */
        public function removeUrlParam($url, $param)
        {
            if (isset($_GET[$param]))
            {
                $parseUri = parse_url($url);
                $arrayUri = array();
                parse_str($parseUri['query'], $arrayUri);
                unset($arrayUri[$param]);
                $newUri = http_build_query($arrayUri);
                $url = $parseUri['path'].'?'.$newUri;
            }
            return $url;
        }

        public function pagination_link($link_active, $class_disabled, $page_li, $number){
            $url = $this->removeUrlParam($this->pgn_url, $this->pgn_paramPage);
            $url = $this->removeUrlParam($url, $this->pgn_paramRes);
            $url = $url.$this->pgn_sep.$this->pgn_paramPage."=".$page_li."&".$this->pgn_paramRes."=".$this->pgn_limit;
            $link = "<li $link_active $class_disabled><a href='$url'>$number</a></li>";
            return $link;
        }

        public function number_page_prev(){
            $link_active = '';
            $link_prev = ($this->pgn_page > 1) ? $this->pgn_page - 1 : 1;
            if ($this->pgn_page == 1) { 
                $class_disabled = $this->pgn_btn_clDis; 
                if($this->pgn_rCount==0){$class_disabled = $this->pgn_btn_clDis;}
            } else { 
                $class_disabled = '';
                if($this->pgn_rCount==0){$class_disabled = $this->pgn_btn_clDis;}
            }
            $li = $this->pagination_link($link_active, $class_disabled, $link_prev, $this->pgn_iconBefore);
            return $li;
        }

        public function number_first_page(){
            if($this->pgn_page==1){$link_active = $this->pgn_btn_clEna;}else{$link_active = '';}
            $class_disabled = '';
            $li = $this->pagination_link($link_active, $class_disabled, 1, 1);
            return $li;
        }

        public function number_etc_page_begin(){
            $link_active = '';
            $class_disabled = '';
            $start_number_minus1 = $this->pgn_startNb-1;
            if ($this->pgn_startNb+1 >= $this->pgn_nBtns) { 
                $li = $this->pagination_link($link_active, $class_disabled, $start_number_minus1, $this->pgn_iconEtc);
                return $li;
            }
        }

        public function number_page(){
            $class_disabled = '';
            $li = '';
            if($this->pgn_rCount!=0 && $this->pgn_rCount>$this->pgn_limit){
                for ($i = $this->pgn_startNb; $i <= $this->pgn_endNb; $i++) {
                    $link_active = ($this->pgn_page == $i) ? $this->pgn_btn_clEna : '';
                    if ($i != '1' && $i != $this->pgn_nPages) {
                        $li .= $this->pagination_link($link_active, $class_disabled, $i, $i);
                        
                    }
                }
                return $li;
            }
        }

        public function number_etc_page_end(){
            $class_disabled = '';
            if($this->pgn_page==$this->pgn_nPages){$link_active = $this->pgn_btn_clEna;}
            $end_number_max1 = $this->pgn_endNb+1;
            if ($end_number_max1 < $this->pgn_nPages) {
                $link_active = '';
                $li = $this->pagination_link($link_active, $class_disabled, $end_number_max1, $this->pgn_iconEtc);
                return $li;
            }
        }

        public function number_end_page(){
            if($this->pgn_rCount!=0 && $this->pgn_rCount>$this->pgn_limit){
                $class_disabled = '';
                if($this->pgn_page==$this->pgn_nPages){$link_active = $this->pgn_btn_clEna;}else{$link_active = '';}
                $li = $this->pagination_link($link_active, $class_disabled, $this->pgn_nPages, $this->pgn_nPages);
                return $li;
            }
        }

        public function number_page_next(){
            $link_next = ($this->pgn_page < $this->pgn_nPages) ? $this->pgn_page + 1 : $this->pgn_nPages;
            if ($this->pgn_page == $this->pgn_nPages) {
                $link_active = '';
                $class_disabled = $this->pgn_btn_clDis;  
                if($this->pgn_rCount==0){$class_disabled = $this->pgn_btn_clDis;}
            } else {
                $link_active = '';
                $class_disabled = '';
                if($this->pgn_rCount==0){$class_disabled = $this->pgn_btn_clDis;}
            }
            $li = $this->pagination_link($link_active, $class_disabled, $link_next, $this->pgn_iconNext);
            return $li;
        }
    }

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
            <select id="select_n_result">
                <?php
                    foreach($n_results_array as $result){
                        $selected = '';
                        if($result==$pgn_limit){$selected=' selected';}
                        echo "<option value='$result' $selected>$result</option>";
                    }
                ?>
            </select>
        <div>
        <!-- ------------------------------- PAGINATION --------------------------------------------- -->
        <ul class="pagination"> <!-- // class from bootstrap -->
            <?php              
                // --------------------------- PAGINATION VARS ---------------------------

                // $pgn_url       = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); // without param 
                $pgn_dfltLimit     = 15; // n results
                $pgn_rCount = rows_count($pdo, $table);
                $pgn_paramPage   = 'page'; // url var
                $pgn_paramRes = 'n_result'; // url var
                $pgn_nBtns = 4;  // tot max visible btn = n*2 +1 (without first and last)
                $pgn_ics     = array("icon_before"=>"&#60;","icon_etc"=>"...","icon_next"=>"&#62;"); // before, next, ...
                // |icon_before|...|1|2|3|4|center nb|5|6|7|8|...|icon_next|

                $pgn_page      = (isset($_GET[$pgn_paramPage])) ? $_GET[$pgn_paramPage] : 1;
                if(isset($_GET[$pgn_paramRes])){$pgn_dfltLimit = $_GET[$pgn_paramRes]; }

                // --------------------------- PAGINATION UI result---------------------------
                new Pagination($pgn_dfltLimit,$pgn_rCount,$pgn_nBtns,$pgn_ics,$pgn_page,$pgn_paramPage,$pgn_paramRes);        
            ?>
        </ul>
        <!-- ------------------------------- PAGINATION --------------------------------------------- -->
    </div>
</body>
</html>
<script>

    document.getElementById('select_n_result').addEventListener('change', function() {

        function removeParam(key, url) {
            var rtn = url.split("?")[0],
                param,
                params_arr = [],
                queryString = (url.indexOf("?") !== -1) ? url.split("?")[1] : "";
            if (queryString !== "") {
                params_arr = queryString.split("&");
                for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                    param = params_arr[i].split("=")[0];
                    if (param === key) {
                        params_arr.splice(i, 1);
                    }
                }
                rtn = rtn + "?" + params_arr.join("&");
            }
            return rtn;
        }

        var url = window.location.href;
        var sep = '?';
        var params = url.split('?')[1];
        try {
            count = params.length;
            sep = '&';
        }
        catch(err) {
            var count = 0;
            sep = '?';
        }
        // console.log(count);
        var key =  'n_result';
        var url = removeParam(key, url) ;
        // console.log(url);
        url = url+sep+'n_result='+this.value;
        // console.log(url);
        window.location.href = url;
    });
</script>
