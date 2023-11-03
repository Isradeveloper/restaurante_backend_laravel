<?php

namespace App\Http\Controllers;

use App\Models\TipoIdentificacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Delicious Dinner API",
 *      description="API realizada en Laravel",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      @OA\Contact(
 *          email="ingisraeltrujillo@gmail.com"
 *      ),
 *      @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */
class TipoIdentificacionController extends Controller
{
    /**
     * Muestra todos los tipos de identificación.


     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/tipo_identificacion",
     *     tags={"tipo_identificacion"},
     *     summary="Muestra todos los tipos de identificacións",
     *     @OA\Response(
     *         response=200,
     *         description="Muestra todos los tipos de identificación"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * ) 
     */
    public function index()
    {
        $tipos_identificacion = TipoIdentificacion::all();

        return response()->json([
            'data' => $tipos_identificacion,
            'success' => true
        ]);
    }

    /**
     * Crear un nuevo tipo de identificación
     * @OA\Post (
     *     path="/api/tipo_identificacion",
     *     tags={"tipo_identificacion"},
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
     *                     "nombre":"CÉDULA DE CIUDADANÍA",
     *                     "codename":"CC"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *           @OA\JsonContent(
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha creado el tipo de identificación correctamente", "tipo_identificacion": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     *     
     * )
     */
    public function store(Request $request)
    {
        $tipoIdentificacion = new TipoIdentificacion();
        $tipoIdentificacion->nombre = $request->nombre;
        $tipoIdentificacion->codename = $request->codename;
        $tipoIdentificacion->save();

        $data = [
            'msg' => "Se ha creado el tipo de identificación correctamente",
            'tipo_identificacion' => $tipoIdentificacion
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Mostrar la información de un tipo de identificación
     * @OA\Get (
     *     path="/api/tipo_identificacion/{id}",
     *     tags={"tipo_identificacion"},
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
    public function show(TipoIdentificacion $tipoIdentificacion)
    {
        return response()->json([
            'data' => $tipoIdentificacion,
            'success' => true
        ]);
    }


    /**
     * Actualizar un nuevo tipo de identificación
     * @OA\Put (
     *     path="/api/tipo_identificacion/{id}",
     *     tags={"tipo_identificacion"},
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
     *                     "nombre":"CÉDULA DE CIUDADANÍA",
     *                     "codename":"CC"
     *                }
     *             )
     *         )
     *      ),
     *       @OA\Response(
     *          response=200,
     *          description="SUCCESS",
     *           @OA\JsonContent(
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha actualizado el tipo de identificación correctamente", "tipo_identificacion": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     * )
     */
    public function update(Request $request, TipoIdentificacion $tipoIdentificacion)
    {
        $tipoIdentificacion->nombre = $request->nombre;
        $tipoIdentificacion->codename = $request->codename;
        $tipoIdentificacion->save();

        $data = [
            'msg' => "Se ha actualizado el tipo de identificación correctamente",
            'tipo_identificacion' => $tipoIdentificacion
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    /**
     * Eliminar un tipo de identificación
     * @OA\Delete (
     *     path="/api/tipo_identificacion/{id}",
     *     tags={"tipo_identificacion"},
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
    *              @OA\Property(property="data", type="object", example={"msg": "Se ha eliminado el tipo de identificación correctamente", "tipo_identificacion": {"id": 1, "nombre": "CÉDULA DE CIUDADANÍA", "codename": "CC", "created_at": "2023-11-03T03:06:55.000000Z", "updated_at": "2023-11-03T03:06:55.000000Z"}}),
    *              @OA\Property(property="success", type="boolean", example=true)
    *            )
     *      ),
     * )
     */
    public function destroy(TipoIdentificacion $tipoIdentificacion)
    {
        $tipoIdentificacion->delete();

        $data = [
            'msg' => "Se ha eliminado el tipo de identificación correctamente",
            'tipo_identificacion' => $tipoIdentificacion
        ];

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
