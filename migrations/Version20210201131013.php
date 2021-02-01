<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201131013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD date_new_password DATE DEFAULT NULL, DROP date_update_passwword, CHANGE birthdate birthdate DATE NOT NULL');
        $this->addSql('ALTER TABLE user_pro ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_pro ADD CONSTRAINT FK_80A2B77479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80A2B77479F37AE5 ON user_pro (id_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD date_update_passwword DATETIME NOT NULL, DROP date_new_password, CHANGE birthdate birthdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user_pro DROP FOREIGN KEY FK_80A2B77479F37AE5');
        $this->addSql('DROP INDEX UNIQ_80A2B77479F37AE5 ON user_pro');
        $this->addSql('ALTER TABLE user_pro DROP id_user_id');
    }
}
