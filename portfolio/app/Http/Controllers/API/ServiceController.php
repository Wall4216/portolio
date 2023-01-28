<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function get_all_service()
    {
        $services = Service::orderBy('id', 'DESC')->get();
        return response()->json([
           'services' => $services,
        ], 200);

    }
}
