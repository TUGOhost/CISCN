<?php
    namespace core;
    class mypro{

        public static $classMap = array();
        public $assign;
        static public function run(){
            
            $route = new \core\lib\route();
            $ctrlClass = $route->ctrl;
            $action = $route->action;
            $ctrlfile = APP.'/ctrl/'.$ctrlClass.'Ctrl.php';

            $ctrlClass = '\\'.MODULE.'\ctrl\\'.$ctrlClass.'Ctrl';
            
            if(is_file($ctrlfile)){
                include $ctrlfile; 
                $ctrl = new $ctrlClass;
                $ctrl->$action();
                
            }else{
                throw new \Exception("can't find controller ".$ctrlClass);
            }

        }

        static public function load($class){
            if(isset($classMap[$class])){
                return true;
            }else{
                $class = str_replace('\\','/',$class);
                $file = MYPRO.'/'.$class.'.php';
                if(is_file($file)){
                    include $file;
                    self::$classMap[$class] = $class;
                }else{
                    return false;
                }
            }
        }

        public function assign($name, $value)
        {
            $this->assign[$name] = xss_escape($value);
        }

        public function display($file)
        {
            $path = APP."/views/".$file;
            if(is_file($path)){
                if($this->assign){
                    extract($this->assign);
                }
                include $path;
            }
        }

    }