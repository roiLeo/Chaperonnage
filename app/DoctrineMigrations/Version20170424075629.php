<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170424075629 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE picture ADD picture_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64792558A7A5');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64792558A7A5 FOREIGN KEY (credential_id) REFERENCES picture (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64792558A7A5');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64792558A7A5 FOREIGN KEY (credential_id) REFERENCES credential (id)');
        $this->addSql('ALTER TABLE picture DROP picture_type');
    }
}
