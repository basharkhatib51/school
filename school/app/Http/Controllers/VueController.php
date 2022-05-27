<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class VueController extends Controller
{
    public function __invoke()
    {
        return view('vue');
    }
}
