<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class CategoriaProductoController extends Controller
{
    /**
     * Muestra todas las categorias de productos.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/categoria_producto",
     *     tags={"categoria_producto"},
     *     summary="Muestra todas las categorias de productos",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todas las categorias de productos"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $categorias_producto = CategoriaProducto::all();

        return response()->json([
            'data' => $categorias_producto,
            'success' => true
        ]);
    }

    /**
     * Crear una nueva categoria de producto
     * @OA\Post (
     *     path="/api/categoria_producto",
     *     tags={"categoria_producto"},
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
     *                     "nombre":"HAMBURGUESA",
     *                     "codename":"burger"
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
        $CategoriaProducto = new CategoriaProducto();
        $CategoriaProducto->nombre = $request->nombre;
        $CategoriaProducto->codename = $request->codename;
        $CategoriaProducto->save();

        $data = [
            'msg' => "Se ha creado la categoria de producto correctamente",
            'categoria_producto' => $CategoriaProducto
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de una categoria de producto
     * @OA\Get (
     *     path="/api/categoria_producto/{id}",
     *     tags={"categoria_producto"},
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
    public function show(CategoriaProducto $CategoriaProducto)
    {
        return response()->json([
            'data' => $CategoriaProducto,
            'success' => true
        ]);
    }


    /**
     * Actualizar una categoria de producto
     * @OA\Put (
     *     path="/api/categoria_producto/{id}",
     *     tags={"categoria_producto"},
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
     *                     "nombre":"HAMBURGUESA",
     *                     "codename":"burger"
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
    public function update(Request $request, CategoriaProducto $CategoriaProducto)
    {
        $CategoriaProducto->nombre = $request->nombre;
        $CategoriaProducto->codename = $request->codename;
        $CategoriaProducto->save();

        $data = [
            'msg' => "Se ha actualizado la categoria de producto correctamente",
            'categoria_producto' => $CategoriaProducto
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar una categoria de producto
     * @OA\Delete (
     *     path="/api/categoria_producto/{id}",
     *     tags={"categoria_producto"},
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
    public function destroy(CategoriaProducto $CategoriaProducto)
    {
        $CategoriaProducto->delete();

        $data = [
            'msg' => "Se ha eliminado la categoria de producto correctamente",
            'categoria_producto' => $CategoriaProducto
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
