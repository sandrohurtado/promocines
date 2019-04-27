<?php
  function registrar ($servicio, $datos, $id) {
    global $conf;
    
    // Validar Parametros
    if ( isset($servicio) && trim($servicio)!="" ) {
      $servicio = trim($servicio);
      
      if ( in_array($servicio, $conf['servicio']) ) {
      
        //API URL
        if ( isset($id) && trim($id)!="" ) {
          $url = trim($conf['srv_host']).'/api/'.$servicio.'/'.$id;
        } else {
          $url = trim($conf['srv_host']).'/api/'.$servicio;
        }
        
        // Validar Array de Datos
        if ( is_array($datos) ) {
        
          //Create a new cURL resource
          $ch = curl_init($url);

          //setup request to send json via POST
          $jsonDataEncoded = str_replace('}}', '}]}', str_replace(':{', ':[{', json_encode($datos)));
  
          //Tell cURL that we want to send a POST request.
          curl_setopt($ch, CURLOPT_POST, true);

          //Attach encoded JSON string to the POST fields
          curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

          //Set the content type to application/json
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

          //Return response instead of outputting
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          //Execute the POST request
          $result = json_decode(curl_exec($ch), true);

          //Close cURL resource
          curl_close($ch);
          
          //Request
          return $result;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  
  function listar ($servicio, $id) {
    global $conf;
    
    // Validar Parametros
    if ( isset($servicio) && trim($servicio)!="" ) {
      $servicio = trim($servicio);
      
      if ( in_array($servicio, $conf['servicio'])) {
      
        //API URL
        if ( isset($id) && trim($id)!="" ) {
          $url = trim($conf['srv_host']).'/api/'.$servicio.'/'.$id;
        } else {
          $url = trim($conf['srv_host']).'/api/'.$servicio;
        }
        
        //Execute the GET request
        $result = json_decode(file_get_contents($url), true);
        
        //Request
        if ( in_array('Internal Server Error', $result) ) {
          return false;
        } else {
          return $result;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  
  function eliminar ($servicio, $id1, $id2) {
    global $conf;
    
    // Validar Parametros
    if ( isset($servicio) && trim($servicio)!="" ) {
      $servicio = trim($servicio);
      
      if ( in_array($servicio, $conf['servicio'])) {
      
        if ( isset($id1) && trim($id1)!="" ) {
      
          //API URL
          if ( isset($id2) && trim($id2)!="" ) {
            $url = trim($conf['srv_host']).'/api/'.$servicio.'/'.$id1.'/'.$id2;
          } else {
            $url = trim($conf['srv_host']).'/api/'.$servicio.'/'.$id1;
          }
        
          //Execute the GET request
          $result = json_decode(file_get_contents($url), true);
          
          //Request
          return $result;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
?>
