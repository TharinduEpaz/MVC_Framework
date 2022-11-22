<?php
// Router class
namespace Core;
class router
{
    //  Associative arrays are arrays that use named keys that you assign to them.
    // methana thiyenne array dekaka aragena adala karana route eka store karaganna puluwan wenna

    protected $routes = [];
    protected $params = [];

    public function add($route, $params = [])
    {
        //convert the route to a regular expression
        $route = preg_replace('/\//','\\/',$route);

        //cnvert the variables
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)',$route);
        
        //added to convert the variables inside url such as id:123;
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //add start and end and the case insensitive flag 
        $route = '/^' . $route . '$/i';
        
        $this->routes[$route] = $params;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    // URL ekak awama eka route ekakata match karala hari file ekata yawanna tama me match kiyana function eka tiyenne.
    public function match($url)
    {
        // to loop through and print all the values of an associative array, you could use a foreach loop like this

        foreach ($this->routes as $route => $params) {
            if (preg_match($route,$url,$matches)) {

                foreach($matches as $key=>$match){
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }
              $this->params = $params;
              return true;
            }
            
        }
        return false; 
        
        
        //regular expression thama use karanne string ekk mokak hari pattern ekakata match karanna. me thiyenne hugak powerfull reg expression ekk meken groups dekakata kadenawa string eka controller and action kiyala.

        // $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        
        //ena URL eka regular expression ekata match karala controller and action kiyala dekakata kadala matches kiyana array eke store wenawa me preg_match eken
    } 

    public function getParams()
    {
        return $this->params;
    }

    public function dispatch($url){

        $url = $this->removeQueryStringVariables($url);

        if($this->match($url)){
            //extracting the controller from the URL 
            //controller will be a class name in the code
            $controller = $this->params['controller'];
            $controller = $this->convertToStudyCaps($controller);
            //used to auto load the class file using namespace
            $controller = "App\Controllers\\$controller";

            if(class_exists($controller)){
                //when creating the new controller the route parameters are passed to it. you can see the route paramenters in the action at the controller class
                $controller_object = new $controller($this->params);
                
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if(is_callable([$controller_object,$action])){
                    $controller_object->$action();
                }
                else{
                    echo "No method named $action found inside the $controller controller class";
                } 
            }
            else{
                echo "There is no controller exists $controller";
            }
        }else{
        echo " NO ROUTE MATCHED ERROR";
        }
    }

    protected function convertToStudyCaps($word){
        //Study Caps means the each starting letter of the class neme must nbe capital. this method will convert the controller name extracted from the url into a studly caps class name
        //BUG POSSIBLE HERE
        return str_replace(' ','',ucwords(str_replace('-',' ',$word)));
    }

    protected function convertToCamelCase($word){
        return lcfirst($this->convertToStudyCaps($word));
    }

    //this function will extract query string variables from the given URL
    protected function removeQueryStringVariables($url){
        if($url != ''){

            $parts = explode('&',$url,2);

            if(strpos($parts[0], '=') === false){
                $url = $parts[0];
            }
            else{
                $url = '';
            }
        }
        return $url;
    }


}
