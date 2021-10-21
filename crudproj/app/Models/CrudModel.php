<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class CrudModel extends Model 
{
    protected $connection = 'mongodb';
    protected $collection = 'crudsdb';
    protected $primaryKey = '_id';
}