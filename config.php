<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$pluginArray = [
            "dashlet"=>["/plugins/dashlets/","/pluginsDev/dashlets/"],
            "widget"=>["/plugins/widgets/","/pluginsDev/widgets/"],
  
            "module"=>["/plugins/modules/","/pluginsDev/modules/"],
            "module_datagrid"=>["/plugins/modules/","/pluginsDev/modules/"],
            "module_pages"=>["/plugins/modules/","/pluginsDev/modules/"],
            "module_multipage"=>["/plugins/modules/","/pluginsDev/modules/"],
  
            "service"=>"/services/",
            "form"=>"/misc/forms/",
            "report"=>"/misc/reports/",
            "view"=>"/misc/views/",
            "template"=>"/misc/templates/",
            "style"=>"/css/",
            "javascript"=>"/js/",
            "config"=>"/config/",
            "i18n"=>"/misc/i18n/",
            "menuitem"=>"/misc/menu/apps/",
        ];

$pathPluginMap = [
  "/plugins/modules/"=>["module"],
  "/pluginsdev/modules/"=>["module"],
  "/plugins/widgets/"=>["widget"],
  "/pluginsdev/widgets/"=>["widget"],
  "/plugins/dashlets/"=>["dashlet"],
  "/pluginsdev/dashlets/"=>["dashlet"],
  "/services/"=>["service"],
  "/css/"=>["style"],
  "/js/"=>["javascript"],
  "/config/"=>["cfg"],
  "/misc/forms/"=>["form"],
  "/misc/reports/"=>["report"],
  "/misc/templates/"=>["template"],
  "/misc/views/"=>["view"],
  "/misc/i18n/"=>["i18n"],
  "/misc/menus/apps/"=>["menuitem"],
  "/misc/menus/cms/"=>["menuitem"],
  "/misc/menus/misc/"=>["menuitem"],
];
$templateArr = [
      ".php",
      ".js",
      ".css",
      ".cfg",
      ".lst",
      ".json",
      ".inc",
      ".ling",
    ];
    
$pluginForm = [
    //     "dashlet"=>[
    //         "target"=> [
    // 			"label"=> "Target",
    // 			"group"=> "Admin",
    // 			"type"=> "select",
    // 			"options"=> [
    // 				"blank"=> "blank",
    // 				"_blank"=> "_blank",
    // 				"_parent"=> "_parent",
    // 				"_self"=> "_self",
    // 				"_top"=> "_top"
    // 			]
    // 		]
    //     ],
    ];
?>