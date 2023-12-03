<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'title',
        'description'
    ];

    public function subPost(): HasOne
    {
        return $this->hasOne(SubPost::class);
    }
}
