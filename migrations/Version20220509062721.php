<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509062721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, ent_raison_sociale VARCHAR(100) NOT NULL, ent_pays VARCHAR(38) DEFAULT NULL, ent_ville VARCHAR(38) DEFAULT NULL, ent_cp VARCHAR(5) DEFAULT NULL, ent_rue VARCHAR(200) DEFAULT NULL, ent_complement_adresse LONGTEXT DEFAULT NULL, ent_num1 VARCHAR(20) DEFAULT NULL, ent_num2 VARCHAR(20) DEFAULT NULL, ent_site_web VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, fon_libelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction_personne (fonction_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_F1D782F557889920 (fonction_id), INDEX IDX_F1D782F5A21BD112 (personne_id), PRIMARY KEY(fonction_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, per_nom VARCHAR(40) NOT NULL, per_prenom VARCHAR(40) DEFAULT NULL, per_tel VARCHAR(20) DEFAULT NULL, per_mail VARCHAR(50) DEFAULT NULL, INDEX IDX_FCEC9EFA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personneprofil (id INT AUTO_INCREMENT NOT NULL, per_id_id INT NOT NULL, pro_id_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_780F4F62B1E86BCE (per_id_id), INDEX IDX_780F4F62C19FAEF2 (pro_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, pro_libelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, spe_libelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite_entreprise (specialite_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_EA0D81742195E0F0 (specialite_id), INDEX IDX_EA0D8174A4AEAFEA (entreprise_id), PRIMARY KEY(specialite_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, uti_login VARCHAR(38) NOT NULL, uti_mdp VARCHAR(38) NOT NULL, uti_role TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fonction_personne ADD CONSTRAINT FK_F1D782F557889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fonction_personne ADD CONSTRAINT FK_F1D782F5A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE personneprofil ADD CONSTRAINT FK_780F4F62B1E86BCE FOREIGN KEY (per_id_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE personneprofil ADD CONSTRAINT FK_780F4F62C19FAEF2 FOREIGN KEY (pro_id_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE specialite_entreprise ADD CONSTRAINT FK_EA0D81742195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_entreprise ADD CONSTRAINT FK_EA0D8174A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFA4AEAFEA');
        $this->addSql('ALTER TABLE specialite_entreprise DROP FOREIGN KEY FK_EA0D8174A4AEAFEA');
        $this->addSql('ALTER TABLE fonction_personne DROP FOREIGN KEY FK_F1D782F557889920');
        $this->addSql('ALTER TABLE fonction_personne DROP FOREIGN KEY FK_F1D782F5A21BD112');
        $this->addSql('ALTER TABLE personneprofil DROP FOREIGN KEY FK_780F4F62B1E86BCE');
        $this->addSql('ALTER TABLE personneprofil DROP FOREIGN KEY FK_780F4F62C19FAEF2');
        $this->addSql('ALTER TABLE specialite_entreprise DROP FOREIGN KEY FK_EA0D81742195E0F0');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE fonction_personne');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personneprofil');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE specialite_entreprise');
        $this->addSql('DROP TABLE utilisateur');
    }
}
