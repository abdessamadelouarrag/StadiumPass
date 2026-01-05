<?php 
require_once __DIR__ . "/../config/database.php";

class Acheteur{
    private PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function infoAcheteur($id){
        $sql = "SELECT * FROM users where id_user = :iduser and status = 'activer'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":iduser" => $id
        ]);

        $infos = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$infos){
            return false;
        }

        return $infos;
    }

    // public function updateinfo($nom, $email, $image, $id){
    //     $sql = "UPDATE users set nom = :nom, email = :email, image = :image where id_user = :id";

    //     $stmt = $this->pdo->prepare($sql);

    //     $stmt->execute([
    //         ":nom" => $nom,
    //         "email" => $email,
    //         ":image" => $image,
    //         ":id" => $id
    //     ]);
    // }
}
?>