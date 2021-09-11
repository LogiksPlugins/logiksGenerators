<?php
if(!defined('ROOT')) exit('No direct script access allowed');

loadModule("pages");

function pageSidebar() {
  return "<div id='componentTree' class='componentTree list-group list-group-root'></div>";
}

function pageContentArea() {
  return "";
}

$toolBar = [
// 			["title"=>"Search Store","type"=>"search","align"=>"right"],
            
// 			"panel1"=>["title"=>"Available API","align"=>"right","class"=>($_REQUEST['panel']=="panel1")?"active":""],
//      "panel2"=>["title"=>"APIKeys","align"=>"right","class"=>($_REQUEST['panel']=="panel2")?"active":""],
// 			['type'=>"bar"],
        ["title"=>"Search Roles","type"=>"search","align"=>"right"],
        "refreshUI"=>["icon"=>"<i class='fa fa-refresh'></i>"],
			
// 			"createNew"=>["icon"=>"<i class='fa fa-plus'></i>","tips"=>"Create New"],
// 			['type'=>"bar"],
// 			"trash"=>["icon"=>"<i class='fa fa-trash'></i>"],

        //"loadTextEditor"=>["title"=>"Template","align"=>"right"],
		//"loadInfoComponent"=>["title"=>"About","align"=>"right"],

// 			"generateRoles"=>["icon"=>"<i class='fa fa-gears'></i>","tips"=>"Generate New Roles"],
		//"createTemplate"=>["icon"=>"<i class='fa fa-plus'></i>","tips"=>"Create New"],
		//"openExternal"=>["icon"=>"<i class='fa fa-external-link'></i>","class"=>"onsidebarSelect"],
		//"preview"=>["icon"=>"<i class='fa fa-eye'></i>","class"=>"onsidebarSelect onOnlyOneSelect","tips"=>"Preview Content"],
		//['type'=>"bar"],
		//"rename"=>["icon"=>"<i class='fa fa-terminal'></i>","class"=>"onsidebarSelect onOnlyOneSelect","tips"=>"Rename Content"],
// 			"deleteTemplate"=>["icon"=>"<i class='fa fa-trash'></i>","class"=>"onsidebarSelect"],
];

$moduleName = basename(dirname(__FILE__));

echo _css([$moduleName]);
echo _js($moduleName);

printPageComponent(false,[
    "toolbar"=>$toolBar,
    "sidebar"=>"pageSidebar",
    "contentArea"=>"pageContentArea"
  ]);
?>