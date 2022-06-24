<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220624125148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP adresse, DROP telephone');
        $this->addSql('ALTER TABLE livreur DROP telephone, DROP etat');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(20) NOT NULL, ADD prenom VARCHAR(20) NOT NULL, ADD adresse VARCHAR(40) NOT NULL, ADD telephone VARCHAR(20) NOT NULL, ADD is_etat TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD adresse VARCHAR(20) NOT NULL, ADD telephone INT NOT NULL');
        $this->addSql('ALTER TABLE livreur ADD telephone INT NOT NULL, ADD etat VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE `user` DROP nom, DROP prenom, DROP adresse, DROP telephone, DROP is_etat');
    }
}
