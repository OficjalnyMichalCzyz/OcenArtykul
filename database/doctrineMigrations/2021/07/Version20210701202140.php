<?php

declare(strict_types=1);

namespace RateArticle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701202140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Table of judgements';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE Judgements(
                    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    body VARCHAR (2500) COLLATE UTF8_POLISH_CI,
                    judgementType INT(2) NOT NULL,
                    judgedArticleId INT(11) UNSIGNED NOT NULL,
                    originIp INT(12) UNSIGNED NOT NULL,
                    dateOfPosting TIMESTAMP NOT NULL,
                    PRIMARY KEY (id)
                )
                COLLATE=utf8_polish_ci
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE Judgements;");
    }
}
