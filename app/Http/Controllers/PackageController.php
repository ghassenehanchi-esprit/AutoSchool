<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function showPackageView($state, $type)
    {
        // Query the database to find the package based on state and type
        $package = Package::where('state_id', $state)
            ->where('type', $type)
            ->first();

        if (!$package) {
            abort(404); // Package not found
        }

        // Compact the package data and pass it to the view
        return view('packages.show', compact('package'));
    }
    public function showStatePackages($id)
    {
        // Query the database to find all packages based on state
        $packages = Package::where('state_id', $id)->get();
        $state=State::find($id);
        if ($packages->isEmpty()) {
            abort(404); // No packages found for the state
        }

        // Compact the packages data and pass it to the view
        return view('packages.state', compact('packages','state'));
    }
    public function showProfile()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Compact the user data and pass it to the 'profile.show' view
        return view('profile.show', compact('user'));
    }


}
