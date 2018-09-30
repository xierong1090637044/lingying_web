<?php
require_once('staticcache.php');
$data = array(
'id' => 1,
'name' => 'panda',
'number' => array(1,7,8)
);
$file = new File();
//获取缓存
$file->cacheData('index_cache');
var_dump($file->cacheData('index_cache'));
?>
