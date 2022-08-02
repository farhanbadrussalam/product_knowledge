<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'PT Kitoshindo',
            'template' => 'landing',
            'dataKeranjang' => array()
        );

        return view('landingpage', $data);
    }
}
