<?php

class Autoload{
    public static function load(){
        spl_autoload_register(function($className){
            if(file_exists('class/'.$className.'.php')){
                require_once 'class/'.$className.'.php';
            }
            else if(file_exists('controllers/'.$className.'.php')){
                require_once 'controllers/'.$className.'.php';
            }
            else if(file_exists('models/'.$className.'.php')){
                require_once 'models/'.$className.'.php';
            }
            else if(file_exists('views/'.$className.'.php')){
                require_once 'views/'.$className.'.php';
            }
        });
    }
}