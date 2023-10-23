<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vips;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddVipsController extends Controller
{
    public function addVips(Request $req)
    {
        $vip = new Vips();
        $vip->uid = (string) Str::uuid();
        $vip->rank = $req->vipRank;
        $vip->designation = $req->vipDesignation;
    }
}
