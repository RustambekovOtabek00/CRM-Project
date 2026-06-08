<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260110071951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add column isDeleted in client company tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD is_deleted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD is_deleted TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP is_deleted');
        $this->addSql('ALTER TABLE company DROP is_deleted');
    }
}
