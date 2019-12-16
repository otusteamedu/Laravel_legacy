<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleXMLElement;
use Exception;
use App\Helpers\AuthHelper;

class RequestHandlerController extends Controller
{
    public function index(Request $request)
    {
        $rawRequestData = $request->getContent();
        try {
            $xmlData = new SimpleXMLElement($rawRequestData);
        } catch (Exception $e) {
            $response = $this->getSyntaxErrorResponse();
            return response($response, 200)->header('Content-type', 'application/xml');
        }

        $authElement = $xmlData->auth;

        if(!AuthHelper::checkAuth($authElement)) {
            $response = $this->getAurhErrorResponse();
            return response($response, 200)->header('Content-type', 'application/xml');
        }

        $requestName = $xmlData->getName();
        $controllerName = 'App\Http\Controllers\\'.ucfirst($requestName).'Controller';

        if(!class_exists($controllerName)){
            $response = $this->getIncorrectRequestErrorResponse();
            return response($response, 200)->header('Content-type', 'application/xml');
        }

        $controller = new $controllerName();
        return $controller->index($xmlData);
    }

    private function getSyntaxErrorResponse()
    {
        $response = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request/>');
        $error = $response->addChild('error');
        $error->addAttribute('error', '1');
        $error->addAttribute('errormsg', 'Syntax error');

        $response = $response->asXML();

        return $response;
    }

    private function getAurhErrorResponse()
    {
        $response = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request/>');
        $error = $response->addChild('error');
        $error->addAttribute('error', '2');
        $error->addAttribute('errormsg', 'authorization error');

        $response = $response->asXML();

        return $response;
    }

    private function getIncorrectRequestErrorResponse()
    {
        $response = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request/>');
        $error = $response->addChild('error');
        $error->addAttribute('error', '2');
        $error->addAttribute('errormsg', 'Incorrect request');

        $response = $response->asXML();

        return $response;
    }
}
