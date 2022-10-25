<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221025160204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plato_cantidad (id INT AUTO_INCREMENT NOT NULL, plato_id INT NOT NULL, pedido_id INT NOT NULL, cantidad INT NOT NULL, INDEX IDX_AD569595B0DB09EF (plato_id), INDEX IDX_AD5695954854653A (pedido_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plato_cantidad ADD CONSTRAINT FK_AD569595B0DB09EF FOREIGN KEY (plato_id) REFERENCES plato (id)');
        $this->addSql('ALTER TABLE plato_cantidad ADD CONSTRAINT FK_AD5695954854653A FOREIGN KEY (pedido_id) REFERENCES pedido (id)');
        $this->addSql('ALTER TABLE pedido DROP cantidad');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plato_cantidad DROP FOREIGN KEY FK_AD569595B0DB09EF');
        $this->addSql('ALTER TABLE plato_cantidad DROP FOREIGN KEY FK_AD5695954854653A');
        $this->addSql('DROP TABLE plato_cantidad');
        $this->addSql('ALTER TABLE pedido ADD cantidad INT NOT NULL');
    }
}
