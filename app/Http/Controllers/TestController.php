<?php

namespace App\Http\Controllers;

use Illuminate\Queue\QueueManager;
use Illuminate\Routing\Controller;

class TestController extends Controller
{

    public function __invoke(QueueManager $queueManager)
    {
    }
}
