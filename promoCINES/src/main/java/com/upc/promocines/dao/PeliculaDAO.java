package com.upc.promocines.dao;

import com.upc.promocines.entidades.Pelicula;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;

public interface PeliculaDAO extends CrudRepository<Pelicula, Long> {
    @Query("SELECT p FROM Pelicula p WHERE p.estado=1")
    public Iterable<Pelicula> listarPeliculas();
}