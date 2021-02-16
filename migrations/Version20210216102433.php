<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216102433 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, date_begin DATE DEFAULT NULL, date_end DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notice (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A6E5FF87');
        $this->addSql('DROP INDEX UNIQ_8D93D649A6E5FF87 ON user');
        $this->addSql('ALTER TABLE user DROP user_pro_id');
        $this->addSql('ALTER TABLE user_pro ADD id_user_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, CHANGE siret siret INT NOT NULL');
        $this->addSql('ALTER TABLE user_pro ADD CONSTRAINT FK_80A2B77479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80A2B77479F37AE5 ON user_pro (id_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE notice');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE sales');
        $this->addSql('ALTER TABLE user ADD user_pro_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A6E5FF87 FOREIGN KEY (user_pro_id) REFERENCES user_pro (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A6E5FF87 ON user (user_pro_id)');
        $this->addSql('ALTER TABLE user_pro DROP FOREIGN KEY FK_80A2B77479F37AE5');
        $this->addSql('DROP INDEX UNIQ_80A2B77479F37AE5 ON user_pro');
        $this->addSql('ALTER TABLE user_pro DROP id_user_id, DROP name, CHANGE siret siret VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
