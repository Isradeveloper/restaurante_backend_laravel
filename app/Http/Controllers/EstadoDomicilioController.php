<?php

namespace App\Http\Controllers;

use App\Models\EstadoDomicilio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class EstadoDomicilioController extends Controller
{
    /**
     * Muestra todos los estados domicilio.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/estado_domicilio",
     *     tags={"estado_domicilio"},
     *     summary="Muestra todos los estados domicilio",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los estados domicilio"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $estados_domicilio = EstadoDomicilio::all();

        return response()->json([
            'data' => $estados_domicilio,
            'success' => true
        ]);
    }

    /**
     * Crear un nuevo estado domicilio
     * @OA\Post (
     *     path="/api/estado_domicilio",
     *     tags={"estado_domicilio"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="codename",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "nombre":"PENDIENTE",
     *                     "codename":"pendiente"
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
        $EstadoDomicilio = new EstadoDomicilio();
        $EstadoDomicilio->nombre = $request->nombre;
        $EstadoDomicilio->codename = $request->codename;
        $EstadoDomicilio->save();

        $data = [
            'msg' => "Se ha creado el estado domicilio correctamente",
            'estado_domicilio' => $EstadoDomicilio
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de un estado domicilio
     * @OA\Get (
     *     path="/api/estado_domicilio/{id}",
     *     tags={"estado_domicilio"},
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
    public function show(EstadoDomicilio $EstadoDomicilio)
    {
        return response()->json([
            'data' => $EstadoDomicilio,
            'success' => true
        ]);
    }


    /**
     * Actualizar un estado domicilio
     * @OA\Put (
     *     path="/api/estado_domicilio/{id}",
     *     tags={"estado_domicilio"},
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
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="codename",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "nombre":"PENDIENTE",
     *                     "codename":"pendiente"
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
    public function update(Request $request, EstadoDomicilio $EstadoDomicilio)
    {
        $EstadoDomicilio->nombre = $request->nombre;
        $EstadoDomicilio->codename = $request->codename;
        $EstadoDomicilio->save();

        $data = [
            'msg' => "Se ha actualizado el estado domicilio correctamente",
            'estado_domicilio' => $EstadoDomicilio
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar un estado domicilio
     * @OA\Delete (
     *     path="/api/estado_domicilio/{id}",
     *     tags={"estado_domicilio"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="SUCCESS",
     *          
     *      ),
     * )
     */
    public function destroy(EstadoDomicilio $EstadoDomicilio)
    {
        $EstadoDomicilio->delete();

        $data = [
            'msg' => "Se ha eliminado el estado domicilio correctamente",
            'estado_domicilio' => $EstadoDomicilio
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
