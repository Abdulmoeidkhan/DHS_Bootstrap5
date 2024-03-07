<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WishController extends Controller
{
    public function getWish($id = null)
    {
        $wishes = $id ? WishList::where('guest_uid', $id)->orWhere('wish_uid', $id)->orWhere('delegation_uid', $id)->get() : WishList::all();
        return $wishes;
    }

    public function setWish(Request $req)
    {
        $wish = new WishList();
        $wish->wish_uid = (string) Str::uuid();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $wish[$key] = $value;
            }
        }
        try {
            $savedWish = $wish->save();
            if ($savedWish) {
                return back()->with('message', "Wish Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
    public function deleteWish(Request $req)
    {
        try {
            $deleteWish = WishList::where('guest_uid', $req->id)->orWhere('wish_uid', $req->id)->orWhere('delegation_uid', $req->id)->delete();
            if ($deleteWish) {
                return back()->with('error', "Wish Deleted Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
}
