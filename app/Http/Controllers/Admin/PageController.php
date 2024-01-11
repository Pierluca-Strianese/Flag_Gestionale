<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\PageController;

class PageController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
}
