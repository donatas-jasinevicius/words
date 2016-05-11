<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160403150217 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql('CREATE TABLE words_words_lists (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words_words (id INT AUTO_INCREMENT NOT NULL, words_list_id INT NOT NULL, original VARCHAR(255) NOT NULL, INDEX IDX_8181757699D5790 (words_list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words_translations (id INT AUTO_INCREMENT NOT NULL, word_id INT NOT NULL, translation VARCHAR(255) NOT NULL, INDEX IDX_6F28EB72E357438D (word_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE words_words ADD CONSTRAINT FK_8181757699D5790 FOREIGN KEY (words_list_id) REFERENCES words_words_lists (id)');
        $this->addSql('ALTER TABLE words_translations ADD CONSTRAINT FK_6F28EB72E357438D FOREIGN KEY (word_id) REFERENCES words_words (id)');
        $this->addSql('CREATE TABLE words_statistics_word_results (id INT AUTO_INCREMENT NOT NULL, word_id INT NOT NULL, created_at DATETIME NOT NULL, correct_count INT NOT NULL, incorrect_count INT NOT NULL, INDEX IDX_77DCC488E357438D (word_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE words_statistics_word_results ADD CONSTRAINT FK_77DCC488E357438D FOREIGN KEY (word_id) REFERENCES words_words (id);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        //todo: write down migrations

    }
}
