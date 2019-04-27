package com.upc.promocines.rest;

import com.upc.promocines.entidades.Pelicula;
import com.upc.promocines.entidades.Promocion;
import com.upc.promocines.entidades.Usuario;
import com.upc.promocines.negocio.Negocio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api")
public class ServicioREST {
    @Autowired
    private Negocio negocio;

    @PostMapping("/usuario-registrar")
    public Usuario registrarUsuario(@RequestBody Usuario usuario) { return  negocio.registrarUsuario(usuario); }

    @GetMapping("/usuario-eliminar/{id}")
    public Usuario eliminarUsuario(@PathVariable(value="id") Long id) { return negocio.eliminarUsuario(id); }

    @GetMapping("/usuarios")
    public List<Usuario> listarUsuarios() {
        List<Usuario> usuarios = (List<Usuario>) negocio.listarUsuarios();
        return usuarios;
    }

    @PostMapping("/usuario-validar-sesion1")
    public Usuario validarSesionUsuario1(@RequestBody Usuario usuario) { return negocio.validarSesionUsuario1(usuario); }

    @PostMapping("/usuario-validar-sesion2")
    public Usuario validarSesionUsuario2(@RequestBody Usuario usuario) { return negocio.validarSesionUsuario2(usuario); }

    @PostMapping("/pelicula-registrar")
    public Pelicula registrarPelicula(@RequestBody Pelicula pelicula) {
        return negocio.registrarPelicula(pelicula);
    }

    @GetMapping("/pelicula-eliminar/{id}")
    public Pelicula eliminarPelicula(@PathVariable(value="id") Long id) { return negocio.eliminarPelicula(id); }

    @GetMapping("/pelicula2/{codigo}")
    public Pelicula obtenerPelicula(@PathVariable(value="codigo") Long codigo) { return negocio.obtenerPelicula(codigo); }

    @GetMapping("/pelicula/{id}")
    public Pelicula buscarPelicula(@PathVariable(value="id") Long id) {
        return negocio.buscarPelicula(id);
    }

    @GetMapping("/peliculas")
    public List<Pelicula> listarPeliculas() {
        List<Pelicula> peliculas = (List<Pelicula>) negocio.listarPeliculas();
        return peliculas;
    }

    @PostMapping("/promocion-registrar/{id}")
    public Promocion registrarPromocion(@PathVariable(value="id") Long id, @RequestBody Promocion promocion) { return negocio.registrarPromocion(id, promocion); }

    @GetMapping("/promocion-eliminar/{id}/{codigo}")
    public Promocion eliminarPromocion(@PathVariable(value="id") Long id, @PathVariable(value="codigo") Long codigo) { return negocio.eliminarPromocion(id, codigo); }

    @GetMapping("/promocion/{codigo}")
    public Promocion buscarPromocion(@PathVariable(value="codigo") Long codigo) { return negocio.buscarPromocion(codigo); }

    @GetMapping("/promociones/{id}")
    public List<Promocion> listarPromocionesPelicula(@PathVariable(value="id") Long id) {
        List<Promocion> promociones = (List<Promocion>) negocio.listarPromocionesPelicula(id);
        return promociones;
    }

    @GetMapping("/promocion-actualizar/{id}/{codigo}")
    public Promocion actualizarPromocion(@PathVariable(value="id") Long id, @PathVariable(value="codigo") Long codigo) { return negocio.actualizarPromocion(id, codigo); }
}