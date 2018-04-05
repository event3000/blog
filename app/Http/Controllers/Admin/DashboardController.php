<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // создаем новый акшэн
    public function index()
    {	
    	//dd('1');		
    	return view('admin.dashboard'); 
    }
}
