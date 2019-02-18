<?php
if(!defined('ROOT')) exit('No direct script access allowed');


switch ($_REQUEST['action']) {
    case "listplugins":
        $pluginArray = [
            "dashlet",
            "widget",
            "module",
            "service",
            "form",
            "report",
        ];
        if($_REQUEST['format']=="list") {
            foreach($pluginArray as $f1) {
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
        if(isset($_REQUEST['name']) && isset($_REQUEST['srcname'])) {
            printServiceMsg("Generating {$_REQUEST['src']} with name {$_REQUEST['name']}");
        } else {
            printServiceMsg("Generate What?");
        }
        break;
}
function generateForm($src) {
    
    ?>
        <div class='row'>
            <br><br><br>
            <div class="col-md-8 col-md-offset-2">
                <form id='generatorForm'>
                  <input type='hidden' name='srctype' value='<?=$src?>' />
                  <div class="form-group col-md-6">
                    <label for="srcname">Source Name</label>
                    <input type="text" class="form-control" placeholder="Source Name" name='srcname' />
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