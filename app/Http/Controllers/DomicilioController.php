<?php

namespace App\Http\Controllers;

use App\Models\Domicilio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Models\CategoriaProducto;
use App\Models\EstadoDomicilio;
use App\Models\Repartidor;

class DomicilioController extends Controller
{
    /**
     * Muestra todos los domicilios.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/domicilio",
     *     tags={"domicilio"},
     *     summary="Muestra todos los domicilios",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los domicilios"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $domicilios = Domicilio::with('repartidor.tipo_identificacion', 'estado_domicilio')->get();

        return response()->json([
            'data' => $domicilios,
            'success' => true
        ]);
    }

    /**
     * Crear un nuevo domicilio
     * @OA\Post (
     *     path="/api/domicilio",
     *     tags={"domicilio"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id_repartidor",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="id_estado_domicilio",
     *                          type="integer"
     *                      ),
     * 
     *                      @OA\Property(
     *                          property="direccion",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="instrucciones_adicionales",
     *                          type="string"
     *                      ),
     *                     
     *                 ),
     *                  example={
     *                     "id_repartidor": 1,
     *                     "id_estado_domicilio": "1",
     *                     "direccion":"Calle 58 con carrera 45",
     *                     "instrucciones_adicionales":"Dejar en portería"
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
        $Repartidor = Repartidor::findOrFail($request->id_repartidor);
        $EstadoDomicilio = EstadoDomicilio::findOrFail($request->id_estado_domicilio);

        $Domicilio = new Domicilio();
        $Domicilio->id_repartidor = $Repartidor->id;
        $Domicilio->id_estado_domicilio = $EstadoDomicilio->id;
        $Domicilio->direccion = $request->direccion;
        $Domicilio->instrucciones_adicionales = $request->instrucciones_adicionales;
        $Domicilio->save();

        $data = [
            'msg' => "Se ha creado el domicilio correctamente",
            'domicilio' => $Domicilio
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de un domicilio
     * @OA\Get (
     *     path="/api/domicilio/{id}",
     *     tags={"domicilio"},
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
    public function show(Domicilio $Domicilio)
    {
        return response()->json([
            'data' => $Domicilio,
            'success' => true
        ]);
    }


    /**
     * Actualizar un nuevo domicilio
     * @OA\Put (
     *     path="/api/domicilio/{id}",
     *     tags={"domicilio"},
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
     *                          property="id_repartidor",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="id_estado_domicilio",
     *                          type="integer"
     *                      ),
     * 
     *                      @OA\Property(
     *                          property="direccion",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="instrucciones_adicionales",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "id_repartidor": 1,
     *                     "id_estado_domicilio": "1",
     *                     "direccion":"Calle 58 con carrera 45",
     *                     "instrucciones_adicionales":"Dejar en portería"
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
    public function update(Request $request, Domicilio $Domicilio)
    {
        $Repartidor = Repartidor::findOrFail($request->id_repartidor);
        $EstadoDomicilio = EstadoDomicilio::findOrFail($request->id_estado_domicilio);

        $Domicilio->id_repartidor = $Repartidor->id;
        $Domicilio->id_estado_domicilio = $EstadoDomicilio->id;
        $Domicilio->direccion = $request->direccion;
        $Domicilio->instrucciones_adicionales = $request->instrucciones_adicionales;
        $Domicilio->save();

        $data = [
            'msg' => "Se ha actualizado el domicilio correctamente",
            'domicilio' => $Domicilio
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar un domicilio
     * @OA\Delete (
     *     path="/api/domicilio/{id}",
     *     tags={"domicilio"},
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
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha eliminado el domicilio correctamente", "domicilio": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     * )
     */
    public function destroy(Domicilio $Domicilio)
    {
        $Domicilio->delete();

        $data = [
            'msg' => "Se ha eliminado el domicilio correctamente",
            'domicilio' => $Domicilio
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
