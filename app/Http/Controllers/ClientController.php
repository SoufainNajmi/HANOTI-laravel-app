<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        // For client, show list of suppliers and products
        return view('client.dashboard');
    }
}
