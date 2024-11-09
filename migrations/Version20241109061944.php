<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241109061944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__propiedad AS SELECT id, nombre, direccion, ciudad, descripcion, tipo, capacidad, amenidades, eliminado FROM propiedad');
        $this->addSql('DROP TABLE propiedad');
        $this->addSql('CREATE TABLE propiedad (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, usuario_id INTEGER NOT NULL, nombre VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, ciudad VARCHAR(255) NOT NULL, descripcion CLOB NOT NULL, tipo VARCHAR(255) NOT NULL, capacidad INTEGER NOT NULL, amenidades CLOB NOT NULL, eliminado BOOLEAN NOT NULL, CONSTRAINT FK_6F3EFE0DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO propiedad (id, nombre, direccion, ciudad, descripcion, tipo, capacidad, amenidades, eliminado) SELECT id, nombre, direccion, ciudad, descripcion, tipo, capacidad, amenidades, eliminado FROM __temp__propiedad');
        $this->addSql('DROP TABLE __temp__propiedad');
        $this->addSql('CREATE INDEX IDX_6F3EFE0DDB38439E ON propiedad (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__propiedad AS SELECT id, nombre, direccion, ciudad, descripcion, tipo, capacidad, amenidades, eliminado FROM propiedad');
        $this->addSql('DROP TABLE propiedad');
        $this->addSql('CREATE TABLE propiedad (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, ciudad VARCHAR(255) NOT NULL, descripcion CLOB NOT NULL, tipo VARCHAR(255) NOT NULL, capacidad INTEGER NOT NULL, amenidades CLOB NOT NULL, eliminado BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO propiedad (id, nombre, direccion, ciudad, descripcion, tipo, capacidad, amenidades, eliminado) SELECT id, nombre, direccion, ciudad, descripcion, tipo, capacidad, amenidades, eliminado FROM __temp__propiedad');
        $this->addSql('DROP TABLE __temp__propiedad');
    }
}
