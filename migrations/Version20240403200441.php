<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403200441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program_exercice DROP FOREIGN KEY FK_652D3B783EB8070A');
        $this->addSql('ALTER TABLE program_exercice DROP FOREIGN KEY FK_652D3B7889D40298');
        $this->addSql('ALTER TABLE program_muscle DROP FOREIGN KEY FK_A75127B5354FDBB4');
        $this->addSql('ALTER TABLE program_muscle DROP FOREIGN KEY FK_A75127B53EB8070A');
        $this->addSql('DROP TABLE program_exercice');
        $this->addSql('DROP TABLE program_muscle');
        $this->addSql('ALTER TABLE exercice ADD program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D3EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_E418C74D3EB8070A ON exercice (program_id)');
        $this->addSql('ALTER TABLE muscle ADD programs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE muscle ADD CONSTRAINT FK_F31119EF79AEC3C FOREIGN KEY (programs_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_F31119EF79AEC3C ON muscle (programs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE program_exercice (program_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_652D3B783EB8070A (program_id), INDEX IDX_652D3B7889D40298 (exercice_id), PRIMARY KEY(program_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE program_muscle (program_id INT NOT NULL, muscle_id INT NOT NULL, INDEX IDX_A75127B53EB8070A (program_id), INDEX IDX_A75127B5354FDBB4 (muscle_id), PRIMARY KEY(program_id, muscle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE program_exercice ADD CONSTRAINT FK_652D3B783EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_exercice ADD CONSTRAINT FK_652D3B7889D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_muscle ADD CONSTRAINT FK_A75127B5354FDBB4 FOREIGN KEY (muscle_id) REFERENCES muscle (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_muscle ADD CONSTRAINT FK_A75127B53EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE muscle DROP FOREIGN KEY FK_F31119EF79AEC3C');
        $this->addSql('DROP INDEX IDX_F31119EF79AEC3C ON muscle');
        $this->addSql('ALTER TABLE muscle DROP programs_id');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D3EB8070A');
        $this->addSql('DROP INDEX IDX_E418C74D3EB8070A ON exercice');
        $this->addSql('ALTER TABLE exercice DROP program_id');
    }
}
