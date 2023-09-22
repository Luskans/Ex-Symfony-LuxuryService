<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922073907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offer_candidate (offer_id INT NOT NULL, candidate_id INT NOT NULL, INDEX IDX_6B77F38053C674EE (offer_id), INDEX IDX_6B77F38091BD8781 (candidate_id), PRIMARY KEY(offer_id, candidate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer_candidate ADD CONSTRAINT FK_6B77F38053C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_candidate ADD CONSTRAINT FK_6B77F38091BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client CHANGE notes notes LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E99DED506');
        $this->addSql('DROP INDEX IDX_29D6873E99DED506 ON offer');
        $this->addSql('ALTER TABLE offer CHANGE id_client_id client_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E19EB6921 ON offer (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer_candidate DROP FOREIGN KEY FK_6B77F38053C674EE');
        $this->addSql('ALTER TABLE offer_candidate DROP FOREIGN KEY FK_6B77F38091BD8781');
        $this->addSql('DROP TABLE offer_candidate');
        $this->addSql('ALTER TABLE client CHANGE notes notes LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E19EB6921');
        $this->addSql('DROP INDEX IDX_29D6873E19EB6921 ON offer');
        $this->addSql('ALTER TABLE offer CHANGE client_id id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29D6873E99DED506 ON offer (id_client_id)');
    }
}
