<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //MUESTRA TODOS LOS USUARIOS ACTIVOS
    public function index()
    {
        $users = User::where('status', 1)
            ->get();
        
        return response()->json([
            'resp' => 1,
            'users' => $users
        ]);
    }

    //REGISTRO
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6', 
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->emergency_phone = $request->emergency_phone;
        $user->emergency_person = $request->emergency_person;
        $user->user_type = $request->user_type;

        if ($request->hasFile('img_avatar')) {
            if($user->img_avatar != null){
                if (Storage::exists('public/img/avatar' . $user->img_avatar)) {
                    Storage::delete('public/img/avatar' . $user->img_avatar);
                }
            }
            if($request->file('img_avatar')->isValid()) {
                $file = $request->file('img_avatar');
                $name = explode(' ', $request->name);
                $fileName = $name[0]. $name[1] . "_avatar." . $file->getClientOriginalExtension();
                $path = Storage::putFileAs('public/img/avatar', $file, $fileName);
                $user->img_avatar = $fileName;
            }
        }

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        //$user->api_token = Str::random(60);

        $user->save();

        return response()->json([
            'resp' => 1,
            'msg' => "Registro de usuario exitoso"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //ACTUALIZAR INFORMACIÓN DE UN USUARIO
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('phone')){
            $user->phone = $request->phone;
        }

        if($request->has('address')){
            $user->address = $request->address;
        }

        if($request->has('emergency_phone')){
            $user->emergency_phone = $request->emergency_phone;
        }

        if($request->has('emergency_person')){
            $user->emergency_person = $request->emergency_person;
        }
        
        if($request->has('user_type')){
            $user->user_type = $request->user_type;
        }

        if ($request->hasFile('img_avatar')) {
            if($user->img_avatar != null){
                if (Storage::exists('public/img/avatar' . $user->img_avatar)) {
                    Storage::delete('public/img/avatar' . $user->img_avatar);
                }
            }
            if($request->file('img_avatar')->isValid()) {
                $file = $request->file('img_avatar');
                $name = explode(' ', $request->name);
                $fileName = $name[0]. "_avatar." . $file->getClientOriginalExtension();
                $path = Storage::putFileAs('public/img/avatar', $file, $fileName);
                $user->img_avatar = $fileName;
            }
        }

        if($request->has('email')){
            $user->email = $request->email;
        }
        
        if($request->input('actual_password') && $request->input('password')){
            $msg = '';
            if (Hash::check($request['actual_password'], $user->password)) {
                $user->password = Hash::make($request['password']);         
            }else{
                $msg = 'La contraseña actual es incorrecta, verifica de nuevo';
            }
        }

        $user->save();
        
        return response()->json([
            'resp' => 1,
            'id_user' => $user->id,
            'message' => 'El usuario se actualizó correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //CAMBIAR ESTADO DE ACTIVO A INACTVO UN USUARIO
    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();

        return response()->json([
            'resp' => 1,
            'message' => 'El usuario se eliminó correctamente'
        ]);
    }

    //OBTENER TODOS LOS USUARIOS CON TIPO DE USUARIO PROFESOR
    public function getTeacher(){
        $user_teacher = User::where('user_type', 'Profesor')
            ->where('status', 1)
            ->get();

        return response()->json([
            'resp' => 1,
            'user_teacher' => $user_teacher
        ]);
    }

    //INICIO DE SESIÓN
    public function login(Request $request){
        
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email", "=", $request->email)->first();

        if(isset($user->id)){
            if($user->status == 1){
                if(Hash::check($request->password, $user->password)){
                    //Creación del token
                    $token = $user->createToken("auth_token")->plainTextToken;
                    
                    return response()->json([
                        "resp" => 1,
                        "message" => "¡Usuario logueado exitosamente!",
                        "access_token" => $token
                    ]);        
                }else{
                    return response()->json([
                        "resp" => 0,
                        "message" => "La password es incorrecta",
                    ], 404);    
                }
            }else{
                return response()->json([
                    'resp' => 0,
                    'message' => 'La cuenta ha sido eliminada, solicita que la activen'
                ]);
            }
        }else{
            return response()->json([
                "resp" => 0,
                "message" => "Usuario no registrado",
            ], 404);  
        }
    }

    //PERFIL DE USUARIO
    public function userProfile(){
        return response()->json([
            'resp' => 1,
            'message' => 'Perfil de usuario',
            'user' => Auth::user()
        ]);
    }

    //CIERRE DE SESIÓN
    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            'resp' => 1,
            'message' => 'Cierre de sesión'
        ]);
    }

    

}

