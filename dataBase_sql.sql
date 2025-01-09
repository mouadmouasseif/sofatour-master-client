-- ********************tables**********************************
create DATABASE ma_thechnologies_gestion_facturation;
USE ma_thechnologies_gestion_facturation;
create TABLE utilisateurs(id_user INT AUTO_INCREMENT PRIMARY KEY, nom_utilisateur VARCHAR(255) , mot_de_passe VARCHAR(255) , nom VARCHAR(255) , prenom VARCHAR(255) , email VARCHAR(255) , profils INT) ENGINE=InnoDB;
create TABLE profils(id_profil INT AUTO_INCREMENT PRIMARY KEY, nom_profil VARCHAR(255)) ENGINE=InnoDB;
create TABLE clients(id_client INT AUTO_INCREMENT PRIMARY KEY , societe VARCHAR(255) , ice VARCHAR(255) ,  rc VARCHAR(255) , adresse VARCHAR(1500) , date_d_entree DATETIME , utilisateurs INT , client_type INT ,  avance BOOLEAN , client_secteur INT , Agence_evementiel BOOLEAN) ENGINE=InnoDB;
create TABLE client_type(id_client_type INT AUTO_INCREMENT PRIMARY KEY, client_type VARCHAR(255)) ENGINE=InnoDB;
create TABLE client_responsable_interlocuteur(id_client_responsable_interlocuteur INT AUTO_INCREMENT PRIMARY KEY, nom_complet VARCHAR(255) , poste VARCHAR(255) , numero_telephone VARCHAR(255) , c_responsable_interlocuteur INT , clients INT) ENGINE=InnoDB;
create TABLE c_responsable_interlocuteur(id_c_responsable_interlocuteur INT AUTO_INCREMENT PRIMARY KEY , type_responsable_interlocuteur VARCHAR(255)) ENGINE=InnoDB;
create TABLE client_modalite_payement_avance(id_client_modalite_payement_avance INT AUTO_INCREMENT PRIMARY KEY, pourcentage INT , etalonage INT , semaine BOOLEAN , mois BOOLEAN , nombre_mois_ou_semaine INT , clients INT) ENGINE=InnoDB;
create TABLE client_modalite_payement_sans_avance(id_client_modalite_payement_sans_avance INT AUTO_INCREMENT PRIMARY KEY, Totalite BOOLEAN , etalonage INT  , semaine BOOLEAN , mois BOOLEAN , nombre_mois_ou_semaine INT, clients INT) ENGINE=InnoDB;
create TABLE client_secteur(id_secteur INT AUTO_INCREMENT PRIMARY KEY,  Secteur VARCHAR(255)) ENGINE=InnoDB;




create TABLE client_devis(id_client_devis INT AUTO_INCREMENT PRIMARY KEY  , le_devis DATE  , a_devis VARCHAR(255) , objet VARCHAR(400) , date_d_entree DATETIME   , du_date DATE , a_tel_date DATE) ENGINE=InnoDB;

create TABLE client_ligne_devis(id_client_ligne_devis INT AUTO_INCREMENT PRIMARY KEY, prestation TEXT , unite FLOAT , nbr_jour FLOAT ,  pu_ht FLOAT , pt_ht FLOAT , client_ligne_devis_type_prestation INT , client_devis INT) ENGINE=InnoDB;

create TABLE client_ligne_devis_type_prestation(id_client_ligne_devis_type_prestation INT AUTO_INCREMENT PRIMARY KEY, ligne_devis_type_prestation VARCHAR(255)) ENGINE=InnoDB;

create TABLE client_devis_client(id_client_devis INT , id_client INT ,  utilisateurs INT , version_devis FLOAT , Numero_devis VARCHAR(255) ,  PRIMARY KEY(id_client_devis , id_client)) ENGINE=InnoDB;







create table devis_paiements(id_devis_paiements INT AUTO_INCREMENT PRIMARY KEY , client_devis_client  INT , devis_mode_paiements INT , Montant DOUBLE , avec_exoneration BOOLEAN);

create table devis_mode_paiements(id_devis_mode_paiements INT AUTO_INCREMENT PRIMARY KEY , devis_paiements  INT , libeller VARCHAR(255));

ALTER TABLE devis_paiements ADD FOREIGN KEY (devis_mode_paiements) REFERENCES devis_mode_paiements(id_devis_mode_paiements);
ALTER TABLE devis_paiements ADD FOREIGN KEY (client_devis_client) REFERENCES client_devis_client(id_client_devis);


INSERT INTO `devis_mode_paiements`(`libeller`) VALUES ('Espèces');
INSERT INTO `devis_mode_paiements`(`libeller`) VALUES ('Chèque');
INSERT INTO `devis_mode_paiements`(`libeller`) VALUES ('Virement');
INSERT INTO `devis_mode_paiements`(`libeller`) VALUES ('Prise en charge');






-- ********************relation_table**********************************
ALTER TABLE utilisateurs ADD FOREIGN KEY (profils) REFERENCES profils(id_profil);
ALTER TABLE clients ADD FOREIGN KEY (utilisateurs) REFERENCES utilisateurs(id_user);
ALTER TABLE clients ADD FOREIGN KEY (client_type) REFERENCES client_type(id_client_type);
ALTER TABLE client_responsable_interlocuteur ADD FOREIGN KEY (clients) REFERENCES clients(id_client);
ALTER TABLE client_responsable_interlocuteur ADD FOREIGN KEY (c_responsable_interlocuteur) REFERENCES c_responsable_interlocuteur(id_c_responsable_interlocuteur);
ALTER TABLE client_modalite_payement_avance ADD FOREIGN KEY (clients) REFERENCES clients(id_client);
ALTER TABLE client_modalite_payement_sans_avance ADD FOREIGN KEY (clients) REFERENCES clients(id_client);
ALTER TABLE clients ADD FOREIGN KEY (client_secteur) REFERENCES client_secteur(id_secteur);



