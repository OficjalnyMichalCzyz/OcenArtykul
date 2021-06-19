<?php

declare(strict_types=1);

namespace RateArticle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Test migration.
 */
final class Version20210619155019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration created only to test if everything works fine.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE Test (
                id int
            );
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DROP TABLE Test
        ");
    }
}
