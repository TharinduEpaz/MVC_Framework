# MVC framework

### Why MVC is good?

![Screenshot 2022-11-15 at 3 43 19 PM](https://user-images.githubusercontent.com/89836213/201893124-aeed896b-4c2f-4505-81c5-684ee016523a.png)


### Controller

- user interaction

### Model

- data and database/storing and retrieving data

### Views

- what users sees on screen (HTML)

### why mvc?


- Separation of concerns - code does stuff + code show stuff
- easier code reuse
- organized code
- secure code
- developer specialization - front end and the backend developer specialization

## Folder Structure

- App
    - Controllers
    - Models
    - Views
- Core - our framework code is here
- Log - logging files
- Public - all the publicly accessible files go
    - only folder accisable to the web
    - front controller of any static sites (CSS and images)
    - root of the web server
    - IT IS SECURE BECAUSE THE DATABASE PASSWORDS CANNOT BE FOUND INSIDE THIS FOLDER
- Vendor - all the third party files and code

  

**htaccess file**

- prettier URLS

---

# Router

![Screenshot 2022-11-08 at 12 12 19 PM](https://user-images.githubusercontent.com/89836213/201893220-a84b1c95-7e75-45d9-b54a-7bd0b8275138.png)


- takes the URL and decides what to do with it
- create a router.php file inside the core folder
- create a class called router
- include or require that file inside the controller (index.php)
- require produces and error if the file is not found but include does not produce error

### Regular Expressions

- Used to match strings
- preg_match method is used to match the string to a pattern
- preg_replace method is used to match and replace a given pattern to a string

### Routing table

- routing table consists of regular expressions that can be used to match URLs.
- If a URL consists some ID like “audex/posts/123/edit” that ID 123 can be also detected and stored inside the routing table.
- Routing table consists of regular expressions other than the direct entries. IF we try to add entries manually into the routing table then the table may be very large. regular expressions is very efficient in this case.

---

## OOP PHP Concepts need for the framework

### Creating objects of a class

```php
$post = new Post();

//create object based on a variable
$class_name = "Post";
$post = new $class_name;
```

### Calling a method

```php
$post = new post();
$post->save();

//call a method based on a variable

$method = "save";
$post-> $method();
```

### Passing parameters to a method

```php
class post
{
	public function save($_Arg1,$_Arg2){};
}

$post = new post();
call_user_func_array([$post,"save"],[123,"abc"]); 
//first array consists the object and the name of the method
//second array consists the parameters
```

### class exists and is callable

```php
$class_name = "post"

if (class_exists($class_name)){
$post = new $class_name();
}

$method = "save";

if(is_callable([$class_name,$method]){
	$post->$method();
}
```

---

### Dispatching in the framework

- Routing = asking for directions
- Dispatching = following those directions

<aside>
💡 Dispatch function inside the router php file is dedicated to this purpose

</aside>

---

## Namespaces - good practice

- works like a folder or a directory which is used to store php files with some classes
- allows us to use more classes with the same name
- PHP looks for classes relative to the current namespace
- Classes without namespace is defined in the root namespace
- if we have lot of separate classes there may be lot of require statements
- 

```php
namespace App\core\products as Product;

$product = new Product();
```

## Autoloading class files on demand

using spl_autoloader

- autoload function will the lass when the specific object is initiated with the new keyword
- keep each class in a separate file, filename matching the class name
- Folders matching the namespace
- then the classes will be automatically loaded.

```php
spl_autoload_register(function ($classname){
require "classname.php"
}
```

---

## The __call magic method

<aside>
💡 If the called function is a private function or the called function does not exist in the class the default function called __call will be automatically called

</aside>

```php
private function __call($name,$parameters){}
```

### Action Filters

Used to execute some code before or after the every action

- Can be used to check the user is logged in or not
- Can be used to write a message into log file
- Can be used to set the language of the website etc.

```php
class posts{
public function __call($name,$args){
//run code before

call_user_func_array([$this,"$nameAction"],$args);
//run code after

}

public function indexAction(){}
```

### Organize Controllers in subdirectories

 

<aside>
💡 If you need to organize controllers in the files structure like App/Controllers/Admin/Index this will not work until you add new route and new modifications into the dispatch function (see vid 33)

</aside>

---

# Views

View can contain files HTML Json XML etc. View is used to render out the output of over framework. As a website. View file just shows data it contains HTML and a small amount of PHP. View has no knowledge about models or sessions. 

## How to add new views on this framework

1. Create a folder inside the App/Views folder
2. Add index.php inside that View folder
3. PHP file must contain the relevant HTML code
4. Add the route to the public/index.php
5. Add the controller named <filename.php> inside the App/Controllers folder
6. Controller must have the correct indexAction function.

*`Replace VIEW NAME with the necessary controller name`*

```php
<?php 

namespace App\Controllers;

use \Core\View;

class <<VIEW NAME>> extends \Core\Controller {

    public function indexAction(){
         View::render('<<VIEW NAME>>/index.php');

    }

}

?>
```