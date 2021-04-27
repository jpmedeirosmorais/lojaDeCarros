<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427182025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carro ADD marca_id INT NOT NULL');
        $this->addSql('ALTER TABLE carro ADD CONSTRAINT FK_C5BB16581EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
        $this->addSql('CREATE INDEX IDX_C5BB16581EF0041 ON carro (marca_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carro DROP FOREIGN KEY FK_C5BB16581EF0041');
        $this->addSql('DROP INDEX IDX_C5BB16581EF0041 ON carro');
        $this->addSql('ALTER TABLE carro DROP marca_id');
    }
}
