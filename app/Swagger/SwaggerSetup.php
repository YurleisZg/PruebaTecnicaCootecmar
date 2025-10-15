<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API Prueba técnica Cootecmar",
 *     description="Documentación de la API del sistema de piezas, bloques y proyectos."
 * )
 * 
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="Servidor local"
 * )
 * 
 * @OA\Tag(
 *     name="Auth",
 *     description="Autenticación de usuarios"
 * )
 * 
 * @OA\Tag(
 *     name="Piezas",
 *     description="CRUD de piezas"
 * )
 */
class SwaggerSetup {}
