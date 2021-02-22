<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218105938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD gender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66708A0E0 ON article (gender_id)');
        $this->addSql('ALTER TABLE color CHANGE name_color namecolor VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66708A0E0');
        $this->addSql('DROP INDEX IDX_23A0E66708A0E0 ON article');
        $this->addSql('ALTER TABLE article DROP gender_id');
        $this->addSql('ALTER TABLE color CHANGE namecolor name_color VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
