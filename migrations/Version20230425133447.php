<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425133447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, vacation_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, nb_places INT NOT NULL, INDEX IDX_E1BB182354DD8D72 (vacation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, apartenir_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, tarifs_nuites NUMERIC(5, 2) NOT NULL, INDEX IDX_C509E4FFD90EC3ED (apartenir_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, cp VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, licencie_id INT DEFAULT NULL, loger_id INT DEFAULT NULL, etat_id INT NOT NULL, date_inscription DATETIME NOT NULL, UNIQUE INDEX UNIQ_5E90F6D6B56DCD74 (licencie_id), INDEX IDX_5E90F6D6838DE57B (loger_id), INDEX IDX_5E90F6D6D5E86FF (etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_atelier (inscription_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_C86AEECF5DAC5993 (inscription_id), INDEX IDX_C86AEECF82E2CF35 (atelier_id), PRIMARY KEY(inscription_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_restauration (inscription_id INT NOT NULL, restauration_id INT NOT NULL, INDEX IDX_FAFBDB85DAC5993 (inscription_id), INDEX IDX_FAFBDB87C6CB929 (restauration_id), PRIMARY KEY(inscription_id, restauration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nuites (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, date_nuites DATETIME NOT NULL, INDEX IDX_765E6757BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restauration (id INT AUTO_INCREMENT NOT NULL, date_restauration DATETIME NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, atelier_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_9775E70882E2CF35 (atelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, numlicence VARCHAR(255) NOT NULL, isVerified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D6495DB85673 (numlicence), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation (id INT AUTO_INCREMENT NOT NULL, date_heure_debut DATETIME NOT NULL, date_heure_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182354DD8D72 FOREIGN KEY (vacation_id) REFERENCES vacation (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFD90EC3ED FOREIGN KEY (apartenir_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6B56DCD74 FOREIGN KEY (licencie_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6838DE57B FOREIGN KEY (loger_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE inscription_atelier ADD CONSTRAINT FK_C86AEECF5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_atelier ADD CONSTRAINT FK_C86AEECF82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_restauration ADD CONSTRAINT FK_FAFBDB85DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_restauration ADD CONSTRAINT FK_FAFBDB87C6CB929 FOREIGN KEY (restauration_id) REFERENCES restauration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nuites ADD CONSTRAINT FK_765E6757BCF5E72D FOREIGN KEY (categorie_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E70882E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182354DD8D72');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFD90EC3ED');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6B56DCD74');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6838DE57B');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6D5E86FF');
        $this->addSql('ALTER TABLE inscription_atelier DROP FOREIGN KEY FK_C86AEECF5DAC5993');
        $this->addSql('ALTER TABLE inscription_atelier DROP FOREIGN KEY FK_C86AEECF82E2CF35');
        $this->addSql('ALTER TABLE inscription_restauration DROP FOREIGN KEY FK_FAFBDB85DAC5993');
        $this->addSql('ALTER TABLE inscription_restauration DROP FOREIGN KEY FK_FAFBDB87C6CB929');
        $this->addSql('ALTER TABLE nuites DROP FOREIGN KEY FK_765E6757BCF5E72D');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E70882E2CF35');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_atelier');
        $this->addSql('DROP TABLE inscription_restauration');
        $this->addSql('DROP TABLE nuites');
        $this->addSql('DROP TABLE restauration');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vacation');
    }
}
