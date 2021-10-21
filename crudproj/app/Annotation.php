<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

// running note
// php artisan swagger-lume:generate
// php -S localhost:8080 public/index.php
// localhost:8080/api/documentation

 /**
 * @OA\Info(title="API Documentation", version="1.0.0")
 */
/**
 * @OA\Get(
 *     path="/api/crudmongo",
 *          *     @OA\Response(
     *         response="200",
     *         description="get all data cruds collection mongoDB",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success","data": {"_id": "616fd827e13d983f1e097632", "namalengkap": "Muhamad Yasin", "alamat": "Baros", "username": "myasin", "password": "$2y$10$Zv3Cf198tULszZGHJcWeduTxh5G7e0yp85l7.5bHYH/AksYSI7vTu", "updated_at": "2021-10-20T08:49:43.505000Z", "created_at": "2021-10-20T08:49:43.505000Z" }
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *    *  @OA\Response(response="400", description="failed get all data cruds collection mongoDB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * )

 * )
 *
 *  *  * @OA\Get(
 *     path="/api/crudmongo/{id}",
 * *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true
     *     ),
 *          *     @OA\Response(
     *         response="200",
     *         description="get data cruds filter by id collection mongoDB",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success","data": {"_id": "616fd827e13d983f1e097632", "namalengkap": "Muhamad Yasin", "alamat": "Baros", "username": "myasin", "password": "$2y$10$Zv3Cf198tULszZGHJcWeduTxh5G7e0yp85l7.5bHYH/AksYSI7vTu", "updated_at": "2021-10-20T08:49:43.505000Z", "created_at": "2021-10-20T08:49:43.505000Z" }
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *    *  @OA\Response(response="400", description="failed filter by id cruds collection mongoDB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * )

 * )
 * 
 * @OA\Post(
 *     path="/api/crudmongo/add",
 *     @OA\Response(response="200", description="insert data to cruds collections MongoDB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success"
     *                     }
     *                 )
     *             )
     *         }
     * ),
     *  @OA\Response(response="400", description="failed insert data to cruds collections MongoDB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * ),
 *   @OA\RequestBody(
 *       required=true,
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(
 *               type="object",
 *               @OA\Property(
 *                   property="namalengkap",
 *                   description="User Full Name",
 *                   type="string",
 *                   example="defitra M yasin"
 *               ),
 *               @OA\Property(
 *                   property="alamat",
 *                   description="User Address",
 *                   type="string",
 *                   example="sukabumi, indonesia"
 *               ),
 *  *               @OA\Property(
 *                   property="username",
 *                   description="Username",
 *                   type="string",
 *                   example="admin"
 *               ),
 *  *               @OA\Property(
 *                   property="password",
 *                   description="User Password",
 *                   type="string",
 *                   example="admin password"
 *               ),
 *           )
 *       )
 *   )
 * )
 *
 *  * @OA\Put(
 *     path="/api/crudmongo/update/{id}",
 *      *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true
     *     ),
 *     @OA\Response(response="200", description="update data to cruds collections MongoDB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success"
     *                     }
     *                 )
     *             )
     *         }
     * ),
     *  @OA\Response(response="400", description="failed update data to cruds collections MongoDB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * ),
 *   @OA\RequestBody(
 *       required=true,
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(
 *               type="object",
 *               @OA\Property(
 *                   property="namalengkap",
 *                   description="User Full Name",
 *                   type="string",
 *                   example="defitra M yasin"
 *               ),
 *               @OA\Property(
 *                   property="alamat",
 *                   description="User Address",
 *                   type="string",
 *                   example="sukabumi, indonesia"
 *               ),
 *  *               @OA\Property(
 *                   property="username",
 *                   description="Username",
 *                   type="string",
 *                   example="admin"
 *               ),
 *  *               @OA\Property(
 *                   property="password",
 *                   description="User Password",
 *                   type="string",
 *                   example="admin password"
 *               ),
 *           )
 *       )
 *   )
 * )
 *
 *  *  *  * @OA\Delete(
 *     path="/api/crudmongo/delete/{id}",
 * *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true
     *     ),
 *          *     @OA\Response(
     *         response="200",
     *         description="delete data cruds by id collection mongoDB",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success"
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *    *  @OA\Response(response="400", description="failed delete data cruds collection mongoDB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * )

 * )
 * 
 *  * @OA\Post(
 *     path="/api/login",
 *     @OA\Response(response="200", description="login to cruds collections MongoDB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success",
     *                         "token": "token value",
     *                         "data": {"_id": "616fd827e13d983f1e097632", "namalengkap": "Muhamad Yasin", "alamat": "Baros", "username": "myasin", "password": "$2y$10$Zv3Cf198tULszZGHJcWeduTxh5G7e0yp85l7.5bHYH/AksYSI7vTu", "updated_at": "2021-10-20T08:49:43.505000Z", "created_at": "2021-10-20T08:49:43.505000Z" }
     *                     }
     *                 )
     *             )
     *         }
     * ),
     *  @OA\Response(response="400", description="user does not exist",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "user does not exist"
     *                     }
     *                 )
     *             ),
     *         }
     * ),
 *   @OA\RequestBody(
 *       required=true,
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(
 *               type="object",
 *  *               @OA\Property(
 *                   property="username",
 *                   description="Username",
 *                   type="string",
 *                   example="admin"
 *               ),
 *  *               @OA\Property(
 *                   property="password",
 *                   description="User Password",
 *                   type="string",
 *                   example="admin password"
 *               ),
 *           )
 *       )
 *   )
 * )
 * 
 * 
 *  * @OA\Get(
 *     path="/api/logout",
 *          *     @OA\Response(
     *         response="200",
     *         description="logout and remove token",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "logout and destroy token success"
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *    *  @OA\Response(response="400", description="failed logout",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * )

 * )
 * 
 * 
 *  * @OA\Get(
 *     path="/api/firebase",
 *          *     @OA\Response(
     *         response="200",
     *         description="get all data firebase DB",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success","data":{"-MmQjB0LQ8pJWqI7bfnN":{"alamat":"smi","namalengkap":"M yasin"}}
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *    *  @OA\Response(response="400", description="failed get all data firebase DB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * )

 * )
 * 
 * 
 * 
 *  *  *  * @OA\Get(
 *     path="/api/firebase/by_id/{id}",
 * *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true
     *     ),
 *          *     @OA\Response(
     *         response="200",
     *         description="get data firebase DB filter by id ",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success","data":{"alamat":"smi","namalengkap":"M yasin"}
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *    *  @OA\Response(response="400", description="failed firebase DB filter by id ",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * )

 * )
 * 
 *  * @OA\Post(
 *     path="/api/firebase/add",
 *     @OA\Response(response="200", description="insert data to firebase DB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success"
     *                     }
     *                 )
     *             )
     *         }
     * ),
     *  @OA\Response(response="400", description="failed insert data to firebase DB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * ),
 *   @OA\RequestBody(
 *       required=true,
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(
 *               type="object",
 *               @OA\Property(
 *                   property="namalengkap",
 *                   description="User Full Name",
 *                   type="string",
 *                   example="defitra M yasin"
 *               ),
 *               @OA\Property(
 *                   property="alamat",
 *                   description="User Address",
 *                   type="string",
 *                   example="sukabumi, indonesia"
 *               )
 *           )
 *       )
 *   )
 * )
 * 
 * *  * @OA\Put(
 *     path="/api/firebase/update/{id}",
 *      *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true
     *     ),
 *     @OA\Response(response="200", description="update data to firebase DB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success"
     *                     }
     *                 )
     *             )
     *         }
     * ),
     *  @OA\Response(response="400", description="failed update data to firebase DB",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * ),
 *   @OA\RequestBody(
 *       required=true,
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(
 *               type="object",
 *               @OA\Property(
 *                   property="namalengkap",
 *                   description="User Full Name",
 *                   type="string",
 *                   example="defitra M yasin"
 *               ),
 *               @OA\Property(
 *                   property="alamat",
 *                   description="User Address",
 *                   type="string",
 *                   example="sukabumi, indonesia"
 *               )
 *           )
 *       )
 *   )
 * )
 *
 *  *  *  * @OA\Delete(
 *     path="/api/firebase/delete/{id}",
 * *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true
     *     ),
 *          *     @OA\Response(
     *         response="200",
     *         description="delete data firebase DB by id",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "success"
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *    *  @OA\Response(response="400", description="failed delete data firebase DB by id",
 *           *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "value message error Throwable"
     *                     }
     *                 )
     *             )
     *         }
     * )

 * )
 * 
 */
class Annotation extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

}