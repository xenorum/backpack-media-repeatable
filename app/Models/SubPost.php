<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SubPost extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use CrudTrait;

    protected $fillable = [
        'title',
        'description'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
