<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ProfileImageController extends Controller
{
    public function uploadImage(Request $req)
    {
        // Validate the request.

        $file = $req->file('image');

        // Convert the image to base64.
        $type = $file->extension();
        $base64Image = base64_encode(file_get_contents($file->getRealPath()));
        $base64 = 'data:image/' . $type . ';base64,' . $base64Image;

        // Store the base64 image in the database.

        $image = new Image();
        $image->base64_image = $base64;
        $image->uid = $req->id;


        if (Image::where('uid', $req->id)->first()) {
            Image::where('uid', $req->id)->update(['base64_image' => $base64]);
            return redirect()->route('pages.userProfile', $req->id);
        } else {
            $image->save();
            return redirect()->route('pages.userProfile', $req->id);
        }

        // return $filename;
        // $path = 'myfolder/myimage.png';
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        // $data = file_get_contents($path);

    }
}
