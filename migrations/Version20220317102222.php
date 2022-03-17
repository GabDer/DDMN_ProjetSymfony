<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220317102222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specialite ADD spe_libelle VARCHAR(40) NOT NULL');
        $this->addSql('DROP INDEX specialite_id ON specialite_entreprise');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise CHANGE ent_raison_sociale ent_raison_sociale VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_pays ent_pays VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_ville ent_ville VARCHAR(38) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_cp ent_cp VARCHAR(5) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_rue ent_rue VARCHAR(200) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_complement_adresse ent_complement_adresse LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_num1 ent_num1 VARCHAR(20) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_num2 ent_num2 VARCHAR(20) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ent_site_web ent_site_web VARCHAR(200) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE specialite DROP spe_libelle');
        $this->addSql('CREATE INDEX specialite_id ON specialite_entreprise (specialite_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE uti_login uti_login VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE uti_mdp uti_mdp VARCHAR(38) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
