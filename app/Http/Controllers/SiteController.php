<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\State;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function showWelcome()
    {
        $packages = Package::inRandomOrder()->take(3)->get(); // Assuming you have a Package model
        $states= State::all();
        return view('welcome', compact('packages','states'));
    }

}
