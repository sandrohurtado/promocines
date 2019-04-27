package com.upc.promocines.entidades;

import com.fasterxml.jackson.annotation.JsonIgnore;

import javax.persistence.*;

@Entity
@Table(name="TP_PROMOCION")
public class Promocion {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long codigo;
    private String iniVigencia;
    private String finVigencia;
    private String descripcion;
    private double descuento;
    private int cantidad;
    private int stock;
    private int vendidas;
    private int estado;
    @ManyToOne
    @JoinColumn(name="ID_PELICULA")
    @JsonIgnore
    private Pelicula pelicula;

    public Long getCodigo() {
        return codigo;
    }

    public void setCodigo(Long codigo) {
        this.codigo = codigo;
    }

    public String getIniVigencia() {
        return iniVigencia;
    }

    public void setIniVigencia(String iniVigencia) {
        this.iniVigencia = iniVigencia;
    }

    public String getFinVigencia() {
        return finVigencia;
    }

    public void setFinVigencia(String finVigencia) {
        this.finVigencia = finVigencia;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public double getDescuento() {
        return descuento;
    }

    public void setDescuento(double descuento) {
        this.descuento = descuento;
    }

    public int getCantidad() {
        return cantidad;
    }

    public void setCantidad(int cantidad) {
        this.cantidad = cantidad;
    }

    public int getStock() {
        return stock;
    }

    public void setStock(int stock) {
        this.stock = stock;
    }

    public int getVendidas() {
        return vendidas;
    }

    public void setVendidas(int vendidas) {
        this.vendidas = vendidas;
    }

    public int getEstado() {
        return estado;
    }

    public void setEstado(int estado) {
        this.estado = estado;
    }

    public Pelicula getPelicula() {
        return pelicula;
    }

    public void setPelicula(Pelicula pelicula) {
        this.pelicula = pelicula;
    }
}