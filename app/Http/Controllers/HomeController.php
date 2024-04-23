<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();//Get Current logged User
        $name = $request->session()->get('name');
       

        $employee = $user->employees()->paginate(5);

        // Pass the session data to the home view
        return view('admin.index', ['name' => $name,'employee'=>$employee]);
    }
    public function show(Request $request)
    {
        $name = $request->session()->get('name');
        $email = $request->session()->get('email');
        return view('admin.show', ['name' => $name, 'email' => $email]);
    }
}