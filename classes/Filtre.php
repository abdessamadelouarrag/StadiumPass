<?php 
require_once __DIR__ . "/../config/database.php";

class Filtre{
    private PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function filterByVille($ville){
        $sql = "SELECT * from matches where ville = :ville";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":ville" => $ville
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>