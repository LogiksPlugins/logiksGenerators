<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$basePath = __DIR__."/panel/";
$report=$basePath."report.json";
$form=$basePath."form.json";

loadModule("datagrid");
?>

<div class='col-xs-12 col-md-12 col-lg-12'>
	<div class='row'>
		<?php
			printDataGrid($report,$form,$form,["slug"=>"subtype/type/refid","glink"=>_link("modules/bookMarks"),"add_record"=>"Add BookMark","add_class"=>'btn btn-info'],"app");
		?>
	</div>
</div>
<script>
function viewBookmark(src) {
	window.open($(src).find(".link_uri").text());
}
</script>