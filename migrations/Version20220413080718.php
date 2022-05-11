<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413080718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE size ADD pizza_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE size ADD CONSTRAINT FK_F7C0246AD41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id)');
        $this->addSql('CREATE INDEX IDX_F7C0246AD41D1D42 ON size (pizza_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE size DROP FOREIGN KEY FK_F7C0246AD41D1D42');
        $this->addSql('DROP INDEX IDX_F7C0246AD41D1D42 ON size');
        $this->addSql('ALTER TABLE size DROP pizza_id');
    }
}
