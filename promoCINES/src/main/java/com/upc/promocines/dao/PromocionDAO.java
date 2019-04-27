package com.upc.promocines.dao;

import com.upc.promocines.entidades.Promocion;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

public interface PromocionDAO extends CrudRepository<Promocion, Long> {
    @Query("SELECT r FROM Promocion r INNER JOIN r.pelicula p WHERE r.estado=1 AND r.stock>0 AND p.id=:id")
    public Iterable<Promocion> listarPromociones(@Param("id") Long id);
}