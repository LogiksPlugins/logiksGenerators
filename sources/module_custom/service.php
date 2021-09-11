<?php
if(!defined('ROOT')) exit('No direct script access allowed');


switch($_REQUEST['action']) {
	case "list":
		printServiceMsg(["status"=>"ok"]);
	break;
}
?>
