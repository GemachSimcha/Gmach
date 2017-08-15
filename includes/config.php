<?php
echo '<p>בס"ד</p>';

// file definitions
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'wamp64-b'.DS.'Gmach-www'.DS.'gmach');
    defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
// Database Constants
    defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
    defined('DB_USER') ? null :define("DB_USER", "root");
    defined('DB_PASS') ? null :define("DB_PASS", "root");
    defined('DB_NAME') ? null :define("DB_NAME", "gmach");
    
// CREATE DB if does not exist
    $new_database = new mysqli(DB_SERVER, DB_USER, DB_PASS);
    $query_file = LIB_PATH.DS.'sql_file.txt';
    $query_file_open = fopen($query_file, 'r');
    $sql = fread($query_file_open, filesize($query_file));
    fclose($query_file_open);
    $new_database->multi_query($sql);
    mysqli_close($new_database);

/*      Database connection         */
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$mysqli->set_charset("utf8");

// balance of all loans, deposits, repayments, withdrawals and donations (for jumbotron)
    $balance_query = "SELECT SUM(Amount) as balance FROM transactions";
    $balance = $mysqli->query($balance_query);
    $balanc = mysqli_fetch_assoc($balance);
    $balance->close();

// variables for insert statements
    foreach ($_POST as $key => $value) {
        $$key = $value;
    }     
?>