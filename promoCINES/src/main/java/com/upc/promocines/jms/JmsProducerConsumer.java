package com.upc.promocines.jms;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.stereotype.Component;

import java.util.UUID;

@Component
public class JmsProducerConsumer {
    @Autowired
    private JmsTemplate jmsTemplate;

    @Value("${jms.cola.envio}")
    String destinationQueue;

    @Value("${jms.cola.respuesta}")
    String responseQueue;

    public void enviarRecibir(String msg) {
        String id = UUID.randomUUID().toString();
        jmsTemplate.convertAndSend(destinationQueue, msg, m -> {
            m.setJMSCorrelationID(id);
            return m;
        });
        System.out.println("PromoCINES: Enviando " + msg);
        System.out.println("PromoCINES: Enviando con CorrID - " + id);

        String responseMessage = (String) jmsTemplate.receiveSelectedAndConvert(responseQueue, "JMSCorrelationID='" + id + "'");
        System.out.println("CINEPLANET: Respuesta " + responseMessage);
        System.out.println("CINEPLANET: Respuesta con CorrID - " + id);
    }
}