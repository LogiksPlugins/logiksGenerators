<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$basePath = __DIR__."/pages/";
$slug=_slug("module/page");

if(!isset($slug['page']) || strlen($slug['page'])<=0) {
  $slug['page'] = "a";
}

if(isset($slug['page']) && strlen($slug['page'])>0) {
  $pageFile = $basePath.$slug['page'].".php";
  if(file_exists($pageFile) && is_file($pageFile)) {
    include_once $pageFile;
  } else {
    echo "<h1 align=center>No Page Found</h1>";
  }
}
?>