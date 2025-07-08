<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Game extends Model
{

    // If you would like a model to use a UUID key instead of an auto-incrementing integer key, you may use the Illuminate\Database\Eloquent\Concerns\HasUuids trait on the model. Of course, you should ensure that the model has a UUID equivalent primary key column:
    // https://laravel.com/docs/12.x/eloquent
    use HasUuids;
    /*
    *
    * @var list<string>
    */
    public $fillable = [
        'name',
        'categories',
        'release_year',
        'platforms',
        'studio',
        'publisher',
        'description'
    ];
}
// $Game->uuid('id');
