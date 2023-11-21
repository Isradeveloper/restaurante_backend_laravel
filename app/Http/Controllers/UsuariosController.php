<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UsuariosController extends Controller
{

    /**
     * Registrar un usuario
     * @OA\Post (
     *     path="/api/registrar/usuario",
     *     tags={"Usuarios"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="username",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="celular",
     *                          type="string"
     *                      ),
     *                     
     *                 ),
     *                  example={
     *                     "nombre": "Israel David Trujillo",
     *                     "username": "itrujill",
     *                     "email": "itrujill@cuc.edu.co",
     *                     "password": "12345678",
     *                     "celular": "3023691487",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          
     *      ),
     *     
     * )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|max:255",
            "username" => "required|string|unique:usuario",
            "email" => "required|string|email|unique:usuario",
            "password" => "required|string|min:8",
            "celular" => "required|string",
        ]);

        if ($validator->fails()) {
            return response()->json(["data"=> ["error" => $validator->errors()], "success"=> false], 400);
        }

        $input = $request->all();
        $input["password"] = Hash::make($input["password"]);
        $input["nombre"] = $request->input("nombre");
        $user = User::create($input);

        return response()->json(["data"=> ["user" => $user, "msg" => "Usuario creado correctamente"], "success"=> true], 201);
    }


    /**
     * Login de usuario
     * @OA\Post (
     *     path="/api/login",
     *     tags={"Usuarios"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="username",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      ),
     *                 ),
     *                  example={
     *                     "username": "itrujill",
     *                     "password": "12345678",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success Login",
     *          
     *      ),
     *     
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['data' => ['message' => 'Unauthorized'], 'success' => false], 401);
        }
        
        return response()->json(['data' => ['user' => $user], 'success' => true], 200);
    }
}
