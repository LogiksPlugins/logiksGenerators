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
  .outputPath {
    font-size: 12px;
    margin-top: 20px;
    text-align: center;
  }
  .outputPath:before {
    content: "PATH: `";
  }
  .outputPath:after {
    content: "`";
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
    $("#contentArea").html("<h3 align=center>Generating "+$("#sidebarArea .active").data("src")+"</h3><div class='text-center'><i class='fa fa-spinner fa-spin fa-2x'></i></div>");
    processAJAXPostQuery(_service("logiksGenerators","generate"), qData, function(ansData) {
        if(ansData.Data.status == "ok") {
          if(ansData.Data.msg==null || ansData.Data.msg.length<=0) ansData.Data.msg = "Generating is complete, please refresh sidebar.";
          $("#contentArea").html("<h3 align=center>"+ansData.Data.msg+"</h3><br><br><br><div align=center><button class='btn btn-default text-center' onclick='refreshSidebar()'><i class='fa fa-info-circle'></i> Refresh Sidebar</button></div>");
        } else {
          if(ansData.Data.msg==null || ansData.Data.msg.length<=0) ansData.Data.msg = "Error generating source code"; 
          $("#contentArea").html("<h3 align=center>"+ansData.Data.msg+"</h3>");
        }
    },"json");
}
function refreshSidebar() {
    if(typeof parent.loadFileTree == "function") parent.loadFileTree();
    else lgksToast("Failed to refresh sidebar, please do it manually");
}
</script>