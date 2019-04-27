package com.upc.JMSCine.jms;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.jms.annotation.JmsListener;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.jms.support.JmsMessageHeaderAccessor;
import org.springframework.stereotype.Component;

@Component
public class JMSVenta {
    @Autowired
    private JmsTemplate jmsTemplate;
    private final Logger LOGGER = LoggerFactory.getLogger(this.getClass());

    @Value("${jms.cola.respuesta}")
    String destinationQueue;

    @JmsListener(destination="${jms.cola.envio}")
    public void miRespuesta(String mensajeJson, JmsMessageHeaderAccessor headerAccessor){
        LOGGER.debug("CINEPLANET: Recibido " + mensajeJson);
        String id = headerAccessor.getCorrelationId();
        System.out.println("CINEPLANET: CorrID - " + id);
        String nuevoMensaje = "Se realizo la compra de : " + mensajeJson + "!!!";
        System.out.println("CINEPLANET: Respondiendo " + nuevoMensaje);
        jmsTemplate.convertAndSend(destinationQueue, nuevoMensaje, m -> {
            m.setJMSCorrelationID(id);
            return m;
        });
    }
}