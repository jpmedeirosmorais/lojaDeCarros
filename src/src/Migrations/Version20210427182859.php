<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427182859 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carro ADD vendedor_id INT NOT NULL');
        $this->addSql('ALTER TABLE carro ADD CONSTRAINT FK_C5BB1658361A8B8 FOREIGN KEY (vendedor_id) REFERENCES vendedor (id)');
        $this->addSql('CREATE INDEX IDX_C5BB1658361A8B8 ON carro (vendedor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carro DROP FOREIGN KEY FK_C5BB1658361A8B8');
        $this->addSql('DROP INDEX IDX_C5BB1658361A8B8 ON carro');
        $this->addSql('ALTER TABLE carro DROP vendedor_id');
    }
}
