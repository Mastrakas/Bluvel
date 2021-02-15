<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215140921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD user_pro_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A6E5FF87 FOREIGN KEY (user_pro_id) REFERENCES user_pro (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A6E5FF87 ON user (user_pro_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A6E5FF87');
        $this->addSql('DROP INDEX UNIQ_8D93D649A6E5FF87 ON user');
        $this->addSql('ALTER TABLE user DROP user_pro_id');
    }
}
