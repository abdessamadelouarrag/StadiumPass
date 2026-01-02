<?php 

require_once "../config/database.php";

class Admin{
    private PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function showAllAccounts() {
        $sql = "SELECT * from users where role = 'acheteur' or role = 'organisateur' ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>