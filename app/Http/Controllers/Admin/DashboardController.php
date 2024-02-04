<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $countDataset = Dataset::all()->count();
        $countUser = User::where('role', 'user')->count();
        return view('admin.dashboard', compact(['countDataset', 'countUser']));
    }
}
