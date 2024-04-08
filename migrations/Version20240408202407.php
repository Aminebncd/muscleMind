<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408202407 extends AbstractMigration
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
        $this->addSql('ALTER TABLE exercice_muscle DROP FOREIGN KEY FK_2A9ECEF5354FDBB4');
        $this->addSql('ALTER TABLE exercice_muscle DROP FOREIGN KEY FK_2A9ECEF589D40298');
        $this->addSql('DROP TABLE exercice_muscle');
        $this->addSql('ALTER TABLE exercice ADD secondary_target_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D8AAA4E1F FOREIGN KEY (secondary_target_id) REFERENCES muscle (id)');
        $this->addSql('CREATE INDEX IDX_E418C74D8AAA4E1F ON exercice (secondary_target_id)');
        $this->addSql('ALTER TABLE program ADD creator_id INT NOT NULL, ADD title VARCHAR(255) NOT NULL, DROP number_of_repetitions, DROP weight_used');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778461220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_92ED778461220EA6 ON program (creator_id)');
        $this->addSql('ALTER TABLE session ADD program_id INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D43EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D43EB8070A ON session (program_id)');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice_muscle (exercice_id INT NOT NULL, muscle_id INT NOT NULL, INDEX IDX_2A9ECEF589D40298 (exercice_id), INDEX IDX_2A9ECEF5354FDBB4 (muscle_id), PRIMARY KEY(exercice_id, muscle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exercice_muscle ADD CONSTRAINT FK_2A9ECEF5354FDBB4 FOREIGN KEY (muscle_id) REFERENCES muscle (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_muscle ADD CONSTRAINT FK_2A9ECEF589D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_muscle_group DROP FOREIGN KEY FK_7198FAA93EB8070A');
        $this->addSql('ALTER TABLE program_muscle_group DROP FOREIGN KEY FK_7198FAA944004D0');
        $this->addSql('ALTER TABLE workout_plan DROP FOREIGN KEY FK_A5D4580189D40298');
        $this->addSql('ALTER TABLE workout_plan DROP FOREIGN KEY FK_A5D458013EB8070A');
        $this->addSql('DROP TABLE program_muscle_group');
        $this->addSql('DROP TABLE workout_plan');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D8AAA4E1F');
        $this->addSql('DROP INDEX IDX_E418C74D8AAA4E1F ON exercice');
        $this->addSql('ALTER TABLE exercice DROP secondary_target_id');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D43EB8070A');
        $this->addSql('DROP INDEX IDX_D044D5D43EB8070A ON session');
        $this->addSql('ALTER TABLE session DROP program_id');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778461220EA6');
        $this->addSql('DROP INDEX IDX_92ED778461220EA6 ON program');
        $this->addSql('ALTER TABLE program ADD weight_used INT NOT NULL, DROP title, CHANGE creator_id number_of_repetitions INT NOT NULL');
        $this->addSql('ALTER TABLE `user` DROP username');
    }
}
