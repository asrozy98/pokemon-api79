<?php

namespace App\Interfaces;

interface ResponseInterface
{
    //2xx Success
    const Ok = [
        'status' => 'Ok',
        'code' => 200
    ];
    const Created = [
        'status' => 'Created',
        'code' => 201
    ];
    const NoContent = [
        'status' => 'No Content',
        'code' => 204
    ];

    //3xx Redirect
    const NotModified = [
        'status' => 'Not Modified',
        'code' => 304
    ];

    //4xx Client Error
    const BadRequest = [
        'status' => 'Bad Request',
        'code' => 400
    ];
    const Unauthorized = [ //Nedd Authentication
        'status' => 'Unauthorized',
        'code' => 401
    ];
    const Forbidden = [ //Not Authorize
        'status' => 'Forbidden',
        'code' => 403
    ];
    const NotFound = [
        'status' => 'Not Found',
        'code' => 404
    ];
    const NotAcceptable = [
        'status' => 'Not Acceptable',
        'code' => 406
    ];
    const Conflict = [
        'status' => 'Conflict',
        'code' => 409
    ];
    const ValidationError = [
        'status' => 'Validation Error',
        'code' => 417
    ];

    //5xx Server Error
    const InternalServerError = [
        'status' => 'Internal Server Error',
        'code' => 500
    ];
}
