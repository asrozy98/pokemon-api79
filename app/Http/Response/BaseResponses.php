<?php

namespace App\Http\Response;

use App\Interfaces\ResponseInterface;

class BaseResponses
{
    protected static $code;
    protected static $responseStatus;
    protected static $response;
    protected static $d;

    private static function baseResponse()
    {
        switch (self::$code) {
            case 200:
                self::$responseStatus = ResponseInterface::Ok;
                break;

            case 201:
                self::$responseStatus = ResponseInterface::Created;
                break;

            case 204:
                self::$responseStatus = ResponseInterface::NoContent;
                break;

            case 304:
                self::$responseStatus = ResponseInterface::NotModified;
                break;

            case 400:
                self::$responseStatus = ResponseInterface::BadRequest;
                break;

            case 401:
                self::$responseStatus = ResponseInterface::Unauthorized;
                break;

            case 403:
                self::$responseStatus = ResponseInterface::Forbidden;
                break;

            case 404:
                self::$responseStatus = ResponseInterface::NotFound;
                break;

            case 406:
                self::$responseStatus = ResponseInterface::NotAcceptable;
                break;

            case 409:
                self::$responseStatus = ResponseInterface::Conflict;
                break;

            case 417:
                self::$responseStatus = ResponseInterface::ValidationError;
                break;

            case 500:
                self::$responseStatus = ResponseInterface::InternalServerError;
                break;

            default:
                break;
        }
    }

    public static function status($code, $data, $message = null)
    {
        self::$code = $code;
        self::baseResponse();

        self::$response['status'] =  self::$responseStatus['code'];
        self::$response['message'] = $message == null ? self::$responseStatus['status'] : $message;
        $data != null ? self::$response['data'] =  $data : null;

        return response()->json(self::$response, self::$code);
    }
}
