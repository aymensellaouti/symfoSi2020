<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201027141821 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hobbie (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_hobbie (personne_id INT NOT NULL, hobbie_id INT NOT NULL, INDEX IDX_29E6911AA21BD112 (personne_id), INDEX IDX_29E6911A50B678B7 (hobbie_id), PRIMARY KEY(personne_id, hobbie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece_identite (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL, identifiant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne_hobbie ADD CONSTRAINT FK_29E6911AA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_hobbie ADD CONSTRAINT FK_29E6911A50B678B7 FOREIGN KEY (hobbie_id) REFERENCES hobbie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne ADD piece_identite_id INT DEFAULT NULL, ADD job_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF1B21CC5E FOREIGN KEY (piece_identite_id) REFERENCES piece_identite (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FCEC9EF1B21CC5E ON personne (piece_identite_id)');
        $this->addSql('CREATE INDEX IDX_FCEC9EFBE04EA9 ON personne (job_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne_hobbie DROP FOREIGN KEY FK_29E6911A50B678B7');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFBE04EA9');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF1B21CC5E');
        $this->addSql('DROP TABLE hobbie');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE personne_hobbie');
        $this->addSql('DROP TABLE piece_identite');
        $this->addSql('DROP INDEX UNIQ_FCEC9EF1B21CC5E ON personne');
        $this->addSql('DROP INDEX IDX_FCEC9EFBE04EA9 ON personne');
        $this->addSql('ALTER TABLE personne DROP piece_identite_id, DROP job_id');
    }
}
