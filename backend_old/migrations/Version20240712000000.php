<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240712000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add intensificationMethod to workout_plan';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE workout_plan ADD intensification_method VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE workout_plan DROP intensification_method');
    }
}
