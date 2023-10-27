<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Pacote;
use Source\Models\User;
use CoffeeCode\Uploader\Image;

class App{
    private $view;

    public function __construct(){
        $this->view = new Engine(CONF_VIEW_APP,'php');
    }
    public function home() : void{
        $user = new User(2);
        $user->findById();

        echo $this->view->render(
            "home",["user" => $user]
        );
    }

    public function logout()
    {
        session_destroy();
        setcookie("user","Logado",time() - 3600,"/");
        header("Location:http://www.localhost/OnTheWay/login");
    }

}
?>