<?php
if(!defined('ROOT')) exit('No direct script access allowed');
loadModule("pages");

function pageContentArea() {
    return "<div id='contentArea'></div>";
}
function pageSidebar() {
    $html = ["<div id='sidebarArea'>","<ul class='list-group'>"];
    $html[] = "</ul>";
    $html[] = "</div>";
    
    return implode("",$html);
}

echo _css(["logiksGenerators"]);
echo _js(["logiksGenerators"]);
printPageComponent(false,[
		"toolbar"=>[
			//"loadTextEditor"=>["title"=>"Template","align"=>"right"],
			//"loadInfoComponent"=>["title"=>"About","align"=>"right"],
// 			["title"=>"Search Roles","type"=>"search","align"=>"right"],
			
			"reloadPage"=>["icon"=>"<i class='fa fa-refresh'></i>"],
// 			"generateRoles"=>["icon"=>"<i class='fa fa-gears'></i>","tips"=>"Generate New Roles"],
			//"createTemplate"=>["icon"=>"<i class='fa fa-plus'></i>","tips"=>"Create New"],
			//"openExternal"=>["icon"=>"<i class='fa fa-external-link'></i>","class"=>"onsidebarSelect"],
			//"preview"=>["icon"=>"<i class='fa fa-eye'></i>","class"=>"onsidebarSelect onOnlyOneSelect","tips"=>"Preview Content"],
			//['type'=>"bar"],
			//"rename"=>["icon"=>"<i class='fa fa-terminal'></i>","class"=>"onsidebarSelect onOnlyOneSelect","tips"=>"Rename Content"],
// 			"deleteTemplate"=>["icon"=>"<i class='fa fa-trash'></i>","class"=>"onsidebarSelect"],
		],
		"sidebar"=>"pageSidebar",
		"contentArea"=>"pageContentArea"
	]);
?>
<style>
#sidebarArea .list-group-item {
    cursor:pointer;
}
</style>
<script>
$(function() {
    $("#sidebarArea").delegate(".list-group-item","click",function() {
        $("#sidebarArea .active").removeClass("active");
        $(this).addClass("active");
        refsrc = $(this).data("src");
        $("#contentArea").load(_service("logiksGenerators","form","raw")+"&src="+refsrc);
    })
    reloadPage();
});
function reloadPage() {
    $("#sidebarArea>ul").load(_service("logiksGenerators","listplugins","list"));
    $("#contentArea").html("<h3 align=center>Load a generator</h3>");
}
function generateOutput() {
    qData = $("#generatorForm").serialize();
    $("#contentArea").html("<p>Generating "+$("#sidebarArea .active").data("src")+"</p>");
    processAJAXPostQuery(_service("logiksGenerators","generate"), qData, function(ans) {
        $("#contentArea").html(ans.Data);
    });
}
</script>