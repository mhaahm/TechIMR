<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906230900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE acts (id INT NOT NULL, societe_id INT DEFAULT NULL, type VARCHAR(54) NOT NULL, date_depot VARCHAR(255) NOT NULL, nature VARCHAR(255) NOT NULL, date_acte VARCHAR(255) NOT NULL, numero_depot_manuel INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A10A677FCF77503 ON acts (societe_id)');
        $this->addSql('CREATE TABLE grf (id INT NOT NULL, code_grf VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE societe (id INT NOT NULL, code_gfr_id INT NOT NULL, num_gestion VARCHAR(255) NOT NULL, date_donnees VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_19653DBD95F1303B ON societe (code_gfr_id)');
        $this->addSql('ALTER TABLE acts ADD CONSTRAINT FK_6A10A677FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBD95F1303B FOREIGN KEY (code_gfr_id) REFERENCES grf (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE societe DROP CONSTRAINT FK_19653DBD95F1303B');
        $this->addSql('ALTER TABLE acts DROP CONSTRAINT FK_6A10A677FCF77503');
        $this->addSql('DROP TABLE acts');
        $this->addSql('DROP TABLE grf');
        $this->addSql('DROP TABLE societe');
    }
}
