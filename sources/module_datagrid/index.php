<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$basePath = __DIR__."/panels/";
$report=$basePath."report.json";
$form=$basePath."form.json";

loadModule("datagrid");

$moduleName = basename(dirname(__FILE__));
?>
<div class='col-xs-12 col-md-12 col-lg-12'>
	<div class='row'>
		<?php
			printDataGrid($report,$form,$form,["slug"=>"subtype/type/refid","glink"=>_link("modules/{$moduleName}","a=1"),"add_record"=>"Add Item","add_class"=>'btn btn-info'],"app");
		?>
	</div>
</div>
