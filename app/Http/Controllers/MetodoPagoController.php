<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class MetodoPagoController extends Controller
{
    /**
     * Muestra todos los metodos de pago.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/metodo_pago",
     *     tags={"metodo_pago"},
     *     summary="Muestra todos los metodos de pago",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los metodos de pago"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $metodos_pago = MetodoPago::all();

        return response()->json([
            'data' => $metodos_pago,
            'success' => true
        ]);
    }

    /**
     * Crear un nuevo metodo de pago
     * @OA\Post (
     *     path="/api/metodo_pago",
     *     tags={"metodo_pago"},
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
     *                     "nombre":"EFECTIVO",
     *                     "codename":"cash"
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
        $MetodoPago = new MetodoPago();
        $MetodoPago->nombre = $request->nombre;
        $MetodoPago->codename = $request->codename;
        $MetodoPago->save();

        $data = [
            'msg' => "Se ha creado el metodo de pago correctamente",
            'metodo_pago' => $MetodoPago
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de un metodo de pago
     * @OA\Get (
     *     path="/api/metodo_pago/{id}",
     *     tags={"metodo_pago"},
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
    public function show(MetodoPago $MetodoPago)
    {
        return response()->json([
            'data' => $MetodoPago,
            'success' => true
        ]);
    }


    /**
     * Actualizar un metodo de pago
     * @OA\Put (
     *     path="/api/metodo_pago/{id}",
     *     tags={"metodo_pago"},
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
     *                     "nombre":"EFECTIVO",
     *                     "codename":"cash"
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
    public function update(Request $request, MetodoPago $MetodoPago)
    {
        $MetodoPago->nombre = $request->nombre;
        $MetodoPago->codename = $request->codename;
        $MetodoPago->save();

        $data = [
            'msg' => "Se ha actualizado el metodo de pago correctamente",
            'metodo_pago' => $MetodoPago
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar un metodo de pago
     * @OA\Delete (
     *     path="/api/metodo_pago/{id}",
     *     tags={"metodo_pago"},
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
    public function destroy(MetodoPago $MetodoPago)
    {
        $MetodoPago->delete();

        $data = [
            'msg' => "Se ha eliminado el metodo de pago correctamente",
            'metodo_pago' => $MetodoPago
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
