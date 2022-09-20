<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916141207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_image (image_file VARCHAR(255) NOT NULL, article_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, update_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B28A764E7294869C (article_id), PRIMARY KEY(image_file)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_image ADD CONSTRAINT FK_B28A764E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article DROP image_name, DROP image_size, DROP image_updated_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_image DROP FOREIGN KEY FK_B28A764E7294869C');
        $this->addSql('DROP TABLE article_image');
        $this->addSql('ALTER TABLE article ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_size INT DEFAULT NULL, ADD image_updated_at DATETIME DEFAULT NULL');
    }
}
