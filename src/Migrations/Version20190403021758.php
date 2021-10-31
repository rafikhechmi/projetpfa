<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403021758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) NOT NULL, pdw VARCHAR(20) NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, enseignant_id INT DEFAULT NULL, nom_cours VARCHAR(20) NOT NULL, INDEX IDX_FDCA8C9C642B8210 (admin_id), INDEX IDX_FDCA8C9CE455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cycle (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, nom_cycle VARCHAR(20) NOT NULL, INDEX IDX_B086D193642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emploi_enseignant (id INT AUTO_INCREMENT NOT NULL, enseignant_id INT DEFAULT NULL, INDEX IDX_CBC8768EE455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emploi_groupe (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, INDEX IDX_B334B51D7A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, addresse VARCHAR(20) NOT NULL, tel INT NOT NULL, email VARCHAR(20) NOT NULL, INDEX IDX_81A72FA1642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiare (id INT AUTO_INCREMENT NOT NULL, niveau_id INT DEFAULT NULL, nom_fliare VARCHAR(20) NOT NULL, INDEX IDX_29D9F542B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, filiare_id INT DEFAULT NULL, nom_groupe VARCHAR(20) NOT NULL, INDEX IDX_4B98C21839BE33F (filiare_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, cycle_id INT DEFAULT NULL, nom_niveau INT NOT NULL, INDEX cycle_id (cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE cycle ADD CONSTRAINT FK_B086D193642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE emploi_enseignant ADD CONSTRAINT FK_CBC8768EE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE emploi_groupe ADD CONSTRAINT FK_B334B51D7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE filiare ADD CONSTRAINT FK_29D9F542B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21839BE33F FOREIGN KEY (filiare_id) REFERENCES filiare (id)');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B5EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C642B8210');
        $this->addSql('ALTER TABLE cycle DROP FOREIGN KEY FK_B086D193642B8210');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1642B8210');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B5EC1162');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CE455FCC0');
        $this->addSql('ALTER TABLE emploi_enseignant DROP FOREIGN KEY FK_CBC8768EE455FCC0');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21839BE33F');
        $this->addSql('ALTER TABLE emploi_groupe DROP FOREIGN KEY FK_B334B51D7A45358C');
        $this->addSql('ALTER TABLE filiare DROP FOREIGN KEY FK_29D9F542B3E9C81');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cycle');
        $this->addSql('DROP TABLE emploi_enseignant');
        $this->addSql('DROP TABLE emploi_groupe');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE filiare');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE niveau');
    }
}
