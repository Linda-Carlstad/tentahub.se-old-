<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperController extends Controller
{
    public function __construct()
    {
       $this->middleware( 'super' );
    }
}
