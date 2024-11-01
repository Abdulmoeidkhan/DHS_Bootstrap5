<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ForeignImageValidator;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class ProfileImageController extends Controller
{

    protected function toggleImageStatus($uid)
    {
        try {
            $imageExist = ForeignImageValidator::where('image_uid', $uid)->first();
            if ($imageExist) {
                return 124;
                $imgStatus = $imageExist->image_exist == 1 ? 0 : 1;
                ForeignImageValidator::where('image_uid', $imageExist->image_uid)->update(['image_exist' => $imgStatus]);
                return response()->json(['success' => true, 'requestStatus' => 'updated'], 200);
            } else {
                ForeignImageValidator::create(['image_uid' => $uid]);
                return response()->json(['success' => true, 'requestStatus' => 'created'], 200);
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return response()->json(['success' => false, 'requestStatus' => $exception->errorInfo[2]], 404);
            } else {
                return response()->json(['success' => false, 'requestStatus' => 'Not Update'], 404);
            }
        }
    }

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

    protected function imageDeleteBlobUpdate($file, $uid)
    {
        $imageBlob = $file;
        $oldImageDelete = Storage::disk('cloudinary')->delete('Images/' . $uid);
        $imgSaved = Storage::disk('cloudinary')->put('Images/profile/' . $uid . '.png', $imageBlob);
        return $imgSaved;
    }

    protected function imageBlobUpload($file, $uid)
    {
        $imageBlob = $file;
        $imgSaved = Storage::disk('cloudinary')->put('Images/' . $uid, $imageBlob);
        $imgSaved ?? ForeignImageValidator::create(['image_exist' => $uid]);
        return $imgSaved;
        // $imageBlob = $file;
        // $imgBlob = new ImageBlob();
        // $imgBlob->img_blob = $imageBlob;
        // $imgBlob->uid = $uid;
        // $imgSaved = $imgBlob->save();
        // return $imgSaved;
    }

    protected function imageBlobUpdate($file, $uid)
    {
        $imageBlob = $file;
        $updateImageBlob = Storage::disk('cloudinary')->exists($uid . '.png') ? $this->imageDeleteBlobUpdate($imageBlob, $uid) : $this->imageBlobUpload($file, $uid);
        return $updateImageBlob;
        // $imageBlob = $file;
        // $updateImageBlob = ImageBlob::where('uid', $uid)->first() ? ImageBlob::where('uid', $uid)->update(['img_blob' => $imageBlob]) : $this->imageBlobUpload($file, $uid);
        // return $updateImageBlob;
    }

    // protected function imageBlobUpload(Request $req)
    // {
    //     if ($req->savedpicture) {
    //         $imgBlob = new ImageBlob();
    //         $imageBlob = $req->savedpicture;
    //         $imgBlob->uid = $req->id;
    //         $imageAlreadyExist = ImageBlob::where('uid', $imgBlob->uid)->first();
    //         $imgBlob->img_blob = $imageBlob;
    //         $imgSaved = $imageAlreadyExist ? $this->imageBlobUpdate($imgBlob->img_blob, $imgBlob->uid) : $imgBlob->save();
    //         return $imgSaved ? redirect()->back()->with('message', 'Image Updated Successfully') : redirect()->back()->with('error', 'SomeThing Went Wrong');
    //     }
    //     else{
    //         return redirect()->back()->with('error', 'Please save and try to upload again');
    //     }
    // }

    // protected function imageBlobUpdate($file, $id)
    // {
    //     $imageBlob = $file;
    //     $updateImageBlob = ImageBlob::where('uid', $id)->first() ? ImageBlob::where('uid', $id)->update(['img_blob' => $imageBlob]) : $this->imageBlobUpload($file, $id);
    //     return $updateImageBlob ? redirect()->back()->with('message', 'Image Updated Successfully') : redirect()->back()->with('error', 'SomeThing Went Wrong');;
    // }

    // protected function imageBlobUpdate($file, $id)
    // {
    //     $imageBlob = $file;
    //     $updateImageBlob = ImageBlob::where('uid', $id)->first() ? ImageBlob::where('uid', $id)->update(['img_blob' => $imageBlob]) : $this->imageBlobUpload($file, $id);
    //     return $updateImageBlob;
    // }

    // public function uploadImage(Request $req)
    // {
    //     // Validate the request.

    //     $file = $req->file('image');

    //     // Convert the image to base64.
    //     $type = $file->extension();
    //     $base64Image = base64_encode(file_get_contents($file->getRealPath()));
    //     $base64 = 'data:image/' . $type . ';base64,' . $base64Image;

    //     // Store the base64 image in the database.

    //     $image = new Image();
    //     $image->base64_image = $base64;
    //     $image->uid = $req->id;

    //     if (Image::where('uid', $req->id)->first()) {
    //         Image::where('uid', $req->id)->update(['base64_image' => $base64]);
    //         return $this->hisOwnProfile($req->id) ? redirect()->back()->with('message', "Picture Has been updated") : redirect()->back()->with($req->id, "message", "Picture Has been updated");
    //         // redirect()->route('pages.profileUser', $req->id);
    //     } else {
    //         $image->save();
    //         return $this->hisOwnProfile($req->id) ? redirect()->back()->with('message', "Picture Has been updated") : redirect()->back()->with($req->id, "message", "Picture Has been updated");
    //         // return $this->hisOwnProfile($req->id) ? redirect()->route('pages.myProfile') : redirect()->route('pages.profileUser', $req->id);
    //         // return $this->hisOwnProfile($req->id) ? redirect()->route('pages.myProfile') : redirect()->route('pages.profileUser', $req->id);
    //     }

    //     // return $filename;
    //     // $path = 'myfolder/myimage.png';
    //     // $type = pathinfo($path, PATHINFO_EXTENSION);
    //     // $data = file_get_contents($path);

    // }

    public function updateImageStatus(Request $req, $uid)
    {
        $data = $this->toggleImageStatus($uid);
        return $data;
    }
}
