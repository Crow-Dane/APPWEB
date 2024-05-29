<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506012350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diplome_statut_travail (diplome_id INT NOT NULL, statut_travail_id INT NOT NULL, INDEX IDX_EFBA566C26F859E2 (diplome_id), INDEX IDX_EFBA566C9B3573A0 (statut_travail_id), PRIMARY KEY(diplome_id, statut_travail_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diplome_statut_travail ADD CONSTRAINT FK_EFBA566C26F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE diplome_statut_travail ADD CONSTRAINT FK_EFBA566C9B3573A0 FOREIGN KEY (statut_travail_id) REFERENCES statut_travail (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diplome_statut_travail DROP FOREIGN KEY FK_EFBA566C26F859E2');
        $this->addSql('ALTER TABLE diplome_statut_travail DROP FOREIGN KEY FK_EFBA566C9B3573A0');
        $this->addSql('DROP TABLE diplome_statut_travail');
    }
}
