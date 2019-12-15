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
            $authElement = $xmlData->auth;
            var_dump(AuthHelper::checkAuth($authElement));
            die;
            if(!AuthHelper::checkAuth($authElement)) {
                $response = $this->getAurhErrorResponse();
                return response($response, 200)->header('Content-type', 'application/xml');
            }

        } catch (Exception $e) {
            print_r($e->getMessage());
            $response = $this->getSyntaxErrorResponse();
            return response($response, 200)->header('Content-type', 'application/xml');
        }
    }

    private function getSyntaxErrorResponse()
    {
        $response = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request/>');
        $error = $response->addChild('error');
        $error->addAttribute('error', '1');
        $error->addAttribute('errormsg', 'authorization error');

        $response = $response->asXML();

        return $response;
    }

    private function getAurhErrorResponse()
    {

    }
}
