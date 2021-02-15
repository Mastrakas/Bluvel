<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215140818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_pro DROP FOREIGN KEY FK_80A2B77452C7154E');
        $this->addSql('DROP INDEX UNIQ_80A2B77452C7154E ON user_pro');
        $this->addSql('ALTER TABLE user_pro DROP pro_user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_pro ADD pro_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_pro ADD CONSTRAINT FK_80A2B77452C7154E FOREIGN KEY (pro_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80A2B77452C7154E ON user_pro (pro_user_id)');
    }
}
