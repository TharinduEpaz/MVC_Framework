<?php 

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller {

    public function indexAction(){
         View::render('Home/index.php');

    }
    protected function before()
    {
   
    }
    protected function after()
    {
    }

  
      
    

}







?>