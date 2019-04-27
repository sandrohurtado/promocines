package com.upc.promocines;

import com.upc.promocines.entidades.Pelicula;
import com.upc.promocines.entidades.Promocion;
import com.upc.promocines.entidades.Usuario;
import com.upc.promocines.negocio.Negocio;
import org.junit.Assert;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

import java.util.List;

@RunWith(SpringRunner.class)
@SpringBootTest
public class PromocinesApplicationTests {
	@Autowired
	private Negocio negocio;

	@Test
	public void testRegistrarUsuario() {
		Usuario usuario = new Usuario();
		usuario.setDni("43206776");
		usuario.setNombres("Sandro");
		usuario.setApellidos("Hurtado");
		usuario.setEmail("shurtado21@gmail.com");
		usuario.setContrasena("123456");
		usuario.setTipo("A");
		usuario.setEstado(1);
		negocio.registrarUsuario(usuario);
	}

	@Test
	public void testListarUsuarios() {
		List<Usuario> usuarios = negocio.listarUsuarios();
		for (Usuario usuario:usuarios) {
			System.out.println(usuario.getDni() + "|" + usuario.getNombres() + "|" + usuario.getApellidos());
		}
		Assert.assertNotNull(usuarios);
	}

	@Test
	public void testvalidarSesionUsuario1() {
		Usuario usuario = new Usuario();
		usuario.setEmail("shurtado21@gmail.com");
		Usuario usuario1 = negocio.validarSesionUsuario1(usuario);
		Assert.assertNotNull(usuario1);
	}

	@Test
	public void testvalidarSesionUsuario2() {
		Usuario usuario = new Usuario();
		usuario.setEmail("shurtado21@gmail.com");
		usuario.setContrasena("123456");
		Usuario usuario1 = negocio.validarSesionUsuario2(usuario);
		Assert.assertNotNull(usuario1);
	}

	@Test
	public void testRegistrarPelicula() {
		/*
		Pelicula pelicula1 = new Pelicula();
		pelicula1.setTitulo("Glass");
		pelicula1.setSinopsis("Continuando desde donde lo dejó “Fragmentado“, “Glass” sigue los pasos de David Dunn (Bruce Willis) en su búsqueda de la figura superhumana de “La Bestia”.");
		pelicula1.setAnoEstreno("2019");
		pelicula1.setGenero("Acción, Ciencia ficción, Drama, Fantasía, Misterio, Suspenso");
		pelicula1.setClasificacion("PG-13");
		pelicula1.setDirector("M. Night Shyamalan");
		pelicula1.setReparto("Bruce Willis, James McAvoy, Samuel L. Jackson");
		pelicula1.setEstado(1);
		negocio.registrarPelicula(pelicula1);
		*/

		/**/
		Pelicula pelicula2 = new Pelicula();
		pelicula2.setTitulo("Cómo entrenar a tu dragón 3");
		pelicula2.setSinopsis("Lo que comenzó como la inesperada amistad entre un joven vikingo y un temible dragón Furia Nocturna se ha convertido en una épica trilogía que ha recorrido sus vidas.");
		pelicula2.setAnoEstreno("2019");
		pelicula2.setGenero("Animación, Aventura, Familia");
		pelicula2.setClasificacion("PG");
		pelicula2.setDirector("Dean DeBlois");
		pelicula2.setReparto("America Ferrera, F. Murray Abraham, Jay Baruchel");
		pelicula2.setEstado(1);
		negocio.registrarPelicula(pelicula2);

		/*
		Pelicula pelicula3 = new Pelicula();
		pelicula3.setTitulo("Animales Fantásticos: Los crímenes de Grindelwald");
		pelicula3.setSinopsis("Cumpliendo con su amenaza, Grindelwald escapa de su custodia y ha comenzado a reunir seguidores, la mayoría de los cuales no sospechan sus verdaderas intenciones: alzar a los magos purasangre para reinar sobre todas las criaturas no mágicas.");
		pelicula3.setAnoEstreno("2018");
		pelicula3.setGenero("Aventura, Familia, Fantasía");
		pelicula3.setClasificacion("PG");
		pelicula3.setDirector("David Yates");
		pelicula3.setReparto("Dan Fogler, Eddie Redmayne, Katherine Waterston, Johnny Depp");
		pelicula3.setEstado(1);
		negocio.registrarPelicula(pelicula3);
		*/
	}

	@Test
	public void testListarPeliculas() {
		List<Pelicula> peliculas = (List<Pelicula>) negocio.listarPeliculas();
		for (Pelicula pelicula:peliculas) {
			System.out.println(pelicula.getTitulo() + "|" + pelicula.getDirector() + "|" + pelicula.getReparto());
		}
		Assert.assertNotNull(peliculas);
	}

	@Test
	public void testRegistrarPromocion() {
		Promocion promocion1 = new Promocion();
		promocion1.setIniVigencia("2019-04-26");
		promocion1.setFinVigencia("2019-04-30");
		promocion1.setDescripcion("Llévate una(1) entrada con un 10% de descuento.");
		promocion1.setDescuento(10.00);
		promocion1.setCantidad(1);
		promocion1.setStock(50);
		promocion1.setVendidas(0);
		promocion1.setEstado(1);
		Promocion p1 = negocio.registrarPromocion((long)1, promocion1);

		Promocion promocion2 = new Promocion();
		promocion2.setIniVigencia("2019-04-26");
		promocion2.setFinVigencia("2019-04-30");
		promocion2.setDescripcion("Llévate dos(2) entradas con un 20% de descuento.");
		promocion2.setDescuento(20.00);
		promocion2.setCantidad(2);
		promocion2.setStock(30);
		promocion2.setVendidas(0);
		promocion2.setEstado(1);
		Promocion p2 = negocio.registrarPromocion((long)1, promocion2);

		Promocion promocion3 = new Promocion();
		promocion3.setIniVigencia("2019-04-26");
		promocion3.setFinVigencia("2019-05-10");
		promocion3.setDescripcion("Llévate tres(3) entradas con un 30% de descuento.");
		promocion3.setDescuento(30.00);
		promocion3.setCantidad(3);
		promocion3.setStock(10);
		promocion3.setVendidas(0);
		promocion3.setEstado(1);
		Promocion p3 = negocio.registrarPromocion((long)1, promocion3);
	}

	@Test
	public void testListarPromocionesPelicula() {
		List<Promocion> promociones = (List<Promocion>) negocio.listarPromocionesPelicula((long)1);
		for (Promocion promocion:promociones) {
			System.out.println(promocion.getDescripcion() + "|" + promocion.getIniVigencia() + "|" + promocion.getFinVigencia());
		}
		Assert.assertNotNull(promociones);
	}
}