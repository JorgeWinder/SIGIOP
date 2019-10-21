<?php

    class View{
        
        function render($controller,$view){
            $controller = get_class($controller);
            require './Views/'.$controller.'/'.$view.'.php';
        }
        
    }