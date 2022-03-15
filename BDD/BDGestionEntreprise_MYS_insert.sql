# ---------------------------------------------------
# 			Insertion des utilisateurs
# ---------------------------------------------------
INSERT INTO utilisateur (UTI_MDP, UTI_LOGIN, UTI_ROLE)
VALUES ('M0t_2_P@ss€', 'ADMIN1', 'Administrateur');

INSERT INTO utilisateur (UTI_MDP, UTI_LOGIN, UTI_ROLE)
VALUES ('Ch@t0s76240', 'BARANGER', 'Enseignant');


# ------------------------------------------------------------------------------------------------------
#										Insertion des entreprises
# ------------------------------------------------------------------------------------------------------
INSERT INTO entreprise (ENT_RS, ENT_PAYS, ENT_VILLE, ENT_CP, ENT_RUE, ENT_COMPLEMENTADRESSE, ENT_SITEWEB)
VALUES ('ABC INFORMATIQUE', 'France', 'Friville', 80130, 'Allée des marettes', 'Zac Le Parc', 
		'https://www.abcinformatique.fr/nos-magasins/materiel-informatique-depannage-friville/');

INSERT INTO entreprise (ENT_RS, ENT_PAYS, ENT_VILLE, ENT_CP, ENT_RUE, ENT_SITEWEB)
VALUES ('Agence Digiworks', 'France', 'Mont-Saint-Aignan', 76130, '85 Chemin de Clères', 'https://www.digiworks.fr/');

INSERT INTO entreprise (ENT_RS, ENT_PAYS, ENT_VILLE, ENT_CP, ENT_RUE)
VALUES ('AGEVOL Développement', 'France', 'Bihorel', 76420, '10 rue Maréchal de Lattre de Tassigny');

INSERT INTO entreprise (ENT_RS, ENT_PAYS, ENT_VILLE, ENT_CP, ENT_RUE, ENT_COMPLEMENTADRESSE, ENT_SITEWEB)
VALUES ('Centre Henri-Becquerel', 'France', 'Rouen Cedex 1', 76038, 'Rue d''Amiens', 'CS11516','www.centre-henri-becquerel.fr');


# ---------------------------------------------------------
# 				Insertion des personnes 
# ---------------------------------------------------------
INSERT INTO personne (ENT_ID, PER_NOM, PER_PRENOM, PER_MAIL)
VALUES (1, 'CARBONNIER', 'Alexandre', 'alex@abcinformatique.fr');

INSERT INTO personne (ENT_ID, PER_PRENOM, PER_MAIL)
VALUES (1, 'Sébastien', 'sebastien@abcinformatique.fr');
		
INSERT INTO personne (ENT_ID, PER_NOM, PER_PRENOM, PER_MAIL)
VALUES (2, 'Seité', 'Alexandre', 'aseite@digiworks.fr');

INSERT INTO personne (ENT_ID, PER_NOM, PER_PRENOM, PER_TEL, PER_MAIL)
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
VALUES ('1SIOSLAM');

INSERT INTO specialite (SPE_LIBELLE)
VALUES ('1SIOSISR');

INSERT INTO specialite (SPE_LIBELLE)
VALUES ('2SIOSLAM');

INSERT INTO specialite (SPE_LIBELLE)
VALUES ('2SIOSISR');

INSERT INTO specialite (SPE_LIBELLE)
VALUES ('Licences');

INSERT INTO specialite (SPE_LIBELLE)
VALUES ('Alternances');


# -------------------------------------
# 		Insertion des représentation
# -------------------------------------
INSERT INTO representer (FON_ID, PER_ID)
VALUES (1, 3);

INSERT INTO representer (FON_ID, PER_ID)
VALUES (3, 4);


# --------------------------------
# 		Insertion de avoir
# --------------------------------
INSERT INTO avoir (ENT_ID, SPE_ID)
VALUES (4, 1);

INSERT INTO avoir (ENT_ID, SPE_ID)
VALUES (4, 2);

INSERT INTO avoir (ENT_ID, SPE_ID)
VALUES (4, 3);

INSERT INTO avoir (ENT_ID, SPE_ID)
VALUES (4, 4);

