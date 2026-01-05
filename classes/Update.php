<?php 
require_once __DIR__ . "/../config/database.php";

class Update{

    private PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function updateinfo($nom, $email, $image, $id){
        $sql = "UPDATE users set nom = :nom, email = :email, image = :image where id_user = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":nom" => $nom,
            "email" => $email,
            ":image" => $image,
            ":id" => $id
        ]);
    }
}
?>