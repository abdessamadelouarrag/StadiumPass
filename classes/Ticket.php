<?php 
require_once __DIR__ . "/../config/database.php";
class Ticket{
    private PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function createTicket($id_user,$id_match, $id_categorie, $quantite, $place){
        $sql ="INSERT INTO tickets (id_user, id_match, id_categorie, quantite, place_stade)
                VALUES (:iduser,:idmatch, :idcategorie, :quantite, :place)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":iduser" => $id_user,
            ":idmatch" => $id_match,
            ":idcategorie" => $id_categorie,
            ":quantite" => $quantite,
            ":place" => $place
        ]);
    }
}

?>