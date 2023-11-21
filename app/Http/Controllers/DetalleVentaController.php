<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Models\CategoriaProducto;
use App\Models\Cliente;
use App\Models\MetodoPago;
use App\Models\Domicilio;
use App\Models\EstadoVenta;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;

class DetalleVentaController extends Controller
{
    /**
     * Muestra todas las detalle_venta.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/detalle_venta",
     *     tags={"detalle_venta"},
     *     summary="Muestra todas las detalle_venta",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todas las detalle_venta"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $detalle_venta = DetalleVenta::with(
            'producto.categoria_producto'
            )->get();

        return response()->json([
            'data' => $detalle_venta,
            'success' => true
        ]);
    }

    /**
     * Crear una nueva detalle venta
     * @OA\Post (
     *     path="/api/detalle_venta",
     *     tags={"detalle_venta"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id_venta",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="id_producto",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="cantidad",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="total",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="descuento",
     *                          type="sting"
     *                      ),
     *                     
     *                 ),
     *                  example={
     *                     "id_venta": 1,
     *                     "id_producto": "1",
     *                     "cantidad": "2",
     *                     "total": "20000",
     *                     "descuento": "0",
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
        $Venta = Venta::findOrFail($request->id_venta);
        $Producto = Producto::findOrFail($request->id_producto);

        $DetalleVenta = new DetalleVenta();
        $DetalleVenta->id_venta = $Venta->id;
        $DetalleVenta->id_producto = $Producto->id;
        $DetalleVenta->total = $request->total;
        $DetalleVenta->cantidad = $request->cantidad;
        $DetalleVenta->descuento = $request->descuento;
        $DetalleVenta->save();

        $data = [
            'msg' => "Se ha creado la detalle venta correctamente",
            'detalle_venta' => $DetalleVenta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de una detalle venta
     * @OA\Get (
     *     path="/api/detalle_venta/{id}",
     *     tags={"detalle_venta"},
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
    public function show(DetalleVenta $DetalleVenta)
    {
        return response()->json([
            'data' => $DetalleVenta,
            'success' => true
        ]);
    }


    /**
 * Actualizar una detalle_venta
 * @OA\Put (
 *     path="/api/detalle_venta/{id}",
 *     tags={"detalle_venta"},
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
 *                     type="object",
 *                          @OA\Property(
     *                          property="id_venta",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="id_producto",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="cantidad",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="total",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="descuento",
     *                          type="sting"
     *                      ),
 *                 ),
 *                 example={
     *                     "id_venta": 1,
     *                     "id_producto": "1",
     *                     "cantidad": "2",
     *                     "total": "20000",
     *                     "descuento": "0",
     *                }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="SUCCESS"
 *     )
 * )
 */
    public function update(Request $request, DetalleVenta $DetalleVenta)
    {
        $Venta = Venta::findOrFail($request->id_venta);
        $Producto = Producto::findOrFail($request->id_producto);

        $DetalleVenta->id_venta = $Venta->id;
        $DetalleVenta->id_producto = $Producto->id;
        $DetalleVenta->total = $request->total;
        $DetalleVenta->cantidad = $request->cantidad;
        $DetalleVenta->descuento = $request->descuento;
        $DetalleVenta->save();

        $data = [
            'msg' => "Se ha actualizado la detalle_venta correctamente",
            'detalle_venta' => $DetalleVenta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar una detalle venta
     * @OA\Delete (
     *     path="/api/detalle_venta/{id}",
     *     tags={"detalle_venta"},
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
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha eliminado la detalle_venta correctamente", "detalle_venta": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     * )
     */
    public function destroy(DetalleVenta $DetalleVenta)
    {
        $DetalleVenta->delete();

        $data = [
            'msg' => "Se ha eliminado la detalle venta correctamente",
            'detalle_venta' => $DetalleVenta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
