<?php

namespace App\Http\Controllers;

use App\Models\DireccionCliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Models\Cliente;


class DireccionClienteController extends Controller
{
    /**
     * Muestra todas las direcciones del cliente.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/direccion_cliente",
     *     tags={"direccion_cliente"},
     *     summary="Muestra todas las direcciones del cliente",
     *  @OA\Parameter(
 *         name="id_cliente",
 *         in="query",
 *         description="ID del cliente",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todas las direcciones del cliente"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index(Request $request)
    {

        $clienteId = $request->id_cliente;

        // Obtener todas las direcciones del cliente con el ID proporcionado
        $direcciones = Cliente::find($clienteId)->direcciones;

        //  // Obtener todas las direcciones del cliente con el ID proporcionado
        //  $cliente = Cliente::with('direcciones')->find($clienteId);

        return response()->json([
            'data' => $direcciones,
            'success' => true
        ]);
    }

    /**
     * Crear una nueva dirección cliente
     * @OA\Post (
     *     path="/api/direccion_cliente",
     *     tags={"direccion_cliente"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id_cliente",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="pais",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="ciudad",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="barrio",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="direccion_texto",
     *                          type="string"
     *                      ),
     * 
     *                 ),
     *                  example={
     *                     "id_cliente": 1,
     *                     "pais":"Colombia",
     *                     "ciudad":"Soledad",
     *                     "barrio":"Centenario",
     *                     "direccion_texto":"Calle 23B",
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
        $cliente = Cliente::findOrFail($request->id_cliente);

        $DireccionCliente = new DireccionCliente();
        $DireccionCliente->id_cliente = $cliente->id;
        $DireccionCliente->pais = $request->pais;
        $DireccionCliente->ciudad = $request->ciudad;
        $DireccionCliente->barrio = $request->barrio;
        $DireccionCliente->direccion_texto = $request->direccion_texto;
        $DireccionCliente->save();

        $data = [
            'msg' => "Se ha creado la dirección cliente correctamente",
            'direccion_cliente' => $DireccionCliente
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de una dirección cliente
     * @OA\Get (
     *     path="/api/direccion_cliente/{id}",
     *     tags={"direccion_cliente"},
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
    public function show(DireccionCliente $DireccionCliente)
    {
        return response()->json([
            'data' => $DireccionCliente,
            'success' => true
        ]);
    }


    /**
     * Actualizar una nueva dirección cliente
     * @OA\Put (
     *     path="/api/direccion_cliente/{id}",
     *     tags={"direccion_cliente"},
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
     *                          property="id_cliente",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="pais",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="ciudad",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="barrio",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="direccion_texto",
     *                          type="string"
     *                      ),
     * 
     *                 ),
     *                  example={
     *                     "id_cliente": 1,
     *                     "pais":"Colombia",
     *                     "ciudad":"Soledad",
     *                     "barrio":"Centenario",
     *                     "direccion_texto":"Calle 23B",
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
    public function update(Request $request, DireccionCliente $DireccionCliente)
    {
        $cliente = Cliente::findOrFail($request->id_cliente);

        $DireccionCliente->id_cliente = $cliente->id;
        $DireccionCliente->pais = $request->pais;
        $DireccionCliente->ciudad = $request->ciudad;
        $DireccionCliente->barrio = $request->barrio;
        $DireccionCliente->direccion_texto = $request->direccion_texto;
        $DireccionCliente->save();

        $data = [
            'msg' => "Se ha actualizado la dirección cliente correctamente",
            'direccion_cliente' => $DireccionCliente
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar una dirección cliente
     * @OA\Delete (
     *     path="/api/direccion_cliente/{id}",
     *     tags={"direccion_cliente"},
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
    public function destroy(DireccionCliente $DireccionCliente)
    {
        $DireccionCliente->delete();

        $data = [
            'msg' => "Se ha eliminado la dirección cliente correctamente",
            'direccion_cliente' => $DireccionCliente
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
