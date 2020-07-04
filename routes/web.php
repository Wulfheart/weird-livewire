<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('viz');
});

Route::post('visualize', function(Request $request){
    // TODO: Validate request
    $request->validate([
        'midi' => 'required',
        'colors' => 'min:2|required'
    ]);
    logger($request->all());
    $name = Uuid::uuid4()->toString() . '.mid';
    logger($name);
    Storage::putFileAs("temp", $request->midi, $name);
    $process = new Process(['brahms', '-i', storage_path('app/temp/'.$name), '-c', collect($request->colors)->transform(function($item, $key){
        return trim($item);
      })->join(',')]);
      $process->run();

// executes after the command finishes
if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}

    return $process->getOutput();
})->name('viz.post');
