<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329124428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE specialite_entreprise (specialite_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_EA0D81742195E0F0 (specialite_id), INDEX IDX_EA0D8174A4AEAFEA (entreprise_id), PRIMARY KEY(specialite_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE specialite_entreprise ADD CONSTRAINT FK_EA0D81742195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_entreprise ADD CONSTRAINT FK_EA0D8174A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne ADD entreprise_id INT NOT NULL, CHANGE per_nom per_nom VARCHAR(40) NOT NULL, CHANGE per_tel per_tel VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_FCEC9EFA4AEAFEA ON personne (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE specialite_entreprise');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFA4AEAFEA');
        $this->addSql('DROP INDEX IDX_FCEC9EFA4AEAFEA ON personne');
        $this->addSql('ALTER TABLE personne DROP entreprise_id, CHANGE per_nom per_nom VARCHAR(40) DEFAULT NULL, CHANGE per_tel per_tel VARCHAR(40) DEFAULT NULL');
    }
}
