<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function render(){
        return view('pages.cars');
    }
    public function addCarRender()
    {
        return view('pages.addCar');
    }
    public function addDriverRender()
    {
        return view('pages.addDriver');
    }
}
