<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190129101603 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adminuser (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', password VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, is_confirmed TINYINT(1) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_81398E09E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE eav_attribute_values');
        $this->addSql('DROP TABLE eav_attributeset_values');
        $this->addSql('ALTER TABLE attribute ADD default_value VARCHAR(255) NOT NULL, DROP default_value_id, CHANGE name name VARCHAR(255) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL, CHANGE sort_order sort_order INT DEFAULT NULL, CHANGE category_url category_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` DROP shipping_price, CHANGE status status INT NOT NULL, CHANGE create_date create_date DATETIME NOT NULL, CHANGE price price DOUBLE PRECISION DEFAULT NULL, CHANGE discount discount DOUBLE PRECISION DEFAULT NULL, CHANGE total_price total_price DOUBLE PRECISION DEFAULT NULL, CHANGE customer_id customer_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_F5299398B171EB6C ON `order` (customer_id_id)');
        $this->addSql('ALTER TABLE eav_product_categories ADD CONSTRAINT FK_C5394D9C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE eav_product_categories ADD CONSTRAINT FK_C5394D9C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_C5394D9C4584665A ON eav_product_categories (product_id)');
        $this->addSql('CREATE INDEX IDX_C5394D9C12469DE2 ON eav_product_categories (category_id)');
        $this->addSql('ALTER TABLE order_item ADD order_id_id INT NOT NULL, ADD product_id_id INT NOT NULL, DROP order_id, DROP product_id, CHANGE sku sku VARCHAR(255) NOT NULL, CHANGE product_name product_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09FCDAEAAA ON order_item (order_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_52EA1F09DE18E50B ON order_item (product_id_id)');
        $this->addSql('DROP INDEX sku ON product');
        $this->addSql('ALTER TABLE product CHANGE sku sku VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE attributeset attributeset INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE weight weight VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE url_key url_key VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE attributeset CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE newslatter ADD customer_id_id INT DEFAULT NULL, DROP customer_id, CHANGE email email VARCHAR(255) NOT NULL, CHANGE is_confirmed is_confirmed TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE newslatter ADD CONSTRAINT FK_8B052308B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B052308B171EB6C ON newslatter (customer_id_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B171EB6C');
        $this->addSql('ALTER TABLE newslatter DROP FOREIGN KEY FK_8B052308B171EB6C');
        $this->addSql('CREATE TABLE eav_attribute_values (product_id INT NOT NULL, attribute_id INT NOT NULL, value VARCHAR(50) NOT NULL COLLATE utf8_general_ci) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eav_attributeset_values (product_id INT NOT NULL, attributeset_id INT NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE adminuser');
        $this->addSql('DROP TABLE customer');
        $this->addSql('ALTER TABLE attribute ADD default_value_id INT NOT NULL, DROP default_value, CHANGE name name VARCHAR(200) NOT NULL COLLATE utf8_general_ci, CHANGE type type VARCHAR(50) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE attributeset CHANGE name name VARCHAR(200) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(200) NOT NULL COLLATE utf8_general_ci, CHANGE sort_order sort_order INT DEFAULT 0, CHANGE category_url category_url VARCHAR(250) DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE eav_product_categories DROP FOREIGN KEY FK_C5394D9C4584665A');
        $this->addSql('ALTER TABLE eav_product_categories DROP FOREIGN KEY FK_C5394D9C12469DE2');
        $this->addSql('DROP INDEX IDX_C5394D9C4584665A ON eav_product_categories');
        $this->addSql('DROP INDEX IDX_C5394D9C12469DE2 ON eav_product_categories');
        $this->addSql('DROP INDEX UNIQ_8B052308B171EB6C ON newslatter');
        $this->addSql('ALTER TABLE newslatter ADD customer_id INT DEFAULT 0, DROP customer_id_id, CHANGE email email VARCHAR(200) NOT NULL COLLATE utf8_general_ci, CHANGE is_confirmed is_confirmed TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_F5299398B171EB6C ON `order`');
        $this->addSql('ALTER TABLE `order` ADD shipping_price DOUBLE PRECISION NOT NULL, CHANGE status status VARCHAR(100) NOT NULL COLLATE utf8_general_ci, CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE discount discount DOUBLE PRECISION NOT NULL, CHANGE total_price total_price DOUBLE PRECISION NOT NULL, CHANGE create_date create_date DATE NOT NULL, CHANGE customer_id_id customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09FCDAEAAA');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09DE18E50B');
        $this->addSql('DROP INDEX IDX_52EA1F09FCDAEAAA ON order_item');
        $this->addSql('DROP INDEX UNIQ_52EA1F09DE18E50B ON order_item');
        $this->addSql('ALTER TABLE order_item ADD order_id INT NOT NULL, ADD product_id INT NOT NULL, DROP order_id_id, DROP product_id_id, CHANGE sku sku VARCHAR(100) NOT NULL COLLATE utf8_general_ci, CHANGE product_name product_name VARCHAR(200) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE product CHANGE name name VARCHAR(200) NOT NULL COLLATE utf8_general_ci, CHANGE description description TEXT NOT NULL COLLATE utf8_general_ci, CHANGE sku sku VARCHAR(100) NOT NULL COLLATE utf8_general_ci, CHANGE weight weight DOUBLE PRECISION NOT NULL, CHANGE attributeset attributeset INT NOT NULL, CHANGE url_key url_key VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci, CHANGE image image VARCHAR(50) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('CREATE UNIQUE INDEX sku ON product (sku)');
    }
}
