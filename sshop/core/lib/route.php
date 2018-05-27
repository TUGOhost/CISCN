<?php
namespace core\lib;
use core\lib\conf;

class route{
    public $ctrl;
    public $action;

    public function __construct(){


        if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI']!= '/' ){
            $path = $_SERVER['REQUEST_URI'];
            $patharr = explode('/',trim($path,'/'));

            if($patharr[0]==='static')
            {
                
                if(@$patharr[1]=='upload'){
                    header('content-type:image/jpg;');
                    echo file_get_contents(APP.$_SERVER['REQUEST_URI']);
                    exit();
                }else if(@$patharr[1]=='css'){
                    header('Content-type: text/css');
                    echo file_get_contents(APP.$_SERVER['REQUEST_URI']);
                    exit();
                }else if(@$patharr[1]=='js'){
                    header('Content-type: text/javascript');
                    echo file_get_contents(APP.$_SERVER['REQUEST_URI']);
                    exit();
                }else{
                    echo file_get_contents(APP.$_SERVER['REQUEST_URI']);
                    exit();
                }
                
            }
            if(isset($patharr[0])){
                $this->ctrl = $patharr[0];
            }
            if($patharr[0]==='info' && isset($patharr[1])){
                $this->action = 'index';
                $_GET['id'] = $patharr[1];
            }else if (isset($patharr[1])){
                $this->action = $patharr[1];

                unset($patharr[1]);
            }else{
                $this->action = conf::get('ACTION','route');
			}

        }else{
            $this->ctrl = conf::get('CTRL','route');
            $this->action = conf::get('ACTION','route');
        }



    }
}