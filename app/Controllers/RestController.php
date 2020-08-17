<?php namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Headers"); 
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    die();
}
use CodeIgniter\RESTful\ResourceController;

class RestController extends ResourceController {
}