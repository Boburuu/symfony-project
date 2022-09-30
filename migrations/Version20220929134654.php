<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929134654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A727ACA70');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A7294869C');
        $this->addSql('DROP TABLE comments');
        $this->addSql('ALTER TABLE article ADD active TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, parent_id INT DEFAULT NULL, content LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, active TINYINT(1) NOT NULL, email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, username VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, created_at DATETIME NOT NULL, rgpd TINYINT(1) NOT NULL, INDEX IDX_5F9E962A727ACA70 (parent_id), INDEX IDX_5F9E962A7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A727ACA70 FOREIGN KEY (parent_id) REFERENCES comments (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE article DROP active');
    }
}
