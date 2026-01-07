<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../fpdf/fpdf.php";
class Ticket
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }


    public function createTicket($user_id, $match_id, $categorie_id, $quantite, $place)
    {
        $sql = "INSERT INTO tickets (id_user, id_match, id_categorie, quantite, place)
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id, $match_id, $categorie_id, $quantite, $place]);

        return (int) $this->pdo->lastInsertId();
    }


    public function genererPdf(int $idMatch, int $user_id, int $idTicket): string
    {
        $sql = "SELECT t.id_ticket, t.id_user, t.id_match, t.id_categorie,
            t.quantite, t.place, t.date_achat,
            m.titre, m.equipe_home, m.equipe_away, m.date_match, m.stade, m.ville, m.hour,
            c.nom AS categorie_nom, c.prix AS categorie_prix
            FROM tickets t INNER JOIN matches m     ON m.id_match = t.id_match
            INNER JOIN categories c  ON c.id_categorie = t.id_categorie
            WHERE t.id_match = ? AND t.id_user = ? AND t.id_ticket = ? LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idMatch, $user_id, $idTicket]);

        $t = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$t) {
            throw new Exception("Ticket introuvable.");
        }

        // 2) PDF
        $pdf = new FPDF();
        $qty = (int)$t['quantite'];

        // Si quantite <= 0, on force 1 page
        if ($qty <= 0) $qty = 1;

        for ($i = 0; $i < $qty; $i++) {
            $pdf->AddPage();

            // Place : si quantite > 1, on incrémente juste pour affichage
            $placeAffiche = (int)$t['place'] + $i;

            // Code unique (car pas dans DB)
            $code = strtoupper(substr(sha1($t['id_ticket'] . '|' . $t['id_user'] . '|' . $t['id_match'] . '|' . $placeAffiche), 0, 10));

            // ----- Design (comme ton code) -----
            $pdf->SetFillColor(245, 245, 245);
            $pdf->Rect(15, 20, 180, 110, 'F');
            $pdf->SetDrawColor(200, 0, 50);
            $pdf->Rect(15, 20, 180, 110);

            // Header
            $pdf->SetFillColor(200, 0, 50);
            $pdf->Rect(15, 20, 180, 20, 'F');
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetXY(15, 25);
            $pdf->Cell(180, 10, 'MATCH TICKET', 0, 0, 'C');

            // Equipes
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(15, 45);
            $pdf->Cell(180, 10, $t['equipe_home'] . ' VS ' . $t['equipe_away'], 0, 0, 'C');

            // Ligne séparation
            $pdf->SetDrawColor(200, 0, 50);
            $pdf->Line(25, 58, 185, 58);

            // Infos gauche
            $pdf->SetFont('Arial', '', 11);
            $pdf->SetXY(25, 65);
            $pdf->Cell(40, 8, 'Place:', 0, 0);
            $pdf->Cell(60, 8, (string)$placeAffiche, 0, 1);

            $pdf->SetX(25);
            $pdf->Cell(40, 8, 'Categorie:', 0, 0);
            $pdf->Cell(60, 8, $t['categorie_nom'] . ' (' . $t['categorie_prix'] . ' DH)', 0, 1);

            // Infos droite
            $pdf->SetXY(115, 65);
            $pdf->Cell(30, 8, 'Date:', 0, 0);
            $pdf->Cell(60, 8, $t['date_match'] . ' ' . $t['hour'], 0, 1);

            $pdf->SetX(115);
            $pdf->Cell(30, 8, 'Stade:', 0, 0);
            $pdf->Cell(60, 8, $t['stade'] . ' - ' . $t['ville'], 0, 1);

            // Code
            $pdf->SetFillColor(40, 40, 40);
            $pdf->Rect(25, 95, 160, 12, 'F');
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(25, 98);
            $pdf->Cell(160, 6, 'CODE : ' . $code, 0, 0, 'C');

            $pdf->SetFont('Arial', 'I', 9);
            $pdf->SetTextColor(120, 120, 120);
            $pdf->SetXY(15, 112);
            $pdf->Cell(180, 6, 'StadiumPass - Ticket Officiel', 0, 0, 'C');
        }

        $file = "ticket_{$idTicket}_match_{$idMatch}_user_{$user_id}.pdf";
        $pdf->Output('I', $file);

        return $file;
    }

    public function updateToatalCat($stock, $idmatch, $nomCategorie){
        $sql = "UPDATE categories SET stock_max = stock_max - :stock WHERE id_match = :id_match and nom = :nom";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":stock" => $stock,
            ":id_match" => $idmatch,
            ":nom" => $nomCategorie
        ]);
    }

    public function checkLimitTicket($iduser, $idmatch){
        $sql = "SELECT * from tickets where id_user = :iduser and id_match = :idmatch and quantite > 4";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":iduser" => $iduser,
            ":idmatch" => $idmatch
        ]);

        return true;
    }
}
