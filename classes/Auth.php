<?php 

require_once "../config/database.php";
require_once "../classes/User.php";


class Auth extends User{

    private PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function signup($nom, $email, $password, $image, $role){

        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (nom, email, mot_de_passe, image, role)
                VALUES (:nom, :email, :mot_de_passe, :image, :role)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":nom" => $nom,
            ":email" => $email,
            ":mot_de_passe" => $hashpassword,
            ":image" => $image,
            ":role" => $role
        ]);
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users where email = :email and status = 'activer'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":email" => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$user){
            return false;
        }
        if(!password_verify($password, $user['mot_de_passe'])){
            return false;
        }

        return $user;
    }
}