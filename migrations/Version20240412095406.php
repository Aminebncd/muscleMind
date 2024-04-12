<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412095406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE program_muscle_group (program_id INT NOT NULL, muscle_group_id INT NOT NULL, INDEX IDX_7198FAA93EB8070A (program_id), INDEX IDX_7198FAA944004D0 (muscle_group_id), PRIMARY KEY(program_id, muscle_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE program_muscle_group ADD CONSTRAINT FK_7198FAA93EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_muscle_group ADD CONSTRAINT FK_7198FAA944004D0 FOREIGN KEY (muscle_group_id) REFERENCES muscle_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice CHANGE exercice_function exercice_function LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE exercice RENAME INDEX fk_target_id TO IDX_E418C74D158E0B66');
        $this->addSql('ALTER TABLE exercice RENAME INDEX fk_secondary_target_id TO IDX_E418C74D8AAA4E1F');
        $this->addSql('ALTER TABLE muscle CHANGE muscle_group_id muscle_group_id INT NOT NULL, CHANGE muscle_function muscle_function LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE muscle RENAME INDEX fk_muscle_group_id TO IDX_F31119EF44004D0');
        $this->addSql('ALTER TABLE performance RENAME INDEX fk_user_performing_id TO IDX_82D79681208EA2D0');
        $this->addSql('ALTER TABLE performance RENAME INDEX fk_exercice_mesured_id TO IDX_82D7968183E21899');
        $this->addSql('ALTER TABLE program RENAME INDEX fk_creator_id TO IDX_92ED778461220EA6');
        $this->addSql('ALTER TABLE ressources CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE session RENAME INDEX fk_program_id_session TO IDX_D044D5D43EB8070A');
        $this->addSql('ALTER TABLE tracking DROP INDEX FK_USER_TRACKED_ID, ADD UNIQUE INDEX UNIQ_A87C621CDDA0EDA4 (user_tracked_id)');
        $this->addSql('ALTER TABLE workout_plan RENAME INDEX fk_exercice_id TO IDX_A5D4580189D40298');
        $this->addSql('ALTER TABLE workout_plan RENAME INDEX fk_program_id TO IDX_A5D458013EB8070A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program_muscle_group DROP FOREIGN KEY FK_7198FAA93EB8070A');
        $this->addSql('ALTER TABLE program_muscle_group DROP FOREIGN KEY FK_7198FAA944004D0');
        $this->addSql('DROP TABLE program_muscle_group');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE program RENAME INDEX idx_92ed778461220ea6 TO FK_CREATOR_ID');
        $this->addSql('ALTER TABLE exercice CHANGE exercice_function exercice_function TEXT NOT NULL');
        $this->addSql('ALTER TABLE exercice RENAME INDEX idx_e418c74d8aaa4e1f TO FK_SECONDARY_TARGET_ID');
        $this->addSql('ALTER TABLE exercice RENAME INDEX idx_e418c74d158e0b66 TO FK_TARGET_ID');
        $this->addSql('ALTER TABLE muscle CHANGE muscle_group_id muscle_group_id INT DEFAULT NULL, CHANGE muscle_function muscle_function TEXT NOT NULL');
        $this->addSql('ALTER TABLE muscle RENAME INDEX idx_f31119ef44004d0 TO FK_MUSCLE_GROUP_ID');
        $this->addSql('ALTER TABLE session RENAME INDEX idx_d044d5d43eb8070a TO FK_PROGRAM_ID_SESSION');
        $this->addSql('ALTER TABLE performance RENAME INDEX idx_82d7968183e21899 TO FK_EXERCICE_MESURED_ID');
        $this->addSql('ALTER TABLE performance RENAME INDEX idx_82d79681208ea2d0 TO FK_USER_PERFORMING_ID');
        $this->addSql('ALTER TABLE ressources CHANGE content content TEXT NOT NULL');
        $this->addSql('ALTER TABLE tracking DROP INDEX UNIQ_A87C621CDDA0EDA4, ADD INDEX FK_USER_TRACKED_ID (user_tracked_id)');
        $this->addSql('ALTER TABLE workout_plan RENAME INDEX idx_a5d4580189d40298 TO FK_EXERCICE_ID');
        $this->addSql('ALTER TABLE workout_plan RENAME INDEX idx_a5d458013eb8070a TO FK_PROGRAM_ID');
    }
}
