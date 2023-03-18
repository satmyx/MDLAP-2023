<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230318142426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, vacation_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, nb_places INT NOT NULL, INDEX IDX_E1BB182359027487 (theme_id), INDEX IDX_E1BB182354DD8D72 (vacation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation (id INT AUTO_INCREMENT NOT NULL, date_heure_debut DATETIME NOT NULL, date_heure_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182359027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182354DD8D72 FOREIGN KEY (vacation_id) REFERENCES vacation (id)');
        $this->addSql('ALTER TABLE inscription ADD nuites_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A9DD7CE0 FOREIGN KEY (nuites_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6A9DD7CE0 ON inscription (nuites_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182359027487');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182354DD8D72');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE vacation');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A9DD7CE0');
        $this->addSql('DROP INDEX IDX_5E90F6D6A9DD7CE0 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP nuites_id');
    }
}
