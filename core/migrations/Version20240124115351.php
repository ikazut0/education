<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124115351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_category (user_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(user_id, category_id))');
        $this->addSql('CREATE INDEX IDX_E6C1FDC1A76ED395 ON user_category (user_id)');
        $this->addSql('CREATE INDEX IDX_E6C1FDC112469DE2 ON user_category (category_id)');
        $this->addSql('ALTER TABLE user_category ADD CONSTRAINT FK_E6C1FDC1A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_category ADD CONSTRAINT FK_E6C1FDC112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" DROP category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_category DROP CONSTRAINT FK_E6C1FDC1A76ED395');
        $this->addSql('ALTER TABLE user_category DROP CONSTRAINT FK_E6C1FDC112469DE2');
        $this->addSql('DROP TABLE user_category');
        $this->addSql('ALTER TABLE "user" ADD category VARCHAR(255) DEFAULT NULL');
    }
}
