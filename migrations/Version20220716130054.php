<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220716130054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande CHANGE numero numero VARCHAR(20) DEFAULT NULL, CHANGE montant montant INT ');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A933A6C9BB2');
        $this->addSql('DROP INDEX IDX_7D053A933A6C9BB2 ON menu');
        $this->addSql('ALTER TABLE menu DROP commande_menu_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande CHANGE numero numero VARCHAR(20) NOT NULL, CHANGE montant montant INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD commande_menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A933A6C9BB2 FOREIGN KEY (commande_menu_id) REFERENCES commande_menu (id)');
        $this->addSql('CREATE INDEX IDX_7D053A933A6C9BB2 ON menu (commande_menu_id)');
    }
}