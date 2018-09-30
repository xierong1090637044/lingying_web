<?php
class File{
    private $_dir;//定义一个默认的路径
    const EXT = '.txt';//定义一个文件名后缀的常量
    public function __construct(){
        $this->_dir = dirname(__FILE__).'/files/';//获取文件的当前目录，再放到该目录下的files文件夹中,然后赋给$_dir
    }
    //把生成/获取/删除缓存这三个操作封装在cacheData方法中
    public function cacheData($key,$value = '',$path = ''){
        $filename = $this->_dir.$path.$key.self::EXT;//拼装成一个文件：默认目录、路径、文件名、文件名后缀
        //将value值写入缓存
        if($value !== ''){
        //删除缓存
            if (is_null($value)){
                return @unlink($filename);//unlink删除文件,@忽略警告
            }
            $dir = dirname($filename);
            if(!is_dir($dir)){//如果目录不存在就创建目录，首先要获取这个目录
            mkdir($dir,0777);
        }
        return file_put_contents($filename, $value);
    }
        //获取缓存
        if(!is_file($filename))
        {
        return false;
        }
        else{
            return file_get_contents($filename);
        }
    }
}
