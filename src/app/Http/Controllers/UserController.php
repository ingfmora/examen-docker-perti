<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function store (Request $request) {

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->rfc = $request->rfc;
        $user->notes = $request->notes;
        $user->password = Hash::make($request->password);
        $user->ip = \request()->getClientIp();

        if ($user->save()) {
            return response()->json(['status' => 'success', 'msg' => '¡Datos guardados!', 'reload' => false],200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Error al guardar los datos'],200);
        }
    }
}
