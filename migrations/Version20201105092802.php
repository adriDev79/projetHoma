<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105092802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE totaux_gestion_compte (id INT AUTO_INCREMENT NOT NULL, total_revenu DOUBLE PRECISION DEFAULT NULL, total_depense_fixe DOUBLE PRECISION DEFAULT NULL, total_depense_annexe DOUBLE PRECISION DEFAULT NULL, total_depense DOUBLE PRECISION DEFAULT NULL, solde DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depense_annexe CHANGE type_depense_id type_depense_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE date_deb_depense_annexe date_deb_depense_annexe DATE DEFAULT NULL, CHANGE date_fin_depense_annexe date_fin_depense_annexe DATE DEFAULT NULL, CHANGE date_modif date_modif DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE depense_fixe CHANGE type_depense_id type_depense_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE date_modif date_modif DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE revenu CHANGE user_id user_id INT DEFAULT NULL, CHANGE date_modif date_modif DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE totaux_gestion_compte');
        $this->addSql('ALTER TABLE depense_annexe CHANGE type_depense_id type_depense_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE date_modif date_modif DATE DEFAULT \'NULL\', CHANGE date_deb_depense_annexe date_deb_depense_annexe DATE DEFAULT \'NULL\', CHANGE date_fin_depense_annexe date_fin_depense_annexe DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE depense_fixe CHANGE type_depense_id type_depense_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE date_modif date_modif DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE revenu CHANGE user_id user_id INT DEFAULT NULL, CHANGE date_modif date_modif DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
