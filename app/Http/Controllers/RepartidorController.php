<?php

namespace App\Http\Controllers;

use App\Models\Repartidor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Models\TipoIdentificacion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepartidorController extends Controller
{
    /**
     * Muestra todos los Repartidores.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/repartidor",
     *     tags={"Repartidor"},
     *     summary="Muestra todos los Repartidores",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los Repartidores"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $Repartidores = Repartidor::with('tipo_identificacion:id,codename,nombre')->get();

        return response()->json([
            'data' => $Repartidores,
            'success' => true
        ]);
    }

    /**
     * Crear un nuevo Repartidor
     * @OA\Post (
     *     path="/api/repartidor",
     *     tags={"Repartidor"},
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

        $Repartidor = new Repartidor();
        $Repartidor->id_tipo_identificacion = $tipoIdentificacion->id;
        $Repartidor->identificacion = $request->identificacion;
        $Repartidor->nombre = $request->nombre;
        $Repartidor->email = $request->email;
        $Repartidor->celular = $request->celular;
        $Repartidor->save();

        $data = [
            'msg' => "Se ha creado el Repartidor correctamente",
            'Repartidor' => $Repartidor
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de un Repartidor
     * @OA\Get (
     *     path="/api/repartidor/{id}",
     *     tags={"Repartidor"},
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
    public function show(Repartidor $Repartidor)
    {
        return response()->json([
            'data' => $Repartidor,
            'success' => true
        ]);
    }


    /**
     * Actualizar un nuevo Repartidor
     * @OA\Put (
     *     path="/api/repartidor/{id}",
     *     tags={"Repartidor"},
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
    public function update(Request $request, Repartidor $Repartidor)
    {
        $tipoIdentificacion = TipoIdentificacion::findOrFail($request->id_tipo_identificacion);

        $Repartidor->id_tipo_identificacion = $tipoIdentificacion->id;
        $Repartidor->identificacion = $request->identificacion;
        $Repartidor->nombre = $request->nombre;
        $Repartidor->email = $request->email;
        $Repartidor->celular = $request->celular;
        $Repartidor->save();

        $data = [
            'msg' => "Se ha actualizado el Repartidor correctamente",
            'Repartidor' => $Repartidor
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar un Repartidor
     * @OA\Delete (
     *     path="/api/repartidor/{id}",
     *     tags={"Repartidor"},
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
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha eliminado el Repartidor correctamente", "Repartidor": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     * )
     */
    public function destroy(Repartidor $Repartidor)
    {
        $Repartidor->delete();

        $data = [
            'msg' => "Se ha eliminado el Repartidor correctamente",
            'Repartidor' => $Repartidor
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
