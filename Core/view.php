<?php 

namespace Core;

class View{

    //method to render the view files that are stored inside the APP/View directory
    public static function render($view){
        
        $file = "../App/Views/$view";
        

        if(is_readable($file)){
    
            require $file;
        }
        else{
            echo "$file not found";
        }
    }

}



?>