<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $user = Auth::user();
        $users = User::all();
        return view('home', compact('user','users'));
    }

    public function store(Request $request, User $user) {

        $user->name = $request->name;
        $user->rfc = $request->rfc;
        $user->phone = $request->phone;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            return response()->json(['status' => 'success', 'msg' => 'Datos guardados', 'reload' => true],200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Ocurrio un error al guardar los datos'],200);
        }
    }
}
