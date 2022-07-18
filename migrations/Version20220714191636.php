<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714191636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP commande_burger_id, DROP commande_portion_frite_id, DROP commande_taille_boisson_id, DROP commande_menu_id, CHANGE montant montant INT ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD commande_burger_id INT DEFAULT NULL, ADD commande_portion_frite_id INT DEFAULT NULL, ADD commande_taille_boisson_id INT DEFAULT NULL, ADD commande_menu_id INT DEFAULT NULL, CHANGE montant montant INT DEFAULT NULL');
    }
}