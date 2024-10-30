<?php
if(!defined('ROOT')) exit('No direct script access allowed');

include_once __DIR__."/config.php";

$slug = _slug("a/gensrc/c");
if(strlen($slug['gensrc'])>0) {
    if(substr($slug['gensrc'], strlen($slug['gensrc'])-1,1)=="s") {
        $slug['gensrc'] = substr($slug['gensrc'], 0, strlen($slug['gensrc'])-1);
    }
    if(isset($pluginArray[$slug['gensrc']])) {
        include_once __DIR__."/pages/generator_form.php";
    } else {
        echo "<br><br><h3 align=center>Logiks Generator not supported</h3>";
    }
} else {
    include_once __DIR__."/pages/default.php";
}

?>