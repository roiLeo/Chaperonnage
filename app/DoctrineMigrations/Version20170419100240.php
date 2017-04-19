<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170419100240 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, lattitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credential (id INT AUTO_INCREMENT NOT NULL, src VARCHAR(255) NOT NULL, verified TINYINT(1) NOT NULL, uploaded_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, src VARCHAR(255) NOT NULL, verified TINYINT(1) NOT NULL, uploaded_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride (id INT AUTO_INCREMENT NOT NULL, guard_user_id INT DEFAULT NULL, protected_user_id INT DEFAULT NULL, start_address_id INT DEFAULT NULL, finish_address_id INT DEFAULT NULL, date DATETIME NOT NULL, hour TIME NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_9B3D7CD014704D14 (guard_user_id), INDEX IDX_9B3D7CD09246174D (protected_user_id), UNIQUE INDEX UNIQ_9B3D7CD08778008B (start_address_id), UNIQUE INDEX UNIQ_9B3D7CD0A0D95B40 (finish_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, credential_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', facebook_id VARCHAR(255) DEFAULT NULL, facebook_access_token VARCHAR(255) DEFAULT NULL, phone VARCHAR(10) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) DEFAULT NULL, birthday DATE DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, phone_verified TINYINT(1) NOT NULL, gender VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), UNIQUE INDEX UNIQ_957A6479EE45BDBF (picture_id), UNIQUE INDEX UNIQ_957A64792558A7A5 (credential_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_addresses (user_id INT NOT NULL, address_id INT NOT NULL, INDEX IDX_9B70FF7A76ED395 (user_id), UNIQUE INDEX UNIQ_9B70FF7F5B7AF75 (address_id), PRIMARY KEY(user_id, address_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD014704D14 FOREIGN KEY (guard_user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD09246174D FOREIGN KEY (protected_user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD08778008B FOREIGN KEY (start_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD0A0D95B40 FOREIGN KEY (finish_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64792558A7A5 FOREIGN KEY (credential_id) REFERENCES credential (id)');
        $this->addSql('ALTER TABLE users_addresses ADD CONSTRAINT FK_9B70FF7A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE users_addresses ADD CONSTRAINT FK_9B70FF7F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD08778008B');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD0A0D95B40');
        $this->addSql('ALTER TABLE users_addresses DROP FOREIGN KEY FK_9B70FF7F5B7AF75');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64792558A7A5');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479EE45BDBF');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD014704D14');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD09246174D');
        $this->addSql('ALTER TABLE users_addresses DROP FOREIGN KEY FK_9B70FF7A76ED395');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE credential');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE ride');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE users_addresses');
    }
}
