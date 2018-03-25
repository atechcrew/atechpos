<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Brand extends Model
{
    use SearchableTrait;
    protected $searchable = [
        'columns' => [
            'brands.name' => 10,
        ],
        'joins' => [],
    ];
    protected $fillable = [
        "id",
        "name",
        "description",
        "active",
    ];
}
