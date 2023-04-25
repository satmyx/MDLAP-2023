<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403103913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nuites (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, date_nuites DATETIME NOT NULL, INDEX IDX_765E6757BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nuites ADD CONSTRAINT FK_765E6757BCF5E72D FOREIGN KEY (categorie_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE inscription_restauration DROP FOREIGN KEY FK_FAFBDB85DAC5993');
        $this->addSql('ALTER TABLE inscription_restauration DROP FOREIGN KEY FK_FAFBDB87C6CB929');
        $this->addSql('ALTER TABLE inscription_atelier DROP FOREIGN KEY FK_C86AEECF5DAC5993');
        $this->addSql('ALTER TABLE inscription_atelier DROP FOREIGN KEY FK_C86AEECF82E2CF35');
        $this->addSql('DROP TABLE inscription_restauration');
        $this->addSql('DROP TABLE inscription_atelier');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB1823476556AF');
        $this->addSql('DROP INDEX IDX_E1BB1823476556AF ON atelier');
        $this->addSql('ALTER TABLE atelier CHANGE thematique_id theme_id INT DEFAULT NULL, CHANGE nbplaces nb_places INT NOT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182359027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_E1BB182359027487 ON atelier (theme_id)');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFD90EC3ED');
        $this->addSql('DROP INDEX IDX_C509E4FFD90EC3ED ON chambre');
        $this->addSql('ALTER TABLE chambre CHANGE apartenir_id hotel_id INT DEFAULT NULL, CHANGE tarifs_nuites tarif_nuites NUMERIC(5, 2) NOT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF3243BB18 ON chambre (hotel_id)');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6838DE57B');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6B56DCD74');
        $this->addSql('DROP INDEX UNIQ_5E90F6D6B56DCD74 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D6838DE57B ON inscription');
        $this->addSql('ALTER TABLE inscription ADD restaurer_id INT DEFAULT NULL, ADD nuites_id INT DEFAULT NULL, ADD typenuites_id INT DEFAULT NULL, DROP licencie_id, DROP loger_id, CHANGE date_inscription date_inscrit DATETIME NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6CF093057 FOREIGN KEY (restaurer_id) REFERENCES restauration (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A9DD7CE0 FOREIGN KEY (nuites_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D64AE21E7C FOREIGN KEY (typenuites_id) REFERENCES nuites (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6CF093057 ON inscription (restaurer_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6A9DD7CE0 ON inscription (nuites_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D64AE21E7C ON inscription (typenuites_id)');
        $this->addSql('ALTER TABLE user ADD inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6495DAC5993 ON user (inscription_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D64AE21E7C');
        $this->addSql('CREATE TABLE inscription_restauration (inscription_id INT NOT NULL, restauration_id INT NOT NULL, INDEX IDX_FAFBDB85DAC5993 (inscription_id), INDEX IDX_FAFBDB87C6CB929 (restauration_id), PRIMARY KEY(inscription_id, restauration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE inscription_atelier (inscription_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_C86AEECF5DAC5993 (inscription_id), INDEX IDX_C86AEECF82E2CF35 (atelier_id), PRIMARY KEY(inscription_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inscription_restauration ADD CONSTRAINT FK_FAFBDB85DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_restauration ADD CONSTRAINT FK_FAFBDB87C6CB929 FOREIGN KEY (restauration_id) REFERENCES restauration (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_atelier ADD CONSTRAINT FK_C86AEECF5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_atelier ADD CONSTRAINT FK_C86AEECF82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nuites DROP FOREIGN KEY FK_765E6757BCF5E72D');
        $this->addSql('DROP TABLE nuites');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182359027487');
        $this->addSql('DROP INDEX IDX_E1BB182359027487 ON atelier');
        $this->addSql('ALTER TABLE atelier CHANGE theme_id thematique_id INT DEFAULT NULL, CHANGE nb_places nbplaces INT NOT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB1823476556AF FOREIGN KEY (thematique_id) REFERENCES theme (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E1BB1823476556AF ON atelier (thematique_id)');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6CF093057');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A9DD7CE0');
        $this->addSql('DROP INDEX IDX_5E90F6D6CF093057 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D6A9DD7CE0 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D64AE21E7C ON inscription');
        $this->addSql('ALTER TABLE inscription ADD licencie_id INT DEFAULT NULL, ADD loger_id INT DEFAULT NULL, DROP restaurer_id, DROP nuites_id, DROP typenuites_id, CHANGE date_inscrit date_inscription DATETIME NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6838DE57B FOREIGN KEY (loger_id) REFERENCES chambre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6B56DCD74 FOREIGN KEY (licencie_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D6B56DCD74 ON inscription (licencie_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6838DE57B ON inscription (loger_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495DAC5993');
        $this->addSql('DROP INDEX IDX_8D93D6495DAC5993 ON user');
        $this->addSql('ALTER TABLE user DROP inscription_id');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF3243BB18');
        $this->addSql('DROP INDEX IDX_C509E4FF3243BB18 ON chambre');
        $this->addSql('ALTER TABLE chambre CHANGE hotel_id apartenir_id INT DEFAULT NULL, CHANGE tarif_nuites tarifs_nuites NUMERIC(5, 2) NOT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFD90EC3ED FOREIGN KEY (apartenir_id) REFERENCES hotel (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C509E4FFD90EC3ED ON chambre (apartenir_id)');
    }
}
