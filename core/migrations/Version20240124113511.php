<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124113511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE education_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE education (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE education_category (education_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(education_id, category_id))');
        $this->addSql('CREATE INDEX IDX_8E5867482CA1BD71 ON education_category (education_id)');
        $this->addSql('CREATE INDEX IDX_8E58674812469DE2 ON education_category (category_id)');
        $this->addSql('ALTER TABLE education_category ADD CONSTRAINT FK_8E5867482CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE education_category ADD CONSTRAINT FK_8E58674812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ALTER is_verified SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER country TYPE VARCHAR(5)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE education_id_seq CASCADE');
        $this->addSql('ALTER TABLE education_category DROP CONSTRAINT FK_8E5867482CA1BD71');
        $this->addSql('ALTER TABLE education_category DROP CONSTRAINT FK_8E58674812469DE2');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE education_category');
        $this->addSql('ALTER TABLE "user" ALTER is_verified DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER country TYPE VARCHAR(255)');
    }
}
