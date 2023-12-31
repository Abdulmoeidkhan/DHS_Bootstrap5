<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileImageController extends Controller
{
    protected function hisOwnProfile($uid)
    {
        if ($uid == auth()->user()->uid) {
            $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
            $user->images = Image::where('uid', Auth::user()->uid)->first();
            session()->put('user', $user);
            return true;
        } else {
            return false;
        }
    }
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
            return $this->hisOwnProfile($req->id) ? back()->with('message', "Picture Has been updated") : back()->with($req->id, "message", "Picture Has been updated");
            // redirect()->route('pages.userProfile', $req->id);
        } else {
            $image->save();
            return $this->hisOwnProfile($req->id) ? back()->with('message', "Picture Has been updated") : back()->with($req->id, "message", "Picture Has been updated");
            // return $this->hisOwnProfile($req->id) ? redirect()->route('pages.myProfile') : redirect()->route('pages.userProfile', $req->id);
            // return $this->hisOwnProfile($req->id) ? redirect()->route('pages.myProfile') : redirect()->route('pages.userProfile', $req->id);
        }

        // return $filename;
        // $path = 'myfolder/myimage.png';
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        // $data = file_get_contents($path);

    }
}
