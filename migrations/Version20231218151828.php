<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218151828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        // $this->addSql('CREATE INDEX IDX_67F068BC60BB6FE6 ON commentaire (auteur_id)');
        // $this->addSql('ALTER TABLE commentaire_event ADD CONSTRAINT FK_BE22C2BBDCDFA082 FOREIGN KEY (evennement_id) REFERENCES evennement (id)');
        // $this->addSql('CREATE INDEX IDX_BE22C2BBDCDFA082 ON commentaire_event (evennement_id)');
        $this->addSql('ALTER TABLE user ADD pseudo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC60BB6FE6');
        $this->addSql('DROP INDEX IDX_67F068BC60BB6FE6 ON commentaire');
        $this->addSql('ALTER TABLE commentaire_event DROP FOREIGN KEY FK_BE22C2BBDCDFA082');
        $this->addSql('DROP INDEX IDX_BE22C2BBDCDFA082 ON commentaire_event');
        $this->addSql('ALTER TABLE user DROP pseudo');
    }
}
