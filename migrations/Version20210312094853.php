<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312094853 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cupcake ADD auteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cupcake ADD CONSTRAINT FK_5E582BFA60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_5E582BFA60BB6FE6 ON cupcake (auteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cupcake DROP FOREIGN KEY FK_5E582BFA60BB6FE6');
        $this->addSql('DROP INDEX IDX_5E582BFA60BB6FE6 ON cupcake');
        $this->addSql('ALTER TABLE cupcake DROP auteur_id');
    }
}
