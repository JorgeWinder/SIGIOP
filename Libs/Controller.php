<?php

    class Controller{
        
        function __construct() {
            Session::init();
            $this->view = new View();
            $this->loadModel();
        }
        
        function loadModel(){
            $model = get_class($this).'_Model';
            $path = 'Models/'.$model.'.php';
            
            if(file_exists($path)){
                require $path;
                $this->model = new $model();
            }
        }
        
    }