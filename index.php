<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
//define path
require_once("config/define_path.php");
require_once("config/define_database.php");
require_once("config/connect.php");
require_once("config/define_variable.php");
//end define path

include(__LIB_PATH."Controller.php");
include(__LIB_PATH."View.php");
include(__LIB_PATH."Model.php");
include(__LIB_PATH."Bootstrap.php");
$bootstrap= new Bootstrap;

?>