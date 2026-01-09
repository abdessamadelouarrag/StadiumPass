<?php
require_once __DIR__ . "/../config/database.php";


class Avis
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function addAvis($id_match, $id_user, $avis)
    {
        $sql = "INSERT into comments (id_user, id_match, contenu) VALUES (:iduser, :idmatch, :avis)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":iduser" => $id_user,
            "idmatch" => $id_match,
            ":avis" => $avis
        ]);
    }

    public function seeAllAvis(){
        $sql = "SELECT c.id_comment, c.contenu, c.created_at, u.nom AS user_name, m.titre AS match_title, m.equipe_home, m.equipe_away
                FROM comments c JOIN users u ON c.id_user = u.id_user JOIN matches m ON c.id_match = m.id_match";
        
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function seeAvisById($idorg)
    {
        $sql = "SELECT c.id_comment, c.contenu, c.created_at, u.nom AS user_name, m.titre AS match_title, m.equipe_home, m.equipe_away
                FROM comments c JOIN users u ON c.id_user = u.id_user JOIN matches m ON c.id_match = m.id_match
                WHERE m.id_org = :idorg";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idorg" => $idorg
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function allAvicMAtch($idmatch)
    {
        $sql = "SELECT c.id_comment, c.contenu, c.created_at, u.nom AS user_name, m.titre AS match_title,
                m.equipe_home, m.equipe_away FROM comments c JOIN users u ON c.id_user = u.id_user
                JOIN matches m ON c.id_match = m.id_match WHERE m.id_match = :idmatch";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idmatch" => $idmatch
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
