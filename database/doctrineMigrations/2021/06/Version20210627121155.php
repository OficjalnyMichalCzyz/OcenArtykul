<?php

declare(strict_types=1);

namespace RateArticle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210627121155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Articles tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE Articles(
                    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    articleDescription VARCHAR (512) COLLATE UTF8_POLISH_CI,
                    articleUrl VARCHAR(512) NOT NULL COLLATE UTF8_POLISH_CI,
                    imageUrl VARCHAR(512) NOT NULL COLLATE UTF8_POLISH_CI,
                    originIp INT(12) UNSIGNED NOT NULL,
                    dateOfPosting TIMESTAMP NOT NULL,
                    PRIMARY KEY (id)
                )
                COLLATE=utf8_polish_ci
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE Articles;");
    }
}
