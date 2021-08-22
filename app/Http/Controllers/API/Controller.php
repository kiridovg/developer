<?php

namespace App\Http\Controllers\API;


/**
 * @OA\Info(
 *     title="JuniorDevelop API",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="kiridovg@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Book",
 *     description="Page with book",
 * )
 * @OA\Server(
 *     description="JuniorDevelop API server",
 *     url="https://juniordev.com/api"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="X-APP-ID",
 *     securityScheme="X-APP-ID"
 * )
 */

class Controller extends \App\Http\Controllers\Controller
{

}
