<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919073229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_image ADD id INT AUTO_INCREMENT NOT NULL, DROP image_file, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_image MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON article_image');
        $this->addSql('ALTER TABLE article_image ADD image_file VARCHAR(255) NOT NULL, DROP id');
        $this->addSql('ALTER TABLE article_image ADD PRIMARY KEY (image_file)');
    }
}
