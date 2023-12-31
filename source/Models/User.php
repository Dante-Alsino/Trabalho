<?php

namespace Source\Models;

use Source\Core\Connect;

class User {
    private $id;
    private $name;
    private $lastname;
    private $email;
    private $password;
    private $message;
    private $photo;
    private $phone;
    private $JSON;

    
    public function getPhone(): ?string{
        return $this->phone;
    }

    public function setPhone(?string $phone): void{
        $this->phone = $phone;
    }

    /**
     * @return int|null
     */

    public function getPhoto(): ?string{
        return $this->photo;
    }

    public function setPhoto(?string $photo): void{
        $this->photo = $photo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

     /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getLastname(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getJSON() : string
    {
        return json_encode(
            ["user" => [
                "name" => $this->getName(),
                "lastname" => $this->getLastname(),
                "email" => $this->getEmail()
            ]], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function __construct(
        int $id = NULL,
        string $name = NULL,
        string $lastname = NULL,
        string $email = NULL,
        string $password = NULL,
        string $phone = NULL,
        string $photo = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->photo = $photo;
    }

    /**
     * @return array|false
     */
    public function selectAll ()
    {
        $query = "SELECT * FROM users";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    /**
     * @return bool
     */
    public function findById() : bool
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            $user = $stmt->fetch();
            $this->name = $user->name;
            $this->lastname = $user->lastname;
            $this->email = $user->email;
            return true;
        }
    }

    /**
     * @param string $email
     * @return bool
     */
    public function findByEmail(string $email) : bool
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function validate (string $email, string $password) : bool
    {
        $query = "SELECT * FROM users WHERE email LIKE :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            $this->message = "Usuário e/ou Senha não cadastrados!";
            return false;
        } else {
            $user = $stmt->fetch();
            if(!password_verify($password, $user->password)){
                $this->message = "Usuário e/ou Senha não cadastrados!";
                return false;
            }
        }

        $this->id = $user->id;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->photo = $user->photo;
        $this->message = "Bem-vindo(a)!";

        $arrayUser = [
            "id" => $this->id,
            "name" => $this->name,
            "lastname" => $this->lastname,
            "phone" => $this->phone,
            "email" => $this->email,
            "photo" => $this->photo,
        ];

        $_SESSION["user"] = $arrayUser;
        setcookie("user","Logado",time()+60*60,"/");
        return true;
    }

    /**
     * @return bool
     */
    public function insert() : bool
    {
        $query = "INSERT INTO users (name, lastname, email, password) VALUES (:name, :lastname, :email, :password)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindValue(":password", password_hash($this->password,PASSWORD_DEFAULT));
        $stmt->execute();
        $this->id = Connect::getInstance()->lastInsertId();
        $this->message = "Usuário cadastrado com sucesso!";
        $_SESSION["user"] = $this;
        return true;
    }

    public function update()
    {
        $query = "UPDATE users SET name = :name, lastname = :lastname, phone = :phone, email = :email, photo = :photo WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":lastname",$this->lastname);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":phone",$this->phone);
        $stmt->bindParam(":photo",$this->photo);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();
        $arrayUser = [
            "id" => $this->id,
            "name" => $this->name,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "phone" => $this->phone,
            "photo" => $this->photo
        ];
        $_SESSION["user"] = $arrayUser;
        $this->message = "Usuário alterado com sucesso!";
    }

    public function getArray() : array
    {
        return ["user" => [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "lastname" => $this->getLastname(),
            "email" => $this->getEmail(),
            "phone" => $this->getPhone()
        ]];
    }

}