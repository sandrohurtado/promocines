package com.upc.promocines.negocio;

import com.upc.promocines.dao.PeliculaDAO;
import com.upc.promocines.dao.PromocionDAO;
import com.upc.promocines.dao.UsuarioDAO;
import com.upc.promocines.entidades.Pelicula;
import com.upc.promocines.entidades.Promocion;
import com.upc.promocines.entidades.Usuario;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class Negocio {
    @Autowired
    private UsuarioDAO usuarioDAO;

    @Autowired
    private PeliculaDAO peliculaDAO;

    @Autowired
    private PromocionDAO promocionDAO;

    public Usuario registrarUsuario(Usuario usuario) { return usuarioDAO.save(usuario); }

    public List<Usuario> listarUsuarios() {
        List<Usuario> usuarios = (List<Usuario>)usuarioDAO.listarUsuarios();
        return usuarios;
    }

    public Usuario validarSesionUsuario1(Usuario usuario) {
        Usuario usuario1 = usuarioDAO.validarSesionUsuario1(usuario.getEmail());
        return usuario1;
    }

    public Usuario validarSesionUsuario2(Usuario usuario) {
        Usuario usuario2 = usuarioDAO.validarSesionUsuario2(usuario.getEmail(), usuario.getContrasena());
        return usuario2;
    }

    public Usuario eliminarUsuario(Long id) {
        Usuario usuario = usuarioDAO.findById(id).get();
        usuario.setEstado(0);
        return usuarioDAO.save(usuario);
    }

    public Pelicula registrarPelicula(Pelicula pelicula) {
        return peliculaDAO.save(pelicula);
    }

    public Pelicula eliminarPelicula(Long id) {
        Pelicula pelicula = peliculaDAO.findById(id).get();
        pelicula.setEstado(0);
        return peliculaDAO.save(pelicula);
    }

    public List<Pelicula> listarPeliculas() {
        List<Pelicula> lisPeliculas = (List<Pelicula>) peliculaDAO.listarPeliculas();
        return lisPeliculas;
    }

    public Pelicula buscarPelicula(Long id) {
        Pelicula pelicula = peliculaDAO.findById(id).get();
        return pelicula;
    }

    public Pelicula obtenerPelicula(Long codigo){
        Promocion promocion = promocionDAO.findById(codigo).get();
        return promocion.getPelicula();
    }

    public Promocion registrarPromocion(Long id, Promocion promocion) {
        Pelicula pelicula = peliculaDAO.findById(id).get();
        if (promocion!=null) {
            promocion.setPelicula(pelicula);
            promocion.setEstado(1);
            return promocionDAO.save(promocion);
        } else {
            return null;
        }
    }

    public Promocion buscarPromocion(Long codigo) {
        Promocion promocion = promocionDAO.findById(codigo).get();
        return promocion;
    }

    public Promocion eliminarPromocion(Long id, Long codigo) {
        Pelicula pelicula = peliculaDAO.findById(id).get();
        Promocion promocion = promocionDAO.findById(codigo).get();
        if (promocion!=null) {
            promocion.setPelicula(pelicula);
            promocion.setEstado(0);
            return promocionDAO.save(promocion);
        } else {
            return null;
        }
    }

    public List<Promocion> listarPromocionesPelicula(Long id) {
        List<Promocion> lisPromociones = (List<Promocion>) promocionDAO.listarPromociones(id);
        return lisPromociones;
    }

    public Promocion actualizarPromocion(Long id, Long codigo) {
        Pelicula pelicula = peliculaDAO.findById(id).get();
        Promocion promocion = promocionDAO.findById(codigo).get();
        if (promocion!=null) {
            promocion.setPelicula(pelicula);
            promocion.setStock(promocion.getStock()-1);
            promocion.setVendidas(promocion.getVendidas()+1);
            if (promocion.getStock()==0) {
                promocion.setEstado(0);
            }
            return promocionDAO.save(promocion);
        } else {
            return null;
        }
    }
}