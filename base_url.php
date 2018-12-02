$config['base_url']  =  "http://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= preg_replace('@/+$@', '', dirname($_SERVER['SCRIPT_NAME'])).'/';

$base = dirname(dirname(__FILE__));
require($base.'/config/db.php');
$config = require($base.'/config/config.php');


//$parent_folder = basename(dirname(__FILE__, 2));
