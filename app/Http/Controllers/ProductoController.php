<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Models\CategoriaProducto;

class ProductoController extends Controller
{
    /**
     * Muestra todos los productos.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/producto",
     *     tags={"producto"},
     *     summary="Muestra todos los productos",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los productos"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $productos = Producto::with('categoria_producto:id,codename,nombre')->get();

        return response()->json([
            'data' => $productos,
            'success' => true
        ]);
    }

    /**
     * Crear un nuevo producto
     * @OA\Post (
     *     path="/api/producto",
     *     tags={"producto"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id_categoria_producto",
     *                          type="integer"
     *                      ),
     * 
     *                      @OA\Property(
     *                          property="precio",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="descripcion",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="stock",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="imagen",
     *                          type="string"
     *                      ),
     *                 ),
     *                  example={
     *                     "id_categoria_producto": 1,
     *                     "precio": "10000",
     *                     "nombre":"Hamburguesa sencilla",
     *                     "descripcion":"Pan artesanal de papa, carne angus y vegetales frescos",
     *                     "stock":50,
     *                     "imagen": "https://static01.nyt.com/images/2023/05/25/multimedia/SS-Smashburger-update-vzhf/SS-Smashburger-update-vzhf-videoSixteenByNineJumbo1600.jpg"
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
        $categoriaProducto = CategoriaProducto::findOrFail($request->id_categoria_producto);

        $Producto = new Producto();
        $Producto->id_categoria_producto = $categoriaProducto->id;
        $Producto->precio = $request->precio;
        $Producto->nombre = $request->nombre;
        $Producto->descripcion = $request->descripcion;
        $Producto->stock = $request->stock;
        $Producto->imagen = $request->imagen;
        $Producto->save();

        $data = [
            'msg' => "Se ha creado el producto correctamente",
            'producto' => $Producto
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de un producto
     * @OA\Get (
     *     path="/api/producto/{id}",
     *     tags={"producto"},
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
    public function show(Producto $Producto)
    {
        return response()->json([
            'data' => $Producto,
            'success' => true
        ]);
    }


    /**
     * Actualizar un nuevo producto
     * @OA\Put (
     *     path="/api/producto/{id}",
     *     tags={"producto"},
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
     *                          property="id_categoria_producto",
     *                          type="integer"
     *                      ),
     * 
     *                      @OA\Property(
     *                          property="precio",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="descripcion",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="stock",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="imagen",
     *                          type="string"
     *                      ),
     *                 ),
     *                  example={
     *                     "id_categoria_producto": 1,
     *                     "precio": "10000",
     *                     "nombre":"Hamburguesa sencilla",
     *                     "descripcion":"Pan artesanal de papa, carne angus y vegetales frescos",
     *                     "stock":50,
     *                     "imagen": "https://static01.nyt.com/images/2023/05/25/multimedia/SS-Smashburger-update-vzhf/SS-Smashburger-update-vzhf-videoSixteenByNineJumbo1600.jpg"
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
    public function update(Request $request, Producto $Producto)
    {
        $categoriaProducto = CategoriaProducto::findOrFail($request->id_categoria_producto);

        $Producto->id_categoria_producto = $categoriaProducto->id;
        $Producto->precio = $request->precio;
        $Producto->nombre = $request->nombre;
        $Producto->descripcion = $request->descripcion;
        $Producto->stock = $request->stock;
        $Producto->imagen = $request->imagen;
        $Producto->save();

        $data = [
            'msg' => "Se ha actualizado el producto correctamente",
            'producto' => $Producto
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar un producto
     * @OA\Delete (
     *     path="/api/producto/{id}",
     *     tags={"producto"},
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
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha eliminado el producto correctamente", "producto": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     * )
     */
    public function destroy(Producto $Producto)
    {
        $Producto->delete();

        $data = [
            'msg' => "Se ha eliminado el producto correctamente",
            'producto' => $Producto
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
