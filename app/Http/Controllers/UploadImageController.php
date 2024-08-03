<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$request->hasFile('image')) {
            return response()->json(['message' => 'No image uploaded'], 400);
        }

        if (!Storage::exists('images')) {
            Storage::makeDirectory('images');
        }
        $image = $request->file('image');
        $folder = uniqid('image-');

        $path = 'images/' . $folder;
        $file = $image;
        $name = $image->getClientOriginalName();

        Storage::putFileAs($path, $file, $name);
        Image::create(['path' => $path, 'filename' => $name]);

        return response()->json(['message' => 'Image uploaded succesfully']);
    }
}
