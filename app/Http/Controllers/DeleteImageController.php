<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $image = Image::where('filename', $request->filename)->first();

        $path = $image->path;
        Storage::deleteDirectory($path);
        $image->delete();
    }
}
