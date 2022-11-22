<?php 

namespace App\Controllers;
class Posts extends \Core\Controller {
    public function indexAction(){
        echo "Hello I am the index function inside the controller class Post";
        // echo '<p>Route parameters: <pre>' .
        // htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    }

    public function addNewAction(){
        echo "Hello I am the addNew function inside the controller class Post";
        // echo '<p>Route parameters: <pre>' .
        //      htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    }

    public function editAction(){
        echo "i am the edit action inside the Post class";
        // echo '<p>Route parameters: <pre>' .
        // htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }

    protected function before()
    {
       
    }
    protected function after()
    {
        
    }
}




?>