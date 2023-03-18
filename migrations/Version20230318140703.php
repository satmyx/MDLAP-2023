<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230318140703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A9DD7CE0');
        $this->addSql('ALTER TABLE inscription ADD typenuites_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D64AE21E7C FOREIGN KEY (typenuites_id) REFERENCES nuites (id)');
        //$this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A9DD7CE0 FOREIGN KEY (nuites_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D64AE21E7C ON inscription (typenuites_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D64AE21E7C');
        //$this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A9DD7CE0');
        $this->addSql('DROP INDEX IDX_5E90F6D64AE21E7C ON inscription');
        $this->addSql('ALTER TABLE inscription DROP typenuites_id');
        //$this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A9DD7CE0 FOREIGN KEY (nuites_id) REFERENCES hotel (id)');
    }
}
