<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190414112308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, enseignant_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, INDEX IDX_BF5476CAE455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE filiare CHANGE nom_fliare nom_fliare VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE niveau CHANGE nom_niveau nom_niveau INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE notification');
        $this->addSql('ALTER TABLE filiare CHANGE nom_fliare nom_fliare VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE niveau CHANGE nom_niveau nom_niveau VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
