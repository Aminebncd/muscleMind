<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240428193542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tracking DROP INDEX UNIQ_A87C621CDDA0EDA4, ADD INDEX IDX_A87C621CDDA0EDA4 (user_tracked_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tracking DROP INDEX IDX_A87C621CDDA0EDA4, ADD UNIQUE INDEX UNIQ_A87C621CDDA0EDA4 (user_tracked_id)');
    }
}
