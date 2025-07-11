<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Game extends Model
{

    // If you would like a model to use a UUID key instead of an auto-incrementing integer key, you may use the Illuminate\Database\Eloquent\Concerns\HasUuids trait on the model. Of course, you should ensure that the model has a UUID equivalent primary key column:
    // https://laravel.com/docs/12.x/eloquent
    use HasUuids;
    protected $primaryKey = "uuid";
    // protected $keyType = "string";
    // public $incrementing = false;
    public $casts = [
        'categories' => 'array',
        'platforms' => 'array'
    ];
    /*
    *
    * @var list<string>
    */
    protected $fillable = [
        'name',
        'categories',
        'release_year',
        'platforms',
        'studio',
        'publisher',
        'description'
    ];
}
