CREATE VIEW view_categories_tickets AS
SELECT 
    categories.id_categorie,
    categories.nom,
    tickets.id_ticket,
    tickets.id_user,
    tickets.quantite,
    tickets.place
FROM categories
JOIN tickets 
ON categories.id_categorie = tickets.id_categorie;
