<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408202136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program ADD creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778461220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_92ED778461220EA6 ON program (creator_id)');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_session_user');
        $this->addSql('DROP INDEX FK_session_user ON session');
        $this->addSql('ALTER TABLE session DROP creator_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778461220EA6');
        $this->addSql('DROP INDEX IDX_92ED778461220EA6 ON program');
        $this->addSql('ALTER TABLE program DROP creator_id');
        $this->addSql('ALTER TABLE session ADD creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_session_user FOREIGN KEY (creator_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX FK_session_user ON session (creator_id)');
    }
}
