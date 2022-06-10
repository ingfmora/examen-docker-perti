<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Exception;

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_ES.UTF-8');
setlocale(LC_TIME, 'spanish');

class ApiController extends Controller {

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','get','register','update']]);
    }

    /** Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }


    /** Obtener información de herramiento por medio de No. de serie.
     * Este valor puede ser enviado por medio del lector QR o escrito manualmente
     *
     * @return json
     */
    public function get(Request $request, User $user = NULL) {

        if (!$user) {
            $user = User::all();
        }
        return response()->json(['status' => 200, 'data' => $user->toArray()]);
    }

    public function store(Request $request){

        $user = new User();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->rfc = $request->rfc;
        $user->notes = $request->notes;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->ip = \request()->getClientIp();

        if ($user->save()) {
            return response()->json(['status' => 200, 'msg' => '¡Datos guardados!']);
        } else {
            return response()->json(['status' => 400, 'msg' => 'No se guardaron los datos']);
        }
    }


    public function update(Request $request, User $user){

        if (count($request->toArray()) <= 0) {
            return response()->json(['status' => 400, 'msg' => 'No se encontraron datos']);
        } else {
            if ($request->name) $user->name = $request->name;
            if ($request->phone) $user->phone = $request->phone;
            if ($request->rfc) $user->rfc = $request->rfc;
            if ($request->notes) $user->notes = $request->notes;
            if ($request->email) $user->email = $request->email;
            if ($request->password) $user->password = Hash::make($request->password);

            if ($user->save()) {
                return response()->json(['status' => 200, 'msg' => '¡Datos guardados!']);
            } else {
                return response()->json(['status' => 400, 'msg' => 'No se guardaron los datos']);
            }
        }

    }
}
