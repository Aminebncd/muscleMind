<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408202214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, target_id INT NOT NULL, secondary_target_id INT DEFAULT NULL, exercice_name VARCHAR(255) NOT NULL, exercice_function LONGTEXT NOT NULL, INDEX IDX_E418C74D158E0B66 (target_id), INDEX IDX_E418C74D8AAA4E1F (secondary_target_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE muscle (id INT AUTO_INCREMENT NOT NULL, muscle_name VARCHAR(50) NOT NULL, muscle_function LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE muscle_group (id INT AUTO_INCREMENT NOT NULL, muscle_group VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, user_performing_id INT NOT NULL, exercice_mesured_id INT NOT NULL, personnal_record VARCHAR(255) NOT NULL, INDEX IDX_82D79681208EA2D0 (user_performing_id), INDEX IDX_82D7968183E21899 (exercice_mesured_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_92ED778461220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_muscle_group (program_id INT NOT NULL, muscle_group_id INT NOT NULL, INDEX IDX_7198FAA93EB8070A (program_id), INDEX IDX_7198FAA944004D0 (muscle_group_id), PRIMARY KEY(program_id, muscle_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, program_id INT NOT NULL, date_session DATETIME NOT NULL, INDEX IDX_D044D5D43EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracking (id INT AUTO_INCREMENT NOT NULL, user_tracked_id INT NOT NULL, height VARCHAR(3) DEFAULT NULL, weight VARCHAR(3) DEFAULT NULL, age VARCHAR(3) DEFAULT NULL, sex SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_A87C621CDDA0EDA4 (user_tracked_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, score INT NOT NULL, username VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout_plan (id INT AUTO_INCREMENT NOT NULL, exercice_id INT NOT NULL, program_id INT DEFAULT NULL, number_of_repetitions INT NOT NULL, weights_used INT NOT NULL, INDEX IDX_A5D4580189D40298 (exercice_id), INDEX IDX_A5D458013EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D158E0B66 FOREIGN KEY (target_id) REFERENCES muscle (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D8AAA4E1F FOREIGN KEY (secondary_target_id) REFERENCES muscle (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D79681208EA2D0 FOREIGN KEY (user_performing_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968183E21899 FOREIGN KEY (exercice_mesured_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778461220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE program_muscle_group ADD CONSTRAINT FK_7198FAA93EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_muscle_group ADD CONSTRAINT FK_7198FAA944004D0 FOREIGN KEY (muscle_group_id) REFERENCES muscle_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D43EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE tracking ADD CONSTRAINT FK_A87C621CDDA0EDA4 FOREIGN KEY (user_tracked_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE workout_plan ADD CONSTRAINT FK_A5D4580189D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE workout_plan ADD CONSTRAINT FK_A5D458013EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D158E0B66');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D8AAA4E1F');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D79681208EA2D0');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968183E21899');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778461220EA6');
        $this->addSql('ALTER TABLE program_muscle_group DROP FOREIGN KEY FK_7198FAA93EB8070A');
        $this->addSql('ALTER TABLE program_muscle_group DROP FOREIGN KEY FK_7198FAA944004D0');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D43EB8070A');
        $this->addSql('ALTER TABLE tracking DROP FOREIGN KEY FK_A87C621CDDA0EDA4');
        $this->addSql('ALTER TABLE workout_plan DROP FOREIGN KEY FK_A5D4580189D40298');
        $this->addSql('ALTER TABLE workout_plan DROP FOREIGN KEY FK_A5D458013EB8070A');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE muscle');
        $this->addSql('DROP TABLE muscle_group');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE program_muscle_group');
        $this->addSql('DROP TABLE ressources');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE tracking');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE workout_plan');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
