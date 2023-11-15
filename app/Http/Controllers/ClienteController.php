<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Models\TipoIdentificacion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClienteController extends Controller
{
    /**
     * Muestra todos los clientes.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/cliente",
     *     tags={"cliente"},
     *     summary="Muestra todos los clientes",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los clientes"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $clientes = Cliente::with('tipo_identificacion:id,codename,nombre')->get();

        return response()->json([
            'data' => $clientes,
            'success' => true
        ]);
    }

    /**
     * Crear un nuevo cliente
     * @OA\Post (
     *     path="/api/cliente",
     *     tags={"cliente"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id_tipo_identificacion",
     *                          type="integer"
     *                      ),
     * 
     *                      @OA\Property(
     *                          property="identificacion",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="celular",
     *                          type="string"
     *                      ),
     *                 ),
     *                  example={
     *                     "id_tipo_identificacion": 1,
     *                     "identificacion": "1242142",
     *                     "nombre":"Jhon Doe",
     *                     "email":"jdoe@gmail.com",
     *                     "celular":"122132425",
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
    public function store(Request $request)
    {
        $tipoIdentificacion = TipoIdentificacion::findOrFail($request->id_tipo_identificacion);

        $Cliente = new Cliente();
        $Cliente->id_tipo_identificacion = $tipoIdentificacion->id;
        $Cliente->identificacion = $request->identificacion;
        $Cliente->nombre = $request->nombre;
        $Cliente->email = $request->email;
        $Cliente->celular = $request->celular;
        $Cliente->save();

        $data = [
            'msg' => "Se ha creado el cliente correctamente",
            'cliente' => $Cliente
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de un cliente
     * @OA\Get (
     *     path="/api/cliente/{id}",
     *     tags={"cliente"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     
     *     ),
     *     
     * )
     */
    public function show(Cliente $Cliente)
    {
        return response()->json([
            'data' => $Cliente,
            'success' => true
        ]);
    }


    /**
     * Actualizar un nuevo cliente
     * @OA\Put (
     *     path="/api/cliente/{id}",
     *     tags={"cliente"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id_tipo_identificacion",
     *                          type="integer"
     *                      ),
     * 
     *                      @OA\Property(
     *                          property="identificacion",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="celular",
     *                          type="string"
     *                      ),
     *                 ),
     *                  example={
     *                     "id_tipo_identificacion": 1,
     *                     "identificacion": "1242142",
     *                     "nombre":"Jhon Doe",
     *                     "email":"jdoe@gmail.com",
     *                     "celular":"122132425",
     *                }
     *             )
     *         )
     *      ),
     *       @OA\Response(
     *          response=200,
     *          description="SUCCESS",
     *           
     *      ),
     * )
     */
    public function update(Request $request, Cliente $Cliente)
    {
        $tipoIdentificacion = TipoIdentificacion::findOrFail($request->id_tipo_identificacion);

        $Cliente->id_tipo_identificacion = $tipoIdentificacion->id;
        $Cliente->identificacion = $request->identificacion;
        $Cliente->nombre = $request->nombre;
        $Cliente->email = $request->email;
        $Cliente->celular = $request->celular;
        $Cliente->save();

        $data = [
            'msg' => "Se ha actualizado el cliente correctamente",
            'cliente' => $Cliente
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar un cliente
     * @OA\Delete (
     *     path="/api/cliente/{id}",
     *     tags={"cliente"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="SUCCESS",
     *           @OA\JsonContent(
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha eliminado el cliente correctamente", "cliente": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     * )
     */
    public function destroy(Cliente $Cliente)
    {
        $Cliente->delete();

        $data = [
            'msg' => "Se ha eliminado el cliente correctamente",
            'cliente' => $Cliente
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
