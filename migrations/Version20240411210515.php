<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240411210515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE muscle ADD muscle_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE muscle ADD CONSTRAINT FK_F31119EF44004D0 FOREIGN KEY (muscle_group_id) REFERENCES muscle_group (id)');
        $this->addSql('CREATE INDEX IDX_F31119EF44004D0 ON muscle (muscle_group_id)');
        $this->addSql('ALTER TABLE program CHANGE creator_id creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE program RENAME INDEX fk_program_user TO IDX_92ED778461220EA6');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE muscle DROP FOREIGN KEY FK_F31119EF44004D0');
        $this->addSql('DROP INDEX IDX_F31119EF44004D0 ON muscle');
        $this->addSql('ALTER TABLE muscle DROP muscle_group_id');
        $this->addSql('ALTER TABLE program CHANGE creator_id creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program RENAME INDEX idx_92ed778461220ea6 TO FK_program_user');
    }
}
