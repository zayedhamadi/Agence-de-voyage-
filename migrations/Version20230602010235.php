<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602010235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455990323F');
        $this->addSql('DROP INDEX IDX_C7440455990323F ON client');
        $this->addSql('ALTER TABLE client CHANGE fk_voyage_id voyage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045568C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('CREATE INDEX IDX_C744045568C9E5AF ON client (voyage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045568C9E5AF');
        $this->addSql('DROP INDEX IDX_C744045568C9E5AF ON client');
        $this->addSql('ALTER TABLE client CHANGE voyage_id fk_voyage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455990323F FOREIGN KEY (fk_voyage_id) REFERENCES voyage (id)');
        $this->addSql('CREATE INDEX IDX_C7440455990323F ON client (fk_voyage_id)');
    }
}
