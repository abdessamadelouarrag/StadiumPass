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

    public function activeAccount($id){
        $sql = "UPDATE users SET status = 'activer' where id_user = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);
    }

    public function desactiverAccount($id){
        $sql = "UPDATE users SET status = 'desactiver' where id_user = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);
    }

    public function accountActiver() {
        $sql = "SELECT * from users where status = 'activer'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function statusMatches(){
        $sql = "SELECT * from matches where status = 'en_attent'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function accepterMatch($id){
        $sql = "UPDATE matches set status = 'accepter' where id_match = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);
    }

    public function refuserMatch($id){
        $sql = "UPDATE matches set status = 'refuser' where id_match = :id";

        $stmt =$this->pdo->prepare($sql);

        $stmt->execute([
            ":id"=> $id
        ]);
    }
}
?>