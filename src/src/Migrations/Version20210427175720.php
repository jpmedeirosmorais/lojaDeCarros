<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427175720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carro DROP FOREIGN KEY FK_C5BB165C3A9576E');
        $this->addSql('DROP TABLE comprador');
        $this->addSql('DROP TABLE modelo');
        $this->addSql('ALTER TABLE carro DROP FOREIGN KEY FK_C5BB16581EF0041');
        $this->addSql('ALTER TABLE carro DROP FOREIGN KEY FK_C5BB1658361A8B8');
        $this->addSql('DROP INDEX IDX_C5BB1658361A8B8 ON carro');
        $this->addSql('DROP INDEX IDX_C5BB16581EF0041 ON carro');
        $this->addSql('DROP INDEX IDX_C5BB165C3A9576E ON carro');
        $this->addSql('ALTER TABLE carro DROP marca_id, DROP modelo_id, DROP vendedor_id, DROP preco');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comprador (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, senha VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE modelo (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE carro ADD marca_id INT DEFAULT NULL, ADD modelo_id INT DEFAULT NULL, ADD vendedor_id INT DEFAULT NULL, ADD preco DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE carro ADD CONSTRAINT FK_C5BB16581EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
        $this->addSql('ALTER TABLE carro ADD CONSTRAINT FK_C5BB1658361A8B8 FOREIGN KEY (vendedor_id) REFERENCES vendedor (id)');
        $this->addSql('ALTER TABLE carro ADD CONSTRAINT FK_C5BB165C3A9576E FOREIGN KEY (modelo_id) REFERENCES modelo (id)');
        $this->addSql('CREATE INDEX IDX_C5BB1658361A8B8 ON carro (vendedor_id)');
        $this->addSql('CREATE INDEX IDX_C5BB16581EF0041 ON carro (marca_id)');
        $this->addSql('CREATE INDEX IDX_C5BB165C3A9576E ON carro (modelo_id)');
    }
}
