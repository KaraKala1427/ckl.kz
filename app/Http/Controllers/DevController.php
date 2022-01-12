<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DevController extends Controller
{

    public function link(Request $request)
    {
        if ($request->get('key') !== '11155') {
            abort(403);
        }

        $output = new \Symfony\Component\Console\Output\BufferedOutput();
        $exitCode = \Artisan::call('storage:link', [], $output);
        dump($exitCode);
        dump($output);
        dump($output->fetch());

        return $exitCode;
    }
}
