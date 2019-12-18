<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'booking_vuejs';
$table = 'clients';
$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <mta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagination dengan PHP</title>

    <!-- Load file bootstrap.min.css yang ada di folder css -->
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
    <!-- Membuat Menu Header / Navbar -->
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
                    <th class="text-center"></th>
                    <th>id</th>
                    <th>nom</th>
                    <th>email</th>
                    <th>created</th>
                    <th>updated</th>
                </tr>
                <?php

                $page_index = $_SERVER["PHP_SELF"];

                // Cek apakah terdapat data pada page URL
                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                $limit = 5; // Jumlah data per halamanya

                // Buat query untuk menampilkan daa ke berapa yang akan ditampilkan pada tabel yang ada di database
                $limit_start = ($page - 1) * $limit;

                // Buat query untuk menampilkan data siswa sesuai limit yang ditentukan
                $sql = $pdo->prepare("SELECT * FROM $table LIMIT ".$limit_start.",".$limit);
                $sql->execute(); // Eksekusi querynya

                $no = $limit_start + 1; 
                while ($data = $sql->fetch()) { 
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





            <!-- LINK NUMBER -->
            <?php
            $sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM $table");
            $sql2->execute(); 
            $get_jumlah = $sql2->fetch();

            $n_pages_result = ceil($get_jumlah['jumlah'] / $limit);
            $jumlah_number = 4; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link member
            $end_number = ($page < ($n_pages_result - $jumlah_number)) ? $page + $jumlah_number : $n_pages_result; // Untuk akhir link number

            $result_numbers = array();
            for ($i = $start_number; $i <= $end_number; $i++) {
                array_push($result_numbers,$i);
            }
            ?>


            <!-- LINK FIRST AND PREV -->
            <?php
            
            if ($page == 1) { 
            ?>
                <!-- <li class="disabled"><a href="#">First</a></li> -->
                <li class="disabled"><a>&laquo;</a></li>


            <?php
            } else { 
                $link_prev = ($page > 1) ? $page - 1 : 1;
            ?>
                <!-- <li><a href="<?php echo $page_index;?>?page=1">First</a></li> -->
                <!-- <li><a href="<?php echo $page_index;?>?page=<?php echo $link_prev-1; ?>">&laquo;&laquo;</a></li> -->
                <li><a href="<?php echo $page_index;?>?page=<?php echo $link_prev; ?>">&laquo;</a></li>
            <?php
            }
            ?>


            
            
            <!-- LINK FIRST PAGE NUMBER -->
            <li><a href="<?php echo $page_index;?>?page=1">1</a></li>

<?php
// echo $start_number+1;
if ($start_number+1 >= $jumlah_number) { 
?>
            <li><a href="<?php echo $page_index;?>?page=<?php echo $start_number-1;?>">...</a></li>
<?php
}
?>





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


<?php
            if ($end_number+1 < $n_pages_result) {
            ?>
            <li><a href="<?php echo $page_index;?>?page=<?php echo $end_number+1;?>">...</a></li>
<?php
            }
?>

            <li><a href="<?php echo $page_index;?>?page=<?php echo $n_pages_result;?>"><?php echo $n_pages_result;?></a></li>

            <!-- LINK NEXT AND LAST -->
            <?php
            if ($page == $n_pages_result) {
            ?>
                <li class="disabled"><a href="#">&raquo;</a></li>
                <!-- <li class="disabled"><a href="<?php echo $page_index;?>?page=<?php echo $end_number+1; ?>">&raquo;&raquo;</a></li> -->
                <!-- <li class="disabled"><a href="#">Last</a></li> -->
            <?php
            } else {
                $link_next = ($page < $n_pages_result) ? $page + 1 : $n_pages_result;
            ?>
                <li><a href="<?php echo $page_index;?>?page=<?php echo $link_next; ?>">&raquo;</a></li>
                <!-- <li><a href="<?php echo $page_index;?>?page=<?php echo $end_number+1; ?>">&raquo;&raquo;</a></li> -->
                <!-- <li><a href="<?php echo $page_index;?>?page=<?php echo $n_pages_result; ?>">Last</a></li> -->
            <?php
            }
            ?>
        </ul>
    </div>
</body>
</html>
