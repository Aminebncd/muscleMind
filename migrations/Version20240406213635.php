<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240406213635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE program_muscle_group (program_id INT NOT NULL, muscle_group_id INT NOT NULL, INDEX IDX_7198FAA93EB8070A (program_id), INDEX IDX_7198FAA944004D0 (muscle_group_id), PRIMARY KEY(program_id, muscle_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout_plan (id INT AUTO_INCREMENT NOT NULL, exercice_id INT NOT NULL, program_id INT DEFAULT NULL, number_of_repetitions INT NOT NULL, weights_used INT NOT NULL, INDEX IDX_A5D4580189D40298 (exercice_id), INDEX IDX_A5D458013EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE program_muscle_group ADD CONSTRAINT FK_7198FAA93EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_muscle_group ADD CONSTRAINT FK_7198FAA944004D0 FOREIGN KEY (muscle_group_id) REFERENCES muscle_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workout_plan ADD CONSTRAINT FK_A5D4580189D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE workout_plan ADD CONSTRAINT FK_A5D458013EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784354FDBB4');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778489D40298');
        $this->addSql('DROP INDEX IDX_92ED7784354FDBB4 ON program');
        $this->addSql('DROP INDEX IDX_92ED778489D40298 ON program');
        $this->addSql('ALTER TABLE program ADD title VARCHAR(255) NOT NULL, DROP exercice_id, DROP muscle_id, DROP number_of_repetitions, DROP weight_used');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4F675F31B');
        $this->addSql('DROP INDEX IDX_D044D5D4F675F31B ON session');
        $this->addSql('ALTER TABLE session DROP author_id, DROP title');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program_muscle_group DROP FOREIGN KEY FK_7198FAA93EB8070A');
        $this->addSql('ALTER TABLE program_muscle_group DROP FOREIGN KEY FK_7198FAA944004D0');
        $this->addSql('ALTER TABLE workout_plan DROP FOREIGN KEY FK_A5D4580189D40298');
        $this->addSql('ALTER TABLE workout_plan DROP FOREIGN KEY FK_A5D458013EB8070A');
        $this->addSql('DROP TABLE program_muscle_group');
        $this->addSql('DROP TABLE workout_plan');
        $this->addSql('ALTER TABLE session ADD author_id INT NOT NULL, ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4F675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D044D5D4F675F31B ON session (author_id)');
        $this->addSql('ALTER TABLE program ADD exercice_id INT NOT NULL, ADD muscle_id INT NOT NULL, ADD number_of_repetitions INT NOT NULL, ADD weight_used INT NOT NULL, DROP title');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784354FDBB4 FOREIGN KEY (muscle_id) REFERENCES muscle (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778489D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_92ED7784354FDBB4 ON program (muscle_id)');
        $this->addSql('CREATE INDEX IDX_92ED778489D40298 ON program (exercice_id)');
    }
}
