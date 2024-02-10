<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240210183347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE sort_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_sort (product_id INT NOT NULL, sort_id INT NOT NULL, PRIMARY KEY(product_id, sort_id))');
        $this->addSql('CREATE INDEX IDX_DCCCD0834584665A ON product_sort (product_id)');
        $this->addSql('CREATE INDEX IDX_DCCCD08347013001 ON product_sort (sort_id)');
        $this->addSql('CREATE TABLE sort (id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, value VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE product_sort ADD CONSTRAINT FK_DCCCD0834584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_sort ADD CONSTRAINT FK_DCCCD08347013001 FOREIGN KEY (sort_id) REFERENCES sort (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE sort_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_sort DROP CONSTRAINT FK_DCCCD0834584665A');
        $this->addSql('ALTER TABLE product_sort DROP CONSTRAINT FK_DCCCD08347013001');
        $this->addSql('DROP TABLE product_sort');
        $this->addSql('DROP TABLE sort');
    }
}
