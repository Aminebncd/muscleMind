<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260317185017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice ADD api_id VARCHAR(255) DEFAULT NULL, ADD gif_url VARCHAR(500) DEFAULT NULL, CHANGE exercice_function exercice_function LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE program CHANGE color color VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice DROP api_id, DROP gif_url, CHANGE exercice_function exercice_function LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE program CHANGE color color VARCHAR(10) DEFAULT NULL');
    }
}
