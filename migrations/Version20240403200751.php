<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403200751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D3EB8070A');
        $this->addSql('DROP INDEX IDX_E418C74D3EB8070A ON exercice');
        $this->addSql('ALTER TABLE exercice DROP program_id');
        $this->addSql('ALTER TABLE muscle DROP FOREIGN KEY FK_F31119EF79AEC3C');
        $this->addSql('DROP INDEX IDX_F31119EF79AEC3C ON muscle');
        $this->addSql('ALTER TABLE muscle DROP programs_id');
        $this->addSql('ALTER TABLE program ADD exercice_id INT DEFAULT NULL, ADD muscle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778489D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784354FDBB4 FOREIGN KEY (muscle_id) REFERENCES muscle (id)');
        $this->addSql('CREATE INDEX IDX_92ED778489D40298 ON program (exercice_id)');
        $this->addSql('CREATE INDEX IDX_92ED7784354FDBB4 ON program (muscle_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE muscle ADD programs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE muscle ADD CONSTRAINT FK_F31119EF79AEC3C FOREIGN KEY (programs_id) REFERENCES program (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F31119EF79AEC3C ON muscle (programs_id)');
        $this->addSql('ALTER TABLE exercice ADD program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E418C74D3EB8070A ON exercice (program_id)');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778489D40298');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784354FDBB4');
        $this->addSql('DROP INDEX IDX_92ED778489D40298 ON program');
        $this->addSql('DROP INDEX IDX_92ED7784354FDBB4 ON program');
        $this->addSql('ALTER TABLE program DROP exercice_id, DROP muscle_id');
    }
}
