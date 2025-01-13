<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Script;
use Illuminate\Http\Request;

class DashboardController extends Controller

{
    
    public function index()
    {
        $drugs=Drug::all()->count();
        $scripts=Script::all()->count();
        return view('dashboard.dashboard',compact('drugs','scripts')); // Replace 'dashboard.dashboard' with the correct view path
    }


}
