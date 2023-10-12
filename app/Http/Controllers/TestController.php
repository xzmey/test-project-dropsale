<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class TestController extends Controller
{
    public function __invoke()
    {
        return 's';
    }
}
