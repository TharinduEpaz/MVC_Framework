<?php 

namespace Core;

use function PHPSTORM_META\argumentsSet;

abstract class Controller{
    protected $route_params=[];

    //there is s potential security threat in this function __call
    //refer course section 033 for the threat
    public function __call($name, $arguments)
    {
        $method = $name . 'Action';

        if(method_exists($this,$method)){
            if($this->before() !== false){
                call_user_func_array([$this,$method],$arguments);
                $this->after();
            }
            
        }
        else{
            echo "Method not found in the controller";
        }
    }

    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    protected function before(){

   

    }

    protected function after(){
                
    }

}

?>