ALTER TABLE client_devis_client ADD FOREIGN KEY (id_client_devis) REFERENCES client_devis(id_client_devis);
ALTER TABLE client_devis_client ADD FOREIGN KEY (id_client) REFERENCES clients(id_client);
ALTER TABLE client_devis_client ADD FOREIGN KEY (utilisateurs) REFERENCES utilisateurs(id_user);


ALTER TABLE client_ligne_devis ADD FOREIGN KEY (client_ligne_devis_type_prestation) REFERENCES client_ligne_devis_type_prestation(id_client_ligne_devis_type_prestation);
ALTER TABLE client_ligne_devis ADD FOREIGN KEY (client_devis) REFERENCES client_devis(id_client_devis);




-- ********************relation_table**********************************

-- ********************insert_table**********************************
INSERT INTO profils (nom_profil)VALUES ('Administrateur systeme');
INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, nom, prenom, email, profils) VALUES ('ECH-CHARFI@1993', '@123', 'ECH-CHARFI', 'Mouad', 'lamixiacom@gmail.com', 1);
INSERT INTO client_type (client_type) VALUES ('Personne Morale');
INSERT INTO client_type (client_type) VALUES ('Personne Physique');
INSERT INTO c_responsable_interlocuteur (type_responsable_interlocuteur) VALUES ('Responsable');
INSERT INTO c_responsable_interlocuteur (type_responsable_interlocuteur) VALUES ('Interlocuteur');
INSERT INTO client_secteur (Secteur) VALUES ('Privée');
INSERT INTO client_secteur (Secteur) VALUES ('Semi-Public');
INSERT INTO client_secteur (Secteur) VALUES ('Public');

INSERT INTO client_ligne_devis_type_prestation(ligne_devis_type_prestation) VALUES ('SALLES & ESPACES');
INSERT INTO client_ligne_devis_type_prestation(ligne_devis_type_prestation) VALUES ('TECHNICIENS & RÉGISSEURS');


-- ********************insert_table**********************************

select * FROM utilisateurs;

SELECT * FROM utilisateurs WHERE nom_utilisateur = 'ECH-CHARFI@1993' AND mot_de_passe = '@123'

SELECT us.* , pr.* FROM utilisateurs us JOIN profils pr on pr.id_profil = us.profils;// $_SESSION['id_user'] = $user['id_user'];
--  $_SESSION['nom_utilisateur'] = $user['nom_utilisateur'];
--  $_SESSION['nom'] = $user['nom'];
--  $_SESSION['prenom'] = $user['prenom'];
-- $_SESSION['profil'] = $user['profil'];



-----a faire

create TABLE societes(id_societe INT AUTO_INCREMENT PRIMARY KEY, societe_name VARCHAR(255)) ENGINE=InnoDB;

ALTER TABLE product ADD COLUMN id_societe INT;

ALTER TABLE product ADD FOREIGN KEY (id_societe) REFERENCES societes(id_societe); 


INSERT INTO societes(societe_name) VALUES ('Dar nzaha');
INSERT INTO societes(societe_name) VALUES ('Palais des congrès');
INSERT INTO societes(societe_name) VALUES ('Dar lakbira');




create TABLE annulation_cause(id_annulation_cause INT AUTO_INCREMENT PRIMARY KEY, libeller VARCHAR(255)) ENGINE=InnoDB;

INSERT INTO annulation_cause(libeller) VALUES ('Report');
INSERT INTO annulation_cause(libeller) VALUES ('Changement de ville');
INSERT INTO annulation_cause(libeller) VALUES ('Changement de cite');
INSERT INTO annulation_cause(libeller) VALUES ('Prix élevé');
INSERT INTO annulation_cause(libeller) VALUES ('Autre');


ALTER TABLE client_devis_client ADD COLUMN id_annulation_cause INT;
ALTER TABLE client_devis_client ADD COLUMN anuulation_cause VARCHAR(700);



ALTER TABLE client_devis_client ADD FOREIGN KEY (id_annulation_cause) REFERENCES annulation_cause(id_annulation_cause); 


/////////////////////--------------------------------------------


ALTER TABLE societes ADD COLUMN path_image VARCHAR(700);


ALTER TABLE societes ADD COLUMN all_name VARCHAR(700);

INSERT INTO `societes` (`id_societe`, `societe_name`, `path_image`, `all_name`) VALUES
(1, 'Dar n’zaha', 'entreprise_logo/dar_nzaha.png', 'Dar n’zaha'),
(2, 'Palais des congrès', 'entreprise_logo/palais_de_congres.png', 'Palais des Congres Rabat Bouregreg'),
(3, 'Dar lakbira', 'entreprise_logo/dar_lakbira.png', 'Dar lakbira');


ALTER TABLE clients ADD COLUMN id_societe INT;


ALTER TABLE clients ADD FOREIGN KEY (id_societe) REFERENCES societes(id_societe); 


create TABLE utilisateur_societes(id_societe INT , id_user INT , PRIMARY KEY(id_societe , id_user)) ENGINE=InnoDB;


ALTER TABLE utilisateur_societes ADD FOREIGN KEY (id_societe) REFERENCES societes(id_societe); 

ALTER TABLE utilisateur_societes ADD FOREIGN KEY (id_user) REFERENCES utilisateurs(id_user); 


UPDATE clients SET id_societe = 2;


