<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$pluginArray = [
            "dashlet"=>"/pluginsDev/dashlets/",
            "widget"=>"/pluginsDev/widgets/",
            "module"=>"/pluginsDev/modules/",
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

switch ($_REQUEST['action']) {
    case "listforpath":
      if(isset($_REQUEST['path'])) {
        $_REQUEST['path'] = strtolower($_REQUEST['path']);
        
        if(array_key_exists($_REQUEST['path'],$pathPluginMap)) {
          printServiceMsg(["path"=>$_REQUEST['path'],"generators"=>$pathPluginMap[$_REQUEST['path']]]);
        } else {
          printServiceMsg("No generator found for the selected path<br>You can generate modules, widgets, services, etc");
        }
      } else {
        printServiceMsg("Path not defined");
      }
    break;
    case "listplugins":
        if($_REQUEST['format']=="list") {
            ksort($pluginArray);
            foreach($pluginArray as $f1=>$basePath) {
                echo "<li class='list-group-item' data-src='{$f1}'>Generate ".toTitle(_ling($f1))." <i class='fa fa-chevron-right pull-right'></i></li>";
            }
        } else {
            printServiceMsg($pluginArray);
        }
        break;
    case "form":
        if(isset($_REQUEST['src'])) {
            generateForm($_REQUEST['src']);
        } else {
            echo "Source Not Defined";
        }
        break;
    case "generate":
        if(isset($_REQUEST['name']) && isset($_REQUEST['src'])) {
            if(!isset($_REQUEST['path'])) {
              if(isset($pluginArray[$_REQUEST['src']])) {
                $_REQUEST['path'] = $pluginArray[$_REQUEST['src']];
              } else {
                printServiceMsg(["msg"=>"Generate Where?"]);
                return;
              }
            }
            $templatePath = __DIR__."/sources/".strtolower($_REQUEST['src']);
            foreach($templateArr as $a) {
              if(file_exists($templatePath.$a)) {
                $templatePath = $templatePath.$a;
                break;
              }
            }
          
            if(file_exists($templatePath)) {
              $finalPath = str_replace('//',"/",CMS_APPROOT.$_REQUEST['path']);
              
              if(is_file($templatePath)) {
                $finalPath = $finalPath.$_REQUEST['name'];
                $finalPathArr = explode(".",$finalPath);
                $ext = "";
                if(count($finalPathArr)<=1) {
                  $finalPathArr = explode(".",$templatePath);
                  $ext = $finalPathArr[count($finalPathArr)-1];
                  
                  $finalPath.=".{$ext}";
                } else {
                  $ext = $finalPathArr[count($finalPathArr)-1];
                }
                
                if(!is_dir(dirname($finalPath))) mkdir(dirname($finalPath),0777,true);
                
                if(@copy($templatePath,$finalPath)) {
                  printServiceMsg(["status"=>"ok","msg"=>"Successfully generated '{$_REQUEST['src']}'"]);
                } else {
                  printServiceMsg(["msg"=>"Error generating '{$_REQUEST['src']}'"]);
                }
              } else {
                $finalPath = $finalPath.$_REQUEST['name'];
                if(file_exists($finalPath)) {
                  printServiceMsg(["msg"=>"{$_REQUEST['name']} already exists at '{$_REQUEST['path']}'"]);
                } else {
                  $a = copyFolder($templatePath,$finalPath);
                  printServiceMsg(["status"=>"ok","msg"=>"Successfully generated '{$_REQUEST['src']}'"]);
                }
              }
            } else {
              printServiceMsg(["msg"=>"Boilerplate not found for {$_REQUEST['src']}"]);
            }
            //printServiceMsg("Generating {$_REQUEST['src']} with name {$_REQUEST['name']} @{$_REQUEST['path']}");
        } else {
            printServiceMsg(["msg"=>"Generate What?"]);
        }
        break;
}

/* 
 * php copying function that deals with directories recursively
 */
function copyFolder($source, $dest, $overwrite = false,$basePath = ""){
    if(!is_dir($basePath . $dest)) //Lets just make sure our new folder is already created. Alright so its not efficient to check each time... bite me
    mkdir($basePath . $dest);
    if($handle = opendir($basePath . $source)){        // if the folder exploration is sucsessful, continue
        while(false !== ($file = readdir($handle))){ // as long as storing the next file to $file is successful, continue
            if($file != '.' && $file != '..'){
                $path = $source . '/' . $file;
                if(is_file($basePath . $path)){
                    if(!is_file($basePath . $dest . '/' . $file) || $overwrite)
                    if(!@copy($basePath . $path, $basePath . $dest . '/' . $file)){
                        echo '<font color="red">File ('.$path.') could not be copied, likely a permissions problem.</font>';
                    }
                } elseif(is_dir($basePath . $path)){
                    if(!is_dir($basePath . $dest . '/' . $file))
                    mkdir($basePath . $dest . '/' . $file); // make subdirectory before subdirectory is copied
                    copyFolder($path, $dest . '/' . $file, $overwrite, $basePath); //recurse!
                }
            }
        }
        closedir($handle);
    }
}


function generateForm($src) {
    ?>
        <div class='row'>
            <br><br><br>
            <div class="col-md-8 col-md-offset-2">
                <form id='generatorForm'>
                  <input type='hidden' name='src' value='<?=$src?>' />
                  <div class="form-group col-md-6">
                    <label for="srcname">Source Name</label>
                    <input type="text" class="form-control" placeholder="Source Name" name='name' />
                  </div>
                  <div class="form-group col-md-6">
                    
                  </div>
                  <div class='col-md-12 text-center'>
                      <button type="button" class="btn btn-primary" onclick='generateOutput(this)'>Submit</button>
                  </div>
                </form>
            </div>
        </div>
    <?php
}
?>