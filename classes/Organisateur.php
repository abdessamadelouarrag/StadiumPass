<?php 
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../classes/User.php";

class Organisateur extends User{

    private PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function infoOrga($id){
        $sql = "SELECT * FROM users where id_user = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMatch($titre, $e_home, $e_away, $date, $stade, $ville, $hour, $i_away, $i_home, $places, $idorg){
        $sql = "INSERT INTO matches (titre, equipe_home, equipe_away, date_match, stade, ville, hour, image_away, image_home, places, id_org)
                values (:titre, :equipe_home, :equipe_away, :date_match, :stade, :ville, :hour, :image_away, :image_home, :places, :idorg)";
        
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":titre" => $titre,
            ":equipe_home" => $e_home,
            ":equipe_away" => $e_away,
            ":date_match" => $date,
            ":stade" => $stade,
            ":ville" => $ville,
            "hour" => $hour,
            "image_away" => $i_away,
            ":image_home" => $i_home,
            ":places" => $places,
            ":idorg" => $idorg
        ]);

        return    $this->pdo->lastInsertId();

    }

    public function seeMatches($id){
        $sql = "SELECT * from matches where id_org = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function matchesW($id){
        $sql = "SELECT * from matches where id_org = :id and status = 'en_attent'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategorie($idmatch, $nom, $prix, $stock){
        $sql = "INSERT INTO categories (id_match, nom, prix, stock_max) VALUES (:idMatch, :nom, :prix, :stock_max)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idMatch" => $idmatch,
            ":nom" => $nom,
            ":prix" => $prix,
            ":stock_max" => $stock
        ]);
    }

    public function allPrix($idorg){
        $sql = "SELECT m.id_org,u.nom AS organisateur,SUM(t.quantite) AS total_billets_vendus,
                SUM(t.quantite * c.prix) AS total_prix FROM matches m JOIN users u ON u.id_user = m.id_org
                JOIN tickets t ON t.id_match = m.id_match JOIN categories c  ON c.id_categorie = t.id_categorie
                GROUP BY m.id_org, u.nom having id_org = :idorg";
        
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idorg" => $idorg
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>