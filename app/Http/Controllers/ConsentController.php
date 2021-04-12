<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class ConsentController extends Controller
{
    public function client_consent()
    {
        $client = new Client();
    	$response = $client->request('GET', 'http://ushaurinode.mhealthkenya.org/api/terms');
    	$statusCode = $response->getStatusCode();
    	$body = $response->getBody()->getContents();

        dd($body);
    	return $body;
    }
}
