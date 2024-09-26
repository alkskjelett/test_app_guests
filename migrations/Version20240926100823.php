<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240926100823 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE guest_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE guest (id INT NOT NULL, firstname VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, phone VARCHAR(12) NOT NULL, email VARCHAR(80) NOT NULL, country VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACB79A35444F97DD ON guest (phone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACB79A35E7927C74 ON guest (email)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE guest_id_seq CASCADE');
        $this->addSql('DROP TABLE guest');
    }
}
