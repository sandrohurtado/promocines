package com.upc.promocines.rest;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.upc.promocines.entidades.Pelicula;
import com.upc.promocines.jms.JmsProducerConsumer;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api")
public class JmsREST {
    @Autowired
    private JmsProducerConsumer jmsProducerConsumer;

    @PostMapping("/comprar")
    public Pelicula comprar(@RequestBody Pelicula pelicula) {
        ObjectMapper mapper = new ObjectMapper();
        String jsonString=null;
        try {
            jsonString = mapper.writeValueAsString(pelicula);
            jmsProducerConsumer.enviarRecibir(jsonString);
            pelicula.setEstado(2);
        } catch (JsonProcessingException e) {
            e.printStackTrace();
            pelicula.setEstado(3);
        }
        return pelicula;
    }
}