<?php

namespace App\Http\Controllers;

use App\Models\EstadoVenta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class EstadoVentaController extends Controller
{
    /**
     * Muestra todos los estados venta.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/estado_venta",
     *     tags={"estado_venta"},
     *     summary="Muestra todos los estados venta",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los estados venta"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $estados_venta = EstadoVenta::all();

        return response()->json([
            'data' => $estados_venta,
            'success' => true
        ]);
    }

    /**
     * Crear un nuevo estado venta
     * @OA\Post (
     *     path="/api/estado_venta",
     *     tags={"estado_venta"},
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
        $EstadoVenta = new EstadoVenta();
        $EstadoVenta->nombre = $request->nombre;
        $EstadoVenta->codename = $request->codename;
        $EstadoVenta->save();

        $data = [
            'msg' => "Se ha creado el estado venta correctamente",
            'estado_venta' => $EstadoVenta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de un estado venta
     * @OA\Get (
     *     path="/api/estado_venta/{id}",
     *     tags={"estado_venta"},
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
    public function show(EstadoVenta $EstadoVenta)
    {
        return response()->json([
            'data' => $EstadoVenta,
            'success' => true
        ]);
    }


    /**
     * Actualizar un estado venta
     * @OA\Put (
     *     path="/api/estado_venta/{id}",
     *     tags={"estado_venta"},
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
    public function update(Request $request, EstadoVenta $EstadoVenta)
    {
        $EstadoVenta->nombre = $request->nombre;
        $EstadoVenta->codename = $request->codename;
        $EstadoVenta->save();

        $data = [
            'msg' => "Se ha actualizado el estado venta correctamente",
            'estado_venta' => $EstadoVenta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar un estado venta
     * @OA\Delete (
     *     path="/api/estado_venta/{id}",
     *     tags={"estado_venta"},
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
    public function destroy(EstadoVenta $EstadoVenta)
    {
        $EstadoVenta->delete();

        $data = [
            'msg' => "Se ha eliminado el estado venta correctamente",
            'estado_venta' => $EstadoVenta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
