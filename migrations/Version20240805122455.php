<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240805122455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, nb_comedien INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comedien (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comedien_categorie (comedien_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_D7ACE3EFF453844F (comedien_id), INDEX IDX_D7ACE3EFBCF5E72D (categorie_id), PRIMARY KEY(comedien_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spectacle (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, nb_categorie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spectacle_comedien (spectacle_id INT NOT NULL, comedien_id INT NOT NULL, INDEX IDX_87BCFA5C682915D (spectacle_id), INDEX IDX_87BCFA5F453844F (comedien_id), PRIMARY KEY(spectacle_id, comedien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comedien_categorie ADD CONSTRAINT FK_D7ACE3EFF453844F FOREIGN KEY (comedien_id) REFERENCES comedien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comedien_categorie ADD CONSTRAINT FK_D7ACE3EFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spectacle_comedien ADD CONSTRAINT FK_87BCFA5C682915D FOREIGN KEY (spectacle_id) REFERENCES spectacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spectacle_comedien ADD CONSTRAINT FK_87BCFA5F453844F FOREIGN KEY (comedien_id) REFERENCES comedien (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comedien_categorie DROP FOREIGN KEY FK_D7ACE3EFF453844F');
        $this->addSql('ALTER TABLE comedien_categorie DROP FOREIGN KEY FK_D7ACE3EFBCF5E72D');
        $this->addSql('ALTER TABLE spectacle_comedien DROP FOREIGN KEY FK_87BCFA5C682915D');
        $this->addSql('ALTER TABLE spectacle_comedien DROP FOREIGN KEY FK_87BCFA5F453844F');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE comedien');
        $this->addSql('DROP TABLE comedien_categorie');
        $this->addSql('DROP TABLE spectacle');
        $this->addSql('DROP TABLE spectacle_comedien');
    }
}
