<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230422134809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498E2AD382');
        $this->addSql('DROP INDEX UNIQ_8D93D6498E2AD382 ON user');
        $this->addSql('ALTER TABLE user DROP inscriptions_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD inscriptions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498E2AD382 FOREIGN KEY (inscriptions_id) REFERENCES inscription (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6498E2AD382 ON user (inscriptions_id)');
    }
}
