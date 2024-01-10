<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116091350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_event ADD evennement_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire_event ADD CONSTRAINT FK_BE22C2BBDCDFA082 FOREIGN KEY (evennement_id) REFERENCES evennement (id)');
        $this->addSql('CREATE INDEX IDX_BE22C2BBDCDFA082 ON commentaire_event (evennement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_event DROP FOREIGN KEY FK_BE22C2BBDCDFA082');
        $this->addSql('DROP INDEX IDX_BE22C2BBDCDFA082 ON commentaire_event');
        $this->addSql('ALTER TABLE commentaire_event DROP evennement_id');
    }
}
