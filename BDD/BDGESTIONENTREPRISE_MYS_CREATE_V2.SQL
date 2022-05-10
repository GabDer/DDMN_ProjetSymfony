DROP DATABASE IF EXISTS DDMN_BDGestionEntreprise;

CREATE DATABASE IF NOT EXISTS DDMN_BDGestionEntreprise;
USE DDMN_BDGestionEntreprise;
# -----------------------------------------------------------------------------
#       TABLE : FONCTION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FONCTION
 (
   FON_ID INTEGER NOT NULL AUTO_INCREMENT  ,
   FON_LIBELLE VARCHAR(40) NULL  
   , PRIMARY KEY (FON_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PERSONNE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PERSONNE
 (
   PER_ID INTEGER NOT NULL AUTO_INCREMENT  ,
   ENT_ID INTEGER NOT NULL  ,
   PER_NOM VARCHAR(40) NULL  ,
   PER_PRENOM VARCHAR(40) NULL  ,
   PER_TEL VARCHAR(20) NULL  ,
   PER_MAIL VARCHAR(50) NULL  
   , PRIMARY KEY (PER_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PERSONNE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PERSONNE_ENTREPRISE
     ON PERSONNE (ENT_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : UTILISATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS UTILISATEUR
 (
   UTI_ID INTEGER NOT NULL AUTO_INCREMENT ,
   UTI_MDP VARCHAR(128) NOT NULL  ,
   UTI_LOGIN VARCHAR(40) NOT NULL  ,
   UTI_ROLE BOOLEAN NOT NULL  
   , PRIMARY KEY (UTI_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : SPECIALITE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SPECIALITE
 (
   SPE_ID INTEGER NOT NULL AUTO_INCREMENT,
   SPE_LIBELLE VARCHAR(40) NULL  
   , PRIMARY KEY (SPE_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ENTREPRISE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ENTREPRISE
 (
   ENT_ID INTEGER NOT NULL AUTO_INCREMENT ,
   ENT_RS VARCHAR(40) NOT NULL  ,
   ENT_PAYS VARCHAR(40) NULL  ,
   ENT_VILLE VARCHAR(40) NULL  ,
   ENT_CP CHAR(5) NULL  ,
   ENT_RUE VARCHAR(40) NULL ,
   ENT_COMPLEMENTADRESSE CHAR(32) NULL,
   ENT_SITEWEB VARCHAR(128) NULL     
   , PRIMARY KEY (ENT_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PROFIL
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PROFIL
 (
   PRO_ID INTEGER NOT NULL AUTO_INCREMENT,
   PRO_LIBELLE VARCHAR(40) NULL  
   , PRIMARY KEY (PRO_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : APPARTENIR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS APPARTENIR
 (
   PRO_ID INTEGER NOT NULL  ,
   PER_ID INTEGER NOT NULL  ,
   APP_DATE DATE NULL  
   , PRIMARY KEY (PRO_ID,PER_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE APPARTENIR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_APPARTENIR_PROFIL
     ON APPARTENIR (PRO_ID ASC);

CREATE  INDEX I_FK_APPARTENIR_PERSONNE
     ON APPARTENIR (PER_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : AVOIR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AVOIR
 (
   SPE_ID INTEGER NOT NULL  ,
   ENT_ID INTEGER NOT NULL  
   , PRIMARY KEY (SPE_ID,ENT_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE AVOIR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_AVOIR_SPECIALITE
     ON AVOIR (SPE_ID ASC);

CREATE  INDEX I_FK_AVOIR_ENTREPRISE
     ON AVOIR (ENT_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : REPRESENTER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS REPRESENTER
 (
   FON_ID INTEGER NOT NULL  ,
   PER_ID INTEGER NOT NULL  
   , PRIMARY KEY (FON_ID,PER_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE REPRESENTER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_REPRESENTER_FONCTION
     ON REPRESENTER (FON_ID ASC);

CREATE  INDEX I_FK_REPRESENTER_PERSONNE
     ON REPRESENTER (PER_ID ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE PERSONNE 
  ADD FOREIGN KEY FK_PERSONNE_ENTREPRISE (ENT_ID)
      REFERENCES ENTREPRISE (ENT_ID) ;


ALTER TABLE APPARTENIR 
  ADD FOREIGN KEY FK_APPARTENIR_PROFIL (PRO_ID)
      REFERENCES PROFIL (PRO_ID) ;


ALTER TABLE APPARTENIR 
  ADD FOREIGN KEY FK_APPARTENIR_PERSONNE (PER_ID)
      REFERENCES PERSONNE (PER_ID) ;


ALTER TABLE AVOIR 
  ADD FOREIGN KEY FK_AVOIR_SPECIALITE (SPE_ID)
      REFERENCES SPECIALITE (SPE_ID) ;


ALTER TABLE AVOIR 
  ADD FOREIGN KEY FK_AVOIR_ENTREPRISE (ENT_ID)
      REFERENCES ENTREPRISE (ENT_ID) ;


ALTER TABLE REPRESENTER 
  ADD FOREIGN KEY FK_REPRESENTER_FONCTION (FON_ID)
      REFERENCES FONCTION (FON_ID) ;


ALTER TABLE REPRESENTER 
  ADD FOREIGN KEY FK_REPRESENTER_PERSONNE (PER_ID)
      REFERENCES PERSONNE (PER_ID) ;

