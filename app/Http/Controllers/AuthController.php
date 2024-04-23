<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration.index');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'image' => 'sometimes|file|image|max:5000',
        ]);
        if ($request->hasFile('image')) {
            $filename = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $filename, 'public');
            $validatedData['image'] = "/storage/" . $path;
        }
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'image'=>$validatedData['image'],
                ]);

        Auth::login($user);

        return redirect('login');
    }

    public function showLoginForm()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('email',Auth::user()->email);
            $request->session()->put('name',Auth::user()->name);
            $request->session()->put('id',Auth::user()->id);
            $request->session()->put('image',Auth::user()->image);
            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('email','name','id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
