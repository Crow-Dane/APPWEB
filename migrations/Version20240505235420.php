<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240505235420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ancien_etudiant (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, contrat_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, tel VARCHAR(50) NOT NULL, annee_sortie DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', poste_occuper VARCHAR(255) NOT NULL, INDEX IDX_3A88DAD8A76ED395 (user_id), INDEX IDX_3A88DAD81823061F (contrat_id), INDEX IDX_3A88DAD8F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancien_etudiant_filiere (ancien_etudiant_id INT NOT NULL, filiere_id INT NOT NULL, INDEX IDX_99A1BBD37D6F8705 (ancien_etudiant_id), INDEX IDX_99A1BBD3180AA129 (filiere_id), PRIMARY KEY(ancien_etudiant_id, filiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancien_etudiant_diplome (ancien_etudiant_id INT NOT NULL, diplome_id INT NOT NULL, INDEX IDX_5C3DAB037D6F8705 (ancien_etudiant_id), INDEX IDX_5C3DAB0326F859E2 (diplome_id), PRIMARY KEY(ancien_etudiant_id, diplome_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancien_etudiant_statistique (ancien_etudiant_id INT NOT NULL, statistique_id INT NOT NULL, INDEX IDX_D4907AC77D6F8705 (ancien_etudiant_id), INDEX IDX_D4907AC776A81463 (statistique_id), PRIMARY KEY(ancien_etudiant_id, statistique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, type_contrat VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere_statut_travail (filiere_id INT NOT NULL, statut_travail_id INT NOT NULL, INDEX IDX_FC6EBBF180AA129 (filiere_id), INDEX IDX_FC6EBBF9B3573A0 (statut_travail_id), PRIMARY KEY(filiere_id, statut_travail_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique (id INT AUTO_INCREMENT NOT NULL, nombre_etudiant_chomage INT NOT NULL, nombre_etudiant_employe INT NOT NULL, nombre_etudiant_licence INT NOT NULL, nombre_etudiant_dut INT NOT NULL, nombre_etudiant_entrepreneur INT NOT NULL, nombre_etudiant_fonctionneur INT NOT NULL, pourcentage_etudiant_chomage DOUBLE PRECISION NOT NULL, pourcentage_etudiant_employe DOUBLE PRECISION NOT NULL, pourcentage_etudiant_auto_entrepreneur DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_travail (id INT AUTO_INCREMENT NOT NULL, type_statut VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ancien_etudiant ADD CONSTRAINT FK_3A88DAD8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ancien_etudiant ADD CONSTRAINT FK_3A88DAD81823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id)');
        $this->addSql('ALTER TABLE ancien_etudiant ADD CONSTRAINT FK_3A88DAD8F6203804 FOREIGN KEY (statut_id) REFERENCES statut_travail (id)');
        $this->addSql('ALTER TABLE ancien_etudiant_filiere ADD CONSTRAINT FK_99A1BBD37D6F8705 FOREIGN KEY (ancien_etudiant_id) REFERENCES ancien_etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancien_etudiant_filiere ADD CONSTRAINT FK_99A1BBD3180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancien_etudiant_diplome ADD CONSTRAINT FK_5C3DAB037D6F8705 FOREIGN KEY (ancien_etudiant_id) REFERENCES ancien_etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancien_etudiant_diplome ADD CONSTRAINT FK_5C3DAB0326F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancien_etudiant_statistique ADD CONSTRAINT FK_D4907AC77D6F8705 FOREIGN KEY (ancien_etudiant_id) REFERENCES ancien_etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancien_etudiant_statistique ADD CONSTRAINT FK_D4907AC776A81463 FOREIGN KEY (statistique_id) REFERENCES statistique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere_statut_travail ADD CONSTRAINT FK_FC6EBBF180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere_statut_travail ADD CONSTRAINT FK_FC6EBBF9B3573A0 FOREIGN KEY (statut_travail_id) REFERENCES statut_travail (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ancien_etudiant DROP FOREIGN KEY FK_3A88DAD8A76ED395');
        $this->addSql('ALTER TABLE ancien_etudiant DROP FOREIGN KEY FK_3A88DAD81823061F');
        $this->addSql('ALTER TABLE ancien_etudiant DROP FOREIGN KEY FK_3A88DAD8F6203804');
        $this->addSql('ALTER TABLE ancien_etudiant_filiere DROP FOREIGN KEY FK_99A1BBD37D6F8705');
        $this->addSql('ALTER TABLE ancien_etudiant_filiere DROP FOREIGN KEY FK_99A1BBD3180AA129');
        $this->addSql('ALTER TABLE ancien_etudiant_diplome DROP FOREIGN KEY FK_5C3DAB037D6F8705');
        $this->addSql('ALTER TABLE ancien_etudiant_diplome DROP FOREIGN KEY FK_5C3DAB0326F859E2');
        $this->addSql('ALTER TABLE ancien_etudiant_statistique DROP FOREIGN KEY FK_D4907AC77D6F8705');
        $this->addSql('ALTER TABLE ancien_etudiant_statistique DROP FOREIGN KEY FK_D4907AC776A81463');
        $this->addSql('ALTER TABLE filiere_statut_travail DROP FOREIGN KEY FK_FC6EBBF180AA129');
        $this->addSql('ALTER TABLE filiere_statut_travail DROP FOREIGN KEY FK_FC6EBBF9B3573A0');
        $this->addSql('DROP TABLE ancien_etudiant');
        $this->addSql('DROP TABLE ancien_etudiant_filiere');
        $this->addSql('DROP TABLE ancien_etudiant_diplome');
        $this->addSql('DROP TABLE ancien_etudiant_statistique');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE filiere_statut_travail');
        $this->addSql('DROP TABLE statistique');
        $this->addSql('DROP TABLE statut_travail');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
