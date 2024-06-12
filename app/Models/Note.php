<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    //? Values that can be mass assigned
    protected $fillable = ['name', 'note', 'user_id'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
