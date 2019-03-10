<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190308144520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql("CREATE TABLE domain_groups (
          id CHAR(36) NOT NULL, 
          name VARCHAR(255) NOT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB");

        $this->addSql('CREATE TABLE domain_people (
          id CHAR(36) NOT NULL, 
          name VARCHAR(255) NOT NULL, 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

        $this->addSql('CREATE TABLE domain_members (
          id CHAR(36) NOT NULL,
          group_id CHAR(36) NOT NULL,
          person_id CHAR(36) DEFAULT NULL,
          name VARCHAR(255) NOT NULL,
          balance_value NUMERIC(10, 2) NOT NULL,
          when_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY(id),
          FOREIGN KEY (group_id) REFERENCES domain_groups (id) ON DELETE CASCADE,
          FOREIGN KEY (person_id) REFERENCES domain_people (id) ON DELETE SET NULL
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('DROP TABLE domain_members');
        $this->addSql('DROP TABLE domain_people');
        $this->addSql('DROP TABLE domain_groups');
    }
}
