1.1 : 	SELECT Nom,Prenom,Age FROM `personne` WHERE Age > 50
1.2 : 	SELECT Nom,Prenom,Age,Libelle FROM `personne`
		LEFT JOIN langue ON personne.Id_Langue = langue.Id
		WHERE Libelle = 'Francais' AND Nom LIKE '%DU%'
1.3 : 	SELECT Nom,Prenom,Age FROM `personne` ORDER BY Nom LIMIT 3
1.4 : 	SELECT AVG(Age) , Libelle
		FROM `personne`
		JOIN langue ON personne.Id_Langue = langue.Id
		GROUP BY Id_Langue
1.6 : 	UPDATE personne 
		JOIN langue ON personne.Id_Langue = langue.Id
		SET age = 33 WHERE libelle LIKE '%g%'
1.7 : 	DELETE FROM personne WHERE prenom LIKE 'R%' AND nom LIKE '%n'
1.8 :	SELECT COUNT(*) AS Nombre , Libelle
		FROM `personne`
		JOIN langue ON personne.Id_Langue = langue.Id
		WHERE age NOT BETWEEN 30 AND 40
		GROUP BY Id_Langue

1.9 :	La moyenne dage des personnes par langue parlant francais ou anglais ayant cet moyenne superieur a 35 ans 
		SELECT AVG(Age) AS Moyenne , Libelle 
		FROM `personne`
		JOIN langue ON personne.Id_Langue = langue.Id
		GROUP BY Id_Langue
		HAVING AVG(Age) > 35

1.5 : 	SELECT nom , prenom , Age  From personne
		WHERE Age > (
				SELECT AVG(Age) AS moyenne FROM personne 
				JOIN langue ON personne.Id_Langue = langue.Id
				WHERE libelle = 'Anglais'
			)

SELECT * FROM Personne JOIN Langue ON Personne.Id_langue = Langue.Id

SELECT MAX(Age) AS Age_maximum,  Libelle
FROM personne
LEFT JOIN langue ON personne.Id_Langue = langue.Id
GROUP BY Id_Langue


SELECT COUNT(*) as Nombre_personne, Libelle
FROM personne
LEFT JOIN langue ON personne.Id_Langue = langue.Id
GROUP BY Id_Langue

EXERCICE 5 : SELECT N_Employe , Date_commande FROM DBA_Commandes WHERE N_Employe = 8
EXERCICE 6 : SELECT Nom , Date_embauche FROM DBA_Employes WHERE Nom = 'King'
EXERCICE 7 : SELECT Ref_Produit , Unité_en_stock , Nom_du_produit FROM DBA_Produits Where Ref_Produit = 39

EXERCICE 16 : SELECT N_commande , SUM(Quantite) , COUNT(*) FROM DBA_Details_commandes GROUP BY N_commande
EXERCICE 17 : SELECT Ref_produit , SUM(Quantite) , COUNT(*) FROM DBA_Details_commandes GROUP BY Ref_Produit 
EXERCICE 18 : SELECT N_commande , SUM(Quantité) FROM DBA_Details_commandes WHERE N_commande = 10250
EXERCICE 19 : SELECT Ref_produit , COUNT(*) , SUM(Quantite) FROM DBA_Details_commandes HAVING Quantite >= 50 GROUP BY Ref_Produit 

EXERCICE 19 bis : SELECT N_Employe , nom , COUNT(*) FROM DBA_Commandes LEFT JOIN DBA_Employes ON DBA_Commandes.N_Employe = DBA_Employes.N_Employe HAVING COUNT(*) >= 10 GROUP BY N_Employe
EXERCICE 20 : SELECT Pays_livraison , Date_commande FROM DBA_Commandes HAVING Date_commande > DATE(31/07/1993) WHERE Pays_livraison = 'France'
			  SELECT Societe FROM client JOIN commande ON client.codeclient = commande.codeclient WHERE pays = 'FRANCE' AND Date_commande < 31/07/1993
EXERCICE 21 : SELECT N_commande , codeclient , Date_commande FROM DBA_Commandes WHERE codeclient = 'BONAP'
EXERCICE 22 : SELECT Nom_du_produit , Nom , Date_commande FROM DBA_Commandes JOIN DBA_Details_commandes ON DBA_Commandes.N_commande = DBA_Details_commandes.N_commande JOIN DBA_Produits ON DBA_Details_commandes.Ref_Produit = DBA_Produits.Ref_Produit JOIN DBA_Employes ON DBA_Commandes.N_Employe = DBA_Employes.N_Employe WHERE Nom = 'Fuller'
EXERCICE 22 bis : SELECT Pays , COUNT(*) FROM DBA_Commandes LEFT JOIN DBA_Clients ON DBA_Commandes.N_commande = DBA_Clients.N_commande GROUP BY Pays
EXERCICE 22 ter : SELECT societe , COUNT(*) AS 'Nombre de commandes' , Pays , Date_commande  
				  FROM DBA_Commandes 
				  LEFT JOIN DBA_Clients ON DBA_Commandes.codeclient = DBA_Clients.codeclient 
				  WHERE Pays = 'France' 
				  GROUP BY societe 
				  HAVING Date_commande > DATE(01/01/1993) AND COUNT(*) > 10

EXERICE 2.1 : 	SELECT 	(CASE
				WHEN Age > 50 THEN CONCAT(SUBSTR(Nom,1,3),' ',SUBSTR(Prenom,1,3))   
				WHEN Age <= 50 THEN CONCAT(RIGHT(Nom,3),' ',RIGHT(Prenom,3))
				ELSE 1
				END ) AS Nom_Prenom FROM personne;
EXERCICE 2.2 : 	SELECT Nom ,	(CASE
				WHEN LENGTH(NOM) = 6 THEN   CURTIME()
				WHEN LENGTH(NOM) <> 6 THEN ADDTIME(CURTIME(),'01:00:00')
				ELSE 1
				END ) AS Heure_courante FROM personne;
EXERCICE 2.3 : 	SELECT libelle 
				FROM personne 
				LEFT JOIN langue ON personne.Id_langue <> langue.Id 
				WHERE Nom = 'DUPONT'
EXERCICE 2.4 : 	SELECT SUM(AGE) AS Age_Total , libelle 
				FROM personne 
				LEFT JOIN langue ON personne.Id_Langue = langue.Id 
				GROUP BY libelle
EXERCICE 2.5 : 	CREATE VIEW Nom_commun AS
				SELECT SUBSTR(Nom,1,4) as Nom_tronc, prenom FROM Personne WHERE Age < 35
				UNION
				SELECT Nom as Nom_commun, prenom
				FROM personne P1
				WHERE Nom IN (
				SELECT Nom
				FROM personne P2
				WHERE P1.Id_personne <> P2.Id_personne
				)
EXERCICE 2.6 : 	SELECT function_somme(LENGTH(Nom),Age) AS Age , (CASE
				WHEN Age >= 60 THEN 'Retraite'
				WHEN Age < 60 THEN 'Actif'
				ELSE 1
				END) FROM personne