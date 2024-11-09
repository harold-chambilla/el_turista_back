<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241109072436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cliente (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefono VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, pais VARCHAR(255) NOT NULL, eliminado BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE habitacion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, propiedad_id INTEGER NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion CLOB NOT NULL, capacidad INTEGER NOT NULL, precio_por_noche NUMERIC(10, 2) NOT NULL, estado VARCHAR(255) NOT NULL, eliminado BOOLEAN NOT NULL, CONSTRAINT FK_F45995BA25C78794 FOREIGN KEY (propiedad_id) REFERENCES propiedad (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F45995BA25C78794 ON habitacion (propiedad_id)');
        $this->addSql('CREATE TABLE nota_servicio (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reserva_id INTEGER NOT NULL, fecha_emision DATE NOT NULL, detalles_servicio CLOB NOT NULL, estado VARCHAR(255) NOT NULL, fecha_realizacion DATE NOT NULL, eliminado BOOLEAN NOT NULL, CONSTRAINT FK_D2368ECED67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D2368ECED67139E8 ON nota_servicio (reserva_id)');
        $this->addSql('CREATE TABLE propiedad (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, usuario_id INTEGER NOT NULL, nombre VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, ciudad VARCHAR(255) NOT NULL, descripcion CLOB NOT NULL, tipo VARCHAR(255) NOT NULL, capacidad INTEGER NOT NULL, amenidades CLOB NOT NULL, eliminado BOOLEAN NOT NULL, CONSTRAINT FK_6F3EFE0DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6F3EFE0DDB38439E ON propiedad (usuario_id)');
        $this->addSql('CREATE TABLE reserva (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cliente_id INTEGER NOT NULL, habitacion_id INTEGER NOT NULL, fecha_entrada DATE NOT NULL, fecha_salida DATE NOT NULL, estado VARCHAR(255) NOT NULL, numero_personas INTEGER NOT NULL, eliminado BOOLEAN NOT NULL, CONSTRAINT FK_188D2E3BDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_188D2E3BB009290D FOREIGN KEY (habitacion_id) REFERENCES habitacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_188D2E3BDE734E51 ON reserva (cliente_id)');
        $this->addSql('CREATE INDEX IDX_188D2E3BB009290D ON reserva (habitacion_id)');
        $this->addSql('CREATE TABLE reserva_servicio_adicional (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reserva_id INTEGER NOT NULL, servicio_adicional_id INTEGER NOT NULL, cantidad INTEGER NOT NULL, fecha_servicio DATE NOT NULL, detalles CLOB NOT NULL, eliminado BOOLEAN NOT NULL, CONSTRAINT FK_54055446D67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_54055446C8F247C0 FOREIGN KEY (servicio_adicional_id) REFERENCES servicio_adicional (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_54055446D67139E8 ON reserva_servicio_adicional (reserva_id)');
        $this->addSql('CREATE INDEX IDX_54055446C8F247C0 ON reserva_servicio_adicional (servicio_adicional_id)');
        $this->addSql('CREATE TABLE servicio_adicional (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion CLOB NOT NULL, precio NUMERIC(10, 2) NOT NULL, tipo VARCHAR(255) NOT NULL, eliminado BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_creacion DATE NOT NULL, eliminado BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON usuario (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE habitacion');
        $this->addSql('DROP TABLE nota_servicio');
        $this->addSql('DROP TABLE propiedad');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE reserva_servicio_adicional');
        $this->addSql('DROP TABLE servicio_adicional');
        $this->addSql('DROP TABLE usuario');
    }
}
