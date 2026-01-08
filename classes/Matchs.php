<?php

require_once __DIR__ . "/../config/database.php";

class Matchs
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function allMatches()
    {
        $sql = "SELECT * from matches where status = 'accepter'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function matchesById($id)
    {
        $sql = " SELECT * from matches where status = 'accepter' and id_match = :idmatch";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idmatch" => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function categorieMatch($id)
    {
        $sql = "SELECT * from categories where id_match = :idmatch";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idmatch" => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkDateStartMatch(int $idmatch): void
    {
        $sql = "UPDATE matches SET status_match = 'terminer' WHERE id_match = :idmatch AND status = 'accepter'
            AND status_match = 'en_attent' AND date_match < NOW()";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":idmatch" => $idmatch]);
    }
}
