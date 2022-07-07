<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class MonitorController extends Controller
{
    public function __invoke()
    {
        $nbPages = 20;
        $time_start = microtime(true);

        Http::pool(function (Pool $pool) use ($nbPages){
            return collect()
                ->range(1,$nbPages)
                ->map(fn ($page) => $pool->get("https://fontawesome.com/search?p=" . $page));
        });

        return response("Tempo de execução para realizar um get em {$nbPages} páginas do FontAwesome: ".microtime(true) - $time_start);
    }
}
