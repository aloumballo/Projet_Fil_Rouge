<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712015608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE livraison_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE menu_burgers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE menu_portion_frites_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE menu_taille_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quartier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE taille_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE taille_boisson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE zone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE boisson (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE burger (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE commande (id INT NOT NULL, zone_id INT DEFAULT NULL, client_id INT DEFAULT NULL, gestionnaire_id INT DEFAULT NULL, livraison_id INT DEFAULT NULL, numero VARCHAR(20) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, montant INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6EEAA67D9F2C3FAB ON commande (zone_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D6885AC1B ON commande (gestionnaire_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('CREATE TABLE gestionnaire (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE livraison (id INT NOT NULL, livreur_id INT DEFAULT NULL, montant_total INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A60C9F1FF8646701 ON livraison (livreur_id)');
        $this->addSql('CREATE TABLE livreur (id INT NOT NULL, matricule_moto INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE menu (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE menu_burgers (id INT NOT NULL, menu_id INT DEFAULT NULL, burger_id INT DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ED8B4D52CCD7E912 ON menu_burgers (menu_id)');
        $this->addSql('CREATE INDEX IDX_ED8B4D5217CE5090 ON menu_burgers (burger_id)');
        $this->addSql('CREATE TABLE menu_portion_frites (id INT NOT NULL, menu_id INT DEFAULT NULL, portion_frite_id INT DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AA2CDC46CCD7E912 ON menu_portion_frites (menu_id)');
        $this->addSql('CREATE INDEX IDX_AA2CDC469B17FA7B ON menu_portion_frites (portion_frite_id)');
        $this->addSql('CREATE TABLE menu_taille (id INT NOT NULL, taille_id INT DEFAULT NULL, menu_id INT DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A517D3E0FF25611A ON menu_taille (taille_id)');
        $this->addSql('CREATE INDEX IDX_A517D3E0CCD7E912 ON menu_taille (menu_id)');
        $this->addSql('CREATE TABLE portion_frite (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE produit (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, nom VARCHAR(20) DEFAULT NULL, image VARCHAR(20) DEFAULT NULL, prix INT DEFAULT NULL, is_etat BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29A5EC276885AC1B ON produit (gestionnaire_id)');
        $this->addSql('CREATE TABLE produit_commande (id INT NOT NULL, commande_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_47F5946E82EA2E54 ON produit_commande (commande_id)');
        $this->addSql('CREATE INDEX IDX_47F5946EF347EFB ON produit_commande (produit_id)');
        $this->addSql('CREATE TABLE quartier (id INT NOT NULL, zone_id INT DEFAULT NULL, libelle VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEE8962D9F2C3FAB ON quartier (zone_id)');
        $this->addSql('CREATE TABLE taille (id INT NOT NULL, prix INT NOT NULL, libelle VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE taille_boisson (id INT NOT NULL, boisson_id INT DEFAULT NULL, taille_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_59FAC268734B8089 ON taille_boisson (boisson_id)');
        $this->addSql('CREATE INDEX IDX_59FAC268FF25611A ON taille_boisson (taille_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, adresse VARCHAR(40) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, is_etat BOOLEAN DEFAULT NULL, is_enable BOOLEAN DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, expire_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE zone (id INT NOT NULL, nom VARCHAR(20) NOT NULL, prix INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestionnaire ADD CONSTRAINT FK_F4461B20BF396750 FOREIGN KEY (id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FF8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DBF396750 FOREIGN KEY (id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93BF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_burgers ADD CONSTRAINT FK_ED8B4D52CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_burgers ADD CONSTRAINT FK_ED8B4D5217CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_portion_frites ADD CONSTRAINT FK_AA2CDC46CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_portion_frites ADD CONSTRAINT FK_AA2CDC469B17FA7B FOREIGN KEY (portion_frite_id) REFERENCES portion_frite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CADBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC276885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE taille_boisson DROP CONSTRAINT FK_59FAC268734B8089');
        $this->addSql('ALTER TABLE menu_burgers DROP CONSTRAINT FK_ED8B4D5217CE5090');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE produit_commande DROP CONSTRAINT FK_47F5946E82EA2E54');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D6885AC1B');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT FK_29A5EC276885AC1B');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE livraison DROP CONSTRAINT FK_A60C9F1FF8646701');
        $this->addSql('ALTER TABLE menu_burgers DROP CONSTRAINT FK_ED8B4D52CCD7E912');
        $this->addSql('ALTER TABLE menu_portion_frites DROP CONSTRAINT FK_AA2CDC46CCD7E912');
        $this->addSql('ALTER TABLE menu_taille DROP CONSTRAINT FK_A517D3E0CCD7E912');
        $this->addSql('ALTER TABLE menu_portion_frites DROP CONSTRAINT FK_AA2CDC469B17FA7B');
        $this->addSql('ALTER TABLE boisson DROP CONSTRAINT FK_8B97C84DBF396750');
        $this->addSql('ALTER TABLE burger DROP CONSTRAINT FK_EFE35A0DBF396750');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93BF396750');
        $this->addSql('ALTER TABLE portion_frite DROP CONSTRAINT FK_8F393CADBF396750');
        $this->addSql('ALTER TABLE produit_commande DROP CONSTRAINT FK_47F5946EF347EFB');
        $this->addSql('ALTER TABLE menu_taille DROP CONSTRAINT FK_A517D3E0FF25611A');
        $this->addSql('ALTER TABLE taille_boisson DROP CONSTRAINT FK_59FAC268FF25611A');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455BF396750');
        $this->addSql('ALTER TABLE gestionnaire DROP CONSTRAINT FK_F4461B20BF396750');
        $this->addSql('ALTER TABLE livreur DROP CONSTRAINT FK_EB7A4E6DBF396750');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D9F2C3FAB');
        $this->addSql('ALTER TABLE quartier DROP CONSTRAINT FK_FEE8962D9F2C3FAB');
        $this->addSql('DROP SEQUENCE commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE livraison_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE menu_burgers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE menu_portion_frites_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE menu_taille_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quartier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE taille_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE taille_boisson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE zone_id_seq CASCADE');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE burger');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE gestionnaire');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_burgers');
        $this->addSql('DROP TABLE menu_portion_frites');
        $this->addSql('DROP TABLE menu_taille');
        $this->addSql('DROP TABLE portion_frite');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE taille_boisson');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE zone');
    }
}
