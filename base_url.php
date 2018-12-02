$config['base_url']  =  "http://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= preg_replace('@/+$@', '', dirname($_SERVER['SCRIPT_NAME'])).'/';

$base = dirname(dirname(__FILE__));
require($base.'/config/db.php');
$config = require($base.'/config/config.php');


//$parent_folder = basename(dirname(__FILE__, 2));

__FILE__ // /var/.../dir1/dir2/parentdir


//////////////////


//=================================================== 
//========== self-defined SERVER variables ========== 
//=================================================== 
$_SERVER["DOCUMENT_ROOT"]  🡺 /home/user/public_html
$_SERVER["SERVER_ADDR"]    🡺 143.34.112.23
$_SERVER["SERVER_PORT"]    🡺 80(or 443 etc..)
$_SERVER["REQUEST_SCHEME"] 🡺 https                            //like: $_SERVER["SERVER_PROTOCOL"] 
$_SERVER['HTTP_HOST']      🡺       example.com                //like: $_SERVER["SERVER_NAME"]
$_SERVER["REQUEST_URI"]    🡺                       /subFolder/yourfile.php?var=blabla
$_SERVER["QUERY_STRING"]   🡺                                               var=blabla
__FILE__                   🡺 /home/user/public_html/subFolder/yourfile.php
__DIR__                    🡺 /home/user/public_html/subFolder      //like: dirname(__FILE__)
$_SERVER["REQUEST_URI"]    🡺                       /subFolder/yourfile.php?var=blabla
parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)🡺  /subFolder/yourfile.php 
$_SERVER["PHP_SELF"]       🡺                       /subFolder/yourfile.php

// ==================================================================
//if "YOURFILE.php" is included in "PARENTFILE.php" , and you visit  "PARENTFILE.PHP?abc":
$_SERVER["SCRIPT_FILENAME"]🡺 /home/user/public_html/parentfile.php
$_SERVER["PHP_SELF"]       🡺                       /parentfile.php
$_SERVER["REQUEST_URI"]    🡺                       /parentfile.php?abc
__FILE__                   🡺 /home/user/public_html/subFolder/yourfile.php




// ===================================================
// ============== PARSE_URL & PATHINFO ==============
// ===================================================
//parse_url
$x = parse_url($url);
$x['scheme']               🡺 https
$x['host']                 🡺       example.com
$x['path']                 🡺                  /subFolder/yourfile.php
$x['query']                🡺                                          var=blabla
$x['fragment']             🡺                                                     555 // hashtag outputed only in case, when hashtag-containing string was manually passed to function, otherwise PHP is unable to recognise hashtags in $_SERVER

//pathinfo (If you will ever use this function, I only recommend to pass `parse_url`s output as argument)
A = pathinfo($url);
B = pathinfo(parse_url($url)['path']);
A['dirname']               🡺 https://example.com/subFolder
B['dirname']               🡺                    /subFolder
A['basename']              🡺                               yourfile.php?var=blabla#555
B['basename']              🡺                               yourfile.php
A['extension']             🡺                                        php?var=blabla#555
B['extension']             🡺                                        php
A['filename']              🡺                               yourfile
B['filename']              🡺                               yourfile





// ===================================================
// ================= handy variables =================
// ===================================================
//If site uses HTTPS:
$HTTP_or_HTTPS = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off') || $_SERVER['SERVER_PORT']==443) ? 'https://':'http://' );            //in some cases, you need to add this condition too: if ('https'==$_SERVER['HTTP_X_FORWARDED_PROTO'])  ...

//To trim values to filename, i.e. 
basename($url)             🡺 yourfile.php

//excellent solution to find origin
$debug_files = debug_backtrace();       $initial_called_file = count($debug_files) ? $debug_files[count($debug_files) - 1]['file'] : __FILE__;
