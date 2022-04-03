<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228151736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE risk ADD project_id INT NOT NULL');
        $this->addSql('ALTER TABLE risk ADD CONSTRAINT FK_7906D541166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_7906D541166D1F9C ON risk (project_id)');
        $this->addSql('ALTER TABLE risk_project DROP FOREIGN KEY FK_65ACBEA1166D1F9C');
        $this->addSql('DROP INDEX IDX_65ACBEA1166D1F9C ON risk_project');
        $this->addSql('ALTER TABLE risk_project CHANGE project_id_test project_id INT NOT NULL');
        $this->addSql('ALTER TABLE risk_project ADD CONSTRAINT FK_65ACBEA1166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_65ACBEA1166D1F9C ON risk_project (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE highlight CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE milestone CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE portfolio CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE risk DROP FOREIGN KEY FK_7906D541166D1F9C');
        $this->addSql('DROP INDEX IDX_7906D541166D1F9C ON risk');
        $this->addSql('ALTER TABLE risk DROP project_id, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE severity severity VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE risk_project DROP FOREIGN KEY FK_65ACBEA1166D1F9C');
        $this->addSql('DROP INDEX IDX_65ACBEA1166D1F9C ON risk_project');
        $this->addSql('ALTER TABLE risk_project CHANGE project_id project_id_test INT NOT NULL');
        $this->addSql('ALTER TABLE risk_project ADD CONSTRAINT FK_65ACBEA1166D1F9C FOREIGN KEY (project_id_test) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_65ACBEA1166D1F9C ON risk_project (project_id_test)');
        $this->addSql('ALTER TABLE role CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE status CHANGE name_status name_status VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE color color VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE team CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
