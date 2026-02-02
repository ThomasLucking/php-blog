<?php 

namespace Thomas\PhpBlog\Config;


class Flash{
    static public function setValue($key, $value){
        $_SESSION[$key] = $value;
    }

    static public function getValueAndDelete($key){
        if(isset($_SESSION[$key])){
            $tempVar = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $tempVar;
        }
    }
}


