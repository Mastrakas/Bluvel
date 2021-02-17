<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217144106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_pro ADD id_user_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD zipcode VARCHAR(10) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, ADD mail VARCHAR(255) NOT NULL, ADD phone VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE user_pro ADD CONSTRAINT FK_80A2B77479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80A2B77479F37AE5 ON user_pro (id_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_pro DROP FOREIGN KEY FK_80A2B77479F37AE5');
        $this->addSql('DROP INDEX UNIQ_80A2B77479F37AE5 ON user_pro');
        $this->addSql('ALTER TABLE user_pro DROP id_user_id, DROP name, DROP address, DROP zipcode, DROP city, DROP country, DROP mail, DROP phone');
    }
}
