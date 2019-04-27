package com.upc.promocines.dao;

import com.upc.promocines.entidades.Usuario;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

public interface UsuarioDAO extends CrudRepository<Usuario, Long> {
    @Query("SELECT u FROM Usuario u WHERE u.estado=1 AND u.dni=:dni")
    public Usuario buscarUsuario(@Param("dni") String dni);

    @Query("SELECT u FROM Usuario u WHERE u.estado=1")
    public Iterable<Usuario> listarUsuarios();

    @Query("SELECT u FROM Usuario u WHERE u.estado=1 AND u.email=:email")
    public Usuario validarSesionUsuario1(@Param("email") String email);

    @Query("SELECT u FROM Usuario u WHERE u.estado=1 AND u.email=:email AND u.contrasena=:contrasena")
    public Usuario validarSesionUsuario2(@Param("email") String email, @Param("contrasena") String contrasena);
}