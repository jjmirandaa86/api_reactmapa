<?php
    //****************************************** 
    //Para devolver el formato de la respuesta
    function devuelveFormateado($tipoRespuesta, $datosRecibidos){
        if($tipoRespuesta=="JSON"){
            $datosDevueltos = json_encode($datosRecibidos);
        }
        if($tipoRespuesta=="XML"){
            $datosDevueltos = xmlrpc_encode($datosRecibidos);
        }
        return $datosDevueltos;
    }

    //****************************************** 
    //Obtener el codigo de error de la pagina Http
    function codigoErrorHttp($code = null){
        if ($code !== NULL) 
        {
            switch ($code) 
            {
                case 100: $text = 'Continue'; break;
                case 101: $text = 'Switching Protocols'; break;
                case 102: $text = 'Processing'; break; 
                case 200: $text = 'OK'; break;
                case 201: $text = 'Created'; break;
                case 202: $text = 'Accepted'; break;
                case 203: $text = 'Non-Authoritative Information'; break;
                case 204: $text = 'No Content'; break;
                case 205: $text = 'Reset Content'; break;
                case 206: $text = 'Partial Content'; break;
                case 207: $text = 'Multi-Status'; break;
                case 300: $text = 'Multiple Choices'; break;
                case 301: $text = 'Moved Permanently'; break;
                case 302: $text = 'Moved Temporarily'; break;
                case 303: $text = 'See Other'; break;
                case 304: $text = 'Not Modified'; break;
                case 305: $text = 'Use Proxy'; break;
                case 306: $text = 'Unused'; break;
                case 307: $text = 'Temporary Redirect'; break;
                case 400: $text = 'Bad Request'; break;
                case 401: $text = 'Unauthorized'; break;
                case 402: $text = 'Payment Required'; break;
                case 403: $text = 'Forbidden'; break;
                case 404: $text = 'Not Found'; break;
                case 405: $text = 'Method Not Allowed'; break;
                case 406: $text = 'Not Acceptable'; break;
                case 407: $text = 'Proxy Authentication Required'; break;
                case 408: $text = 'Request Time-out'; break;
                case 409: $text = 'Conflict'; break;
                case 410: $text = 'Gone'; break;
                case 411: $text = 'Length Required'; break;
                case 412: $text = 'Precondition Failed'; break;
                case 413: $text = 'Request Entity Too Large'; break;
                case 414: $text = 'Request-URI Too Large'; break;
                case 415: $text = 'Unsupported Media Type'; break;
                case 416: $text = 'Requested Range Not Satisfiable'; break;
                case 417: $text = 'Expectation Failed'; break;
                case 418: $text = 'I am a teapot'; break;
                case 419: $text = 'Authentication Timeout'; break;
                case 420: $text = 'Enhance Your Calm'; break;
                case 422: $text = 'Unprocessable Entity'; break;
                case 423: $text = 'Locked'; break;
                case 424: $text = 'Failed Dependency'; break;
                case 425: $text = 'Unordered Collection'; break;
                case 426: $text = 'Upgrade Required'; break;
                case 428: $text = 'Precondition Required'; break;
                case 429: $text = 'Too Many Requests'; break;
                case 431: $text = 'Request Header Fields Too Large'; break;
                case 444: $text = 'No Response'; break;
                case 449: $text = 'Retry With'; break;
                case 450: $text = 'Blocked by Windows Parental Controls'; break;
                case 451: $text = 'Unavailable For Legal Reasons'; break;
                case 494: $text = 'Request Header Too Large'; break;
                case 495: $text = 'Cert Error'; break;
                case 496: $text = 'No Cert'; break;
                case 497: $text = 'HTTP to HTTPS'; break;
                case 499: $text = 'Client Closed Request'; break;
                case 500: $text = 'Internal Server Error'; break;
                case 501: $text = 'Not Implemented'; break;
                case 502: $text = 'Bad Gateway'; break;
                case 503: $text = 'Service Unavailable'; break;
                case 504: $text = 'Gateway Time-out'; break;
                case 505: $text = 'HTTP Version not supported'; break;
                case 506: $text = 'Variant Also Negotiates'; break;
                case 507: $text = 'Insufficient Storage'; break;
                case 508: $text = 'Loop Detected'; break;
                case 509: $text = 'Bandwidth Limit Exceeded'; break;
                case 510: $text = 'Not Extended'; break;
                case 511: $text = 'Network Authentication Required'; break;
                case 598: $text = 'Network read timeout error'; break;
                case 599: $text = 'Network connect timeout error'; break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                break;
            }
            return $text;
        }else{
            return "No puede ser nulo";
        }
    }

    //****************************************** 
    //setea el mensaje que se envia al usuario 
    //CASE MENSAJE_URL_NEXT_PREVIOS es para envio de respuesta con paginas de anterior y siguiente
    //DEFAULT No se envia este datos de paginas al cliente
    function seteaMensaje($tipo, $clase, $cantidad, $comodin1 = "", $comodin2 = "", $mensaje, $codigoHttp, $registros){
        switch($tipo)
        {
            case "MENSAJE_URL_NEXT_PREVIOS": 
                $respuesta = array(  
                    "Clase" => $clase, 
                    "Cantidad" => $cantidad,
                    "urlSiguiente" => $comodin1,
                    "urlAnterior" => $comodin2,
                    "mensaje" => $mensaje,
                    "codigoHttp" => $codigoHttp,
                    "mensajeHttp" => codigoErrorHttp($codigoHttp),
                    "registros" => $registros
                );
                break;

            case "MENSAJE_GRAFICO": 
                $respuesta = array(  
                    "Clase" => $clase, 
                    "Cantidad" => $cantidad,
                    "Minimo" => $comodin1,
                    "Maximo" => $comodin2,
                    "mensaje" => $mensaje,
                    "codigoHttp" => $codigoHttp,
                    "mensajeHttp" => codigoErrorHttp($codigoHttp),
                    "registros" => $registros
                );
                break;

            default:
                $respuesta = array(  
                    "Clase" => $clase, 
                    "Cantidad" => $cantidad,
                    "mensaje" => $mensaje,
                    "codigoHttp" => $codigoHttp,
                    "mensajeHttp" => codigoErrorHttp($codigoHttp),
                    "registros" => $registros
                );
                break;
        }
        return $respuesta;
    }

    //****************************************** 
    //Devuelve el metodo solicitado por el usuario GET | POST | PUT | DELETE
    function devuelveTipoPeticion(){ 
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    //****************************************** 
    //Devuelve el Servidor que se esta accediendo con el puerto.
    function devuelveUrlServidor(){ // localhost:8888
        return strtolower($_SERVER['HTTP_HOST']);
    }

    //****************************************** 
    //Devuelve la pagina que solicito el usuario
    function devuelvePaginaSolicitada(){ //   /reactmapa/api/usuario.php
        return strtolower($_SERVER['REQUEST_URI']); 
    }

    //****************************************** 
    //Descompone la pagina solicitada y guarda los parametros para enviar a dicha solicitud
    function devuelveDatoUrl($urlPage){
        
        $urlPageArray = explode("/", $urlPage);
        $entidad = $urlPageArray[3];
        //echo $entidad . "\n";
        $metodo = $urlPageArray[4];
        //echo $metodo . "\n";
        
        $dato = $urlPageArray[5];
        $parametroUrlDato = 0;
        if(strpos($dato, "=")>0){
            $parametroUrlDato = intval(substr($dato, strpos($dato, "=")+1, 100));
            if ($parametroUrlDato < 0){
                $parametroUrlDato = 0;
            }
            $dato = substr($dato, 0, strpos($dato, "="));
        }
        //echo $parametroUrlDato . "\n";
        $parametroUrl = "";
        if(strpos($dato, "?")>0){
            $parametroUrl = substr($dato, strpos($dato, "?")+1, 100);
            $dato = substr($dato, 0, strpos($dato, "?"));
        }
        //echo $parametroUrl . "\n";
        //echo $dato;
        
        return [$entidad, $metodo, $dato, $parametroUrl, $parametroUrlDato];
    }

    
    //****************************************** 
    //Mostrar Mensaje la Url de la Pagina 
    function devuelvePaginaSolicitadaSinDatosGet($valorUrl){ 
        if (strpos(devuelvePaginaSolicitada(), "?")){
            $dato = devuelvePaginaSolicitada();
            if(strpos($dato, "=")>0){
                $dato = substr($dato, 0, strpos($dato, "="));
            }
            $valorUrl = devuelveUrlServidor() . $dato . "=" . $valorUrl;
        }else{
            $valorUrl = devuelveUrlServidor() . devuelvePaginaSolicitada() . "?offset=" . $valorUrl;
        }
        return $valorUrl; 
    }

    //****************************************** 
    //Mostrar Mensaje de pagina siguiente 
    function devuelveUrlSiguiente($limite_resgistros, $limiteInicio, $cantidadTotalRegistros){
        $urlNext = null;
        if ($cantidadTotalRegistros > $limiteInicio &&                     
            $limiteInicio + $limite_resgistros < $cantidadTotalRegistros){  
            $urlNext = devuelvePaginaSolicitadaSinDatosGet($limiteInicio + $limite_resgistros);
        }
        return $urlNext;
    }

    //****************************************** 
    //Mostrar Mensaje de pagina anterior 
    function devuelveUrlAnterior($limite_resgistros, $limiteInicio){
        $urlPrevios = null;
        if ($limiteInicio != 0){  
            $urlPrevios = devuelvePaginaSolicitadaSinDatosGet($limiteInicio - $limite_resgistros);
        }
        return $urlPrevios;
    }
    

?>