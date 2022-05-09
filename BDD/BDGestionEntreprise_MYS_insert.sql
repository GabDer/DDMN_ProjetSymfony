# ---------------------------------------------------
# 			Insertion des utilisateurs
# ---------------------------------------------------
INSERT INTO utilisateur (UTI_MDP, UTI_LOGIN, UTI_ROLE)
VALUES ('7cf2db5ec261a0fa27a502d3196a6f60', 'ADMIN', '1');

INSERT INTO utilisateur (UTI_MDP, UTI_LOGIN, UTI_ROLE)
VALUES ('7cf2db5ec261a0fa27a502d3196a6f60', 'Enseignant', '0');


# ------------------------------------------------------------------------------------------------------
#										Insertion des entreprises
# ------------------------------------------------------------------------------------------------------
INSERT INTO entreprise (ENT_Raison_Sociale, ENT_PAYS, ENT_VILLE, ENT_CP, ENT_RUE, ENT_COMPLEMENT_ADRESSE, ENT_SITE_WEB)
VALUES ('ABC INFORMATIQUE', 'France', 'Friville', 80130, 'Allée des marettes', 'Zac Le Parc', 
		'https://www.abcinformatique.fr/nos-magasins/materiel-informatique-depannage-friville/');

INSERT INTO entreprise (ENT_Raison_Sociale, ENT_PAYS, ENT_VILLE, ENT_CP, ENT_RUE, ENT_SITE_WEB)
VALUES ('Agence Digiworks', 'France', 'Mont-Saint-Aignan', 76130, '85 Chemin de Clères', 'https://www.digiworks.fr/');

INSERT INTO entreprise (ENT_Raison_Sociale, ENT_PAYS, ENT_VILLE, ENT_CP, ENT_RUE)
VALUES ('AGEVOL Développement', 'France', 'Bihorel', 76420, '10 rue Maréchal de Lattre de Tassigny');

INSERT INTO entreprise (ENT_Raison_Sociale, ENT_PAYS, ENT_VILLE, ENT_CP, ENT_RUE, ENT_COMPLEMENT_ADRESSE, ENT_SITE_WEB)
VALUES ('Centre Henri-Becquerel', 'France', 'Rouen Cedex 1', 76038, 'Rue d''Amiens', 'CS11516','www.centre-henri-becquerel.fr');


# ---------------------------------------------------------
# 				Insertion des personnes 
# ---------------------------------------------------------
INSERT INTO personne (entreprise_id, PER_NOM, PER_PRENOM, PER_MAIL)
VALUES (1, 'CARBONNIER', 'Alexandre', 'alex@abcinformatique.fr');

INSERT INTO personne (entreprise_id, PER_NOM, PER_PRENOM, PER_MAIL)
VALUES (1, 'Franck' ,'Sébastien', 'sebastien@abcinformatique.fr');
		
INSERT INTO personne (entreprise_id, PER_NOM, PER_PRENOM, PER_MAIL)
VALUES (2, 'Seité', 'Alexandre', 'aseite@digiworks.fr');

INSERT INTO personne (entreprise_id, PER_NOM, PER_PRENOM, PER_TEL, PER_MAIL)
VALUES (4, 'LE DENMAT', 'Jean-Marc', '02.32.08.22.09', 'jean-marc.le-denmat@chb.unicancer.fr');


# --------------------------------
# 		Insertion des fonctions
# --------------------------------	
INSERT INTO fonction (FON_LIBELLE)
VALUES ('Directeur de production');

INSERT INTO fonction (FON_LIBELLE)
VALUES ('RH'); 

INSERT INTO fonction (FON_LIBELLE)
VALUES ('DSI'); 

INSERT INTO fonction (FON_LIBELLE)
VALUES ('Développeur'); 


# ------------------------------
# 		Insertion des profils
# ------------------------------ 
INSERT INTO profil (PRO_LIBELLE)
VALUES ('Responsable');

INSERT INTO profil (PRO_LIBELLE)
VALUES ('Tuteur');

INSERT INTO profil (PRO_LIBELLE)
VALUES ('Jury'); 

INSERT INTO profil (PRO_LIBELLE)
VALUES ('Envoi de CV');


# ----------------------------------
# 		Insertion des spécialités
# ----------------------------------
INSERT INTO specialite (SPE_LIBELLE)
VALUES ('SLAM');

INSERT INTO specialite (SPE_LIBELLE)
VALUES ('SISR');

INSERT INTO specialite (SPE_LIBELLE)
VALUES ('Licences');


# -------------------------------------
# 		Insertion des Profils selon les personnes
# -------------------------------------
INSERT INTO personneprofil (PER_ID_ID, PRO_ID_ID, date)
VALUES (1, 3, '2021/08/30');

INSERT INTO personneprofil (PER_ID_ID, PRO_ID_ID, date)
VALUES (2, 4, '2021/05/07');

INSERT INTO personneprofil (PER_ID_ID, PRO_ID_ID, date)
VALUES (3, 2, '2021/09/27');

INSERT INTO personneprofil (PER_ID_ID, PRO_ID_ID, date)
VALUES (3, 4, '2021/06/02');

INSERT INTO personneprofil (PER_ID_ID, PRO_ID_ID, date)
VALUES (4, 1, '2022/01/13');

INSERT INTO personneprofil (PER_ID_ID, PRO_ID_ID, date)
VALUES (4, 3, '2021/04/18');


# --------------------------------
# 		Insertion des specialités selon les entreprises
# --------------------------------
INSERT INTO specialite_entreprise (entreprise_id, specialite_id)
VALUES (1, 1);

INSERT INTO specialite_entreprise (entreprise_id, specialite_id)
VALUES (1, 2);

INSERT INTO specialite_entreprise (entreprise_id, specialite_id)
VALUES (2, 1);

INSERT INTO specialite_entreprise (entreprise_id, specialite_id)
VALUES (3, 2);

INSERT INTO specialite_entreprise (entreprise_id, specialite_id)
VALUES (4, 1);

INSERT INTO specialite_entreprise (entreprise_id, specialite_id)
VALUES (4, 2);

INSERT INTO specialite_entreprise (entreprise_id, specialite_id)
VALUES (4, 3);


# --------------------------------
# 		Insertion des fonctions selon les personnes
# --------------------------------
INSERT INTO fonction_personne (Fonction_id, Personne_id)
VALUES (1, 3);

INSERT INTO fonction_personne (Fonction_id, Personne_id)
VALUES (1, 4);

INSERT INTO fonction_personne (Fonction_id, Personne_id)
VALUES (2, 3);

INSERT INTO fonction_personne (Fonction_id, Personne_id)
VALUES (3, 4);

INSERT INTO fonction_personne (Fonction_id, Personne_id)
VALUES (4, 1);

INSERT INTO fonction_personne (Fonction_id, Personne_id)
VALUES (4, 3);