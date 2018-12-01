<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}


//  Laravel From Scratch  - Traversy Media Part 1-12  - 3 june 2017 published
//  https://www.youtube.com/watch?v=quiUytHXutM&index=11&list=PLillGF-RfqbYhQsN5WMXy6VsDMKGadrJ-