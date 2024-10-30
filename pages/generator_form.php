<?php
if(!defined('ROOT')) exit('No direct script access allowed');

loadModule("pages");

function pageContentArea() {
    return "<div id='contentArea'></div>";
}

echo _css(["logiksGenerators"]);
echo _js(["logiksGenerators"]);
printPageComponent(false,[
		"toolbar"=>false,
		"sidebar"=>false,
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
const refsrc = "<?=$slug['gensrc']?>";
$(function() {
    reloadPage();
});
function reloadPage() {
    $("#contentArea").load(_service("logiksGenerators","form","raw")+"&src="+refsrc);
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