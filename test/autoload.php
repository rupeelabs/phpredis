<?php
function autoload($class){
    $pos = strrpos($class, '\\');
    $dir = substr($class, 0, $pos).'/src'.substr($class, $pos);
    //echo $dir;exit;
	$class = str_replace('\\','/',$dir);
	//echo $_SERVER['DOCUMENT_ROOT'].'/Public/css/my/'.$class.'.php';exit;
	require_once $_SERVER['DOCUMENT_ROOT'].'/'.$class.'.php';
}
spl_autoload_register("autoload");