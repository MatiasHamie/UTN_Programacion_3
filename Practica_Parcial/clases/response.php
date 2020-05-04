<?php

class Response{

    public static $respuesta;

    public static function JsendResponse($status, $data){
        self::$respuesta = new stdClass();
        self::$respuesta->status = $status;

        if ($status == "error") {
            self::$respuesta->message = $data;
        } else {
            self::$respuesta->data = $data;
        }

        return json_encode(self::$respuesta);
    }
}