<?php
require_once('../inc/inc_connect.php');
$conn = mysqli_connect($host, $user, $password,$dbname);
mysqli_set_charset($conn,"utf8");

$id = ''; // to do better ?
$method = urldecode($_SERVER['REQUEST_METHOD']);
$request = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
$result = json_decode(file_get_contents('php://input'),TRUE);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function sanitize($value){
    // $value = htmlentities(htmlspecialchars($value));
    $value = htmlspecialchars($value);
    $value = str_replace("\\\\","\\",$value);
    $value = str_replace("\\","\\",$value);
    return $value;
}

switch ($method) {
    case 'GET':
      $sql = "select * from contacts";
      $query = $conn->query($sql);
      $contacts = array();
      while($row = $query->fetch_array()){
        array_push($contacts, $row);
      }
      $out['contacts'] = $contacts;
      break;
    case 'POST':
      if (isset($_POST["name"]) && !isset($_POST["update"])){
        $name = sanitize($_POST["name"]);
        $email = sanitize($_POST["email"]);
        $country = sanitize($_POST["country"]);
        $city = sanitize($_POST["city"]);
        $job = sanitize($_POST["job"]);
        $sql = "INSERT into contacts (name, email, city, country, job) values ('$name', '$email', '$city', '$country', '$job')"; 
        break;
      }
      elseif (isset($_POST["update"])){
        $name = sanitize($_POST["name"]);
        $email = sanitize($_POST["email"]);
        $country = sanitize($_POST["country"]);
        $city = sanitize($_POST["city"]);
        $job = sanitize($_POST["job"]);
        $id = sanitize($_POST["id"]);
        $sql = "UPDATE contacts SET name='$name' WHERE id='$id'";  
        break;
      }
      elseif(!isset($_POST["name"]) && !isset($_POST["update"])){
        $id = $result['data']['delete'];
        if ($id != '' && $id !== ''){
          $sql = "DELETE FROM contacts WHERE id='$id'"; 
        }
        break;
      }
      else{
        break;
      }
}

// run SQL statement
$result = mysqli_query($conn,$sql);

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
}

if ($method == 'GET') {
    if (!$id) {
      echo '[';
      for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
        echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
      }
    }
    if (!$id){
      // to do better ?
      echo ']';
    }
} 

elseif ($method == 'POST') {
  if (isset($_POST["name"])){
    $last_id = $conn->insert_id;    
    $result = array (
      "result"  => json_encode($result),
      "id" => json_encode($last_id)
    );
  } 
  echo json_encode($result);
} 
else {
  echo "mysqli_affected_rows";
  echo mysqli_affected_rows($conn);
}

$conn->close();
