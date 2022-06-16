<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616161114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD producer_id INT DEFAULT NULL, ADD breed_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F89B658FE FOREIGN KEY (producer_id) REFERENCES producer (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F89B658FE ON animal (producer_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FA8B4A30F ON animal (breed_id)');
        $this->addSql('ALTER TABLE breed ADD specie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE breed ADD CONSTRAINT FK_F8AF884FD5436AB7 FOREIGN KEY (specie_id) REFERENCES specie (id)');
        $this->addSql('CREATE INDEX IDX_F8AF884FD5436AB7 ON breed (specie_id)');
        $this->addSql('ALTER TABLE piece ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE piece ADD CONSTRAINT FK_44CA0B238E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_44CA0B238E962C16 ON piece (animal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F89B658FE');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA8B4A30F');
        $this->addSql('DROP INDEX IDX_6AAB231F89B658FE ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231FA8B4A30F ON animal');
        $this->addSql('ALTER TABLE animal DROP producer_id, DROP breed_id');
        $this->addSql('ALTER TABLE breed DROP FOREIGN KEY FK_F8AF884FD5436AB7');
        $this->addSql('DROP INDEX IDX_F8AF884FD5436AB7 ON breed');
        $this->addSql('ALTER TABLE breed DROP specie_id');
        $this->addSql('ALTER TABLE piece DROP FOREIGN KEY FK_44CA0B238E962C16');
        $this->addSql('DROP INDEX IDX_44CA0B238E962C16 ON piece');
        $this->addSql('ALTER TABLE piece DROP animal_id');
    }
}
