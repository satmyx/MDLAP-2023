<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230421085749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182359027487');
        $this->addSql('DROP INDEX IDX_E1BB182359027487 ON atelier');
        $this->addSql('ALTER TABLE atelier DROP theme_id');
        $this->addSql('ALTER TABLE theme ADD atelier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E70882E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('CREATE INDEX IDX_9775E70882E2CF35 ON theme (atelier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier ADD theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182359027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E1BB182359027487 ON atelier (theme_id)');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E70882E2CF35');
        $this->addSql('DROP INDEX IDX_9775E70882E2CF35 ON theme');
        $this->addSql('ALTER TABLE theme DROP atelier_id');
    }
}
