<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Models\CategoriaProducto;
use App\Models\Cliente;
use App\Models\MetodoPago;
use App\Models\Domicilio;
use App\Models\EstadoVenta;
use App\Models\User;

class VentaController extends Controller
{
    /**
     * Muestra todas las ventas.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/venta",
     *     tags={"venta"},
     *     summary="Muestra todas las ventas",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todas las ventas"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $ventas = Venta::with('domicilio.repartidor', 'domicilio.estado_domicilio', 'domicilio.repartidor.tipo_identificacion', 'metodo_pago', 'usuario', 'estado_venta', 'cliente.tipo_identificacion')->get();

        return response()->json([
            'data' => $ventas,
            'success' => true
        ]);
    }

    /**
     * Crear una nueva venta
     * @OA\Post (
     *     path="/api/venta",
     *     tags={"venta"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id_domicilio",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="id_metodo_pago",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="id_usuario",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="id_estado_venta",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="id_cliente",
     *                          type="integer"
     *                      ),
     * 
     *                      @OA\Property(
     *                          property="total",
     *                          type="string"
     *                      ),
     *                     
     *                 ),
     *                  example={
     *                     "id_domicilio": 1,
     *                     "id_metodo_pago": "1",
     *                     "id_usuario": "1",
     *                     "id_estado_venta": "1",
     *                     "id_cliente": "1",
     *                     "total":"0",
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
        $Domicilio = Domicilio::findOrFail($request->id_domicilio);
        $MetodoPago = MetodoPago::findOrFail($request->id_metodo_pago);
        $Usuario = User::findOrFail($request->id_usuario);
        $EstadoVenta = EstadoVenta::findOrFail($request->id_estado_venta);
        $Cliente = Cliente::findOrFail($request->id_cliente);

        $Venta = new Venta();
        $Venta->id_domicilio = $Domicilio->id;
        $Venta->id_metodo_pago = $MetodoPago->id;
        $Venta->id_usuario = $Usuario->id;
        $Venta->id_estado_venta = $EstadoVenta->id;
        $Venta->id_cliente = $Cliente->id;
        $Venta->total = $request->total;
        $Venta->save();

        $data = [
            'msg' => "Se ha creado la venta correctamente",
            'venta' => $Venta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de una venta
     * @OA\Get (
     *     path="/api/venta//{id}",
     *     tags={"venta"},
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
    public function show(Venta $Venta)
    {
        return response()->json([
            'data' => $Venta,
            'success' => true
        ]);
    }


/**
 * Actualizar una venta
 * @OA\Put (
 *     path="/api/venta/{id}",
 *     tags={"venta"},
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
 *                     @OA\Property(
 *                         property="id_domicilio",
 *                         type="integer"
 *                     ),
 *                     @OA\Property(
 *                         property="id_metodo_pago",
 *                         type="integer"
 *                     ),
 *                     @OA\Property(
 *                         property="id_usuario",
 *                         type="integer"
 *                     ),
 *                     @OA\Property(
 *                         property="id_estado_venta",
 *                         type="integer"
 *                     ),
 *                     @OA\Property(
 *                         property="id_cliente",
 *                         type="integer"
 *                     ),
 *                     @OA\Property(
 *                         property="total",
 *                         type="string"
 *                     )
 *                 ),
 *                 example={
 *                     "id_domicilio": 1,
 *                     "id_metodo_pago": 1,
 *                     "id_usuario": 1,
 *                     "id_estado_venta": 1,
 *                     "id_cliente": 1,
 *                     "total": "0"
 *                 }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="SUCCESS"
 *     )
 * )
 */
    public function update(Request $request, Venta $Venta)
    {
        $Domicilio = Domicilio::findOrFail($request->id_domicilio);
        $MetodoPago = MetodoPago::findOrFail($request->id_metodo_pago);
        $Usuario = User::findOrFail($request->id_usuario);
        $EstadoVenta = EstadoVenta::findOrFail($request->id_estado_venta);
        $Cliente = Cliente::findOrFail($request->id_cliente);

        $Venta->fill([
            'id_domicilio' => $Domicilio->id,
            'id_metodo_pago' => $MetodoPago->id,
            'id_usuario' => $Usuario->id,
            'id_estado_venta' => $EstadoVenta->id,
            'id_cliente' => $Cliente->id,
            'total' => $request->total
        ]);
        
        $Venta->save();

        $data = [
            'msg' => "Se ha actualizado la venta correctamente",
            'venta' => $Venta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar una venta
     * @OA\Delete (
     *     path="/api/venta/{id}",
     *     tags={"venta"},
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
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha eliminado la venta correctamente", "venta": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     * )
     */
    public function destroy(Venta $Venta)
    {
        $Venta->delete();

        $data = [
            'msg' => "Se ha eliminado la venta correctamente",
            'venta' => $Venta
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
