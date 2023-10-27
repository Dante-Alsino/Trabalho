<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\User;
use Source\Models\Instituicao;
use Source\Models\Pacote;
use Source\Models\Faq;
use Source\Models\Adm;
use Source\Models\Curso;

class Web {
    private $view;

    public function __construct()
    {
        $this->view = new Engine(CONF_VIEW_WEB,'php');
    }

    /* ##################### ROTAS ###################### */
    public function home() : void
    {
        echo $this->view->render(
            "login"
        );

    }

    public function pagelogin() : void
    {
        echo $this->view->render(
            "login"
        );

    }

        public function recuperar() : void
    {
        echo $this->view->render(
            "recuperar"
        );

    }

    public function cadastrar() : void
    {
        echo $this->view->render(
            "cadastrar"
        );

    }

    /* ################################################# */

    /* ###################### CADASTRO ######################## */

    public function register(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos para cadastrar!",
                    "type" => "warning"
                ];

                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if($user->findByEmail($data["email"])){
                $json = [
                    "message" => "Email já cadastrado!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User(
                null,
                $data["name"],
                $data["lastname"],
                $data["email"],
                $data["password"]
            );

            if(!$user->insert()){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data["name"],
                    "message" => $user->getMessage(),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
            return;
        }

        echo $this->view->render("register",["eventName" => CONF_SITE_NAME]);
    }

    /* ################################################### */

    /* ##################### LOG-IN ########################## */

    public function login(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe e-mail e senha para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if(!$user->validate($data["email"],$data["password"])){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "message" => $user->getMessage(),
                "type" => "success"
            ];
            echo json_encode($json);
            return;

        }

        echo $this->view->render("login",["eventName" => CONF_SITE_NAME]);

    }

    /* ############################################### */

}