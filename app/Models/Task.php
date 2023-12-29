<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'completed',
        'completed_at',
        'repeat_id',
        'user_id'
    ];

    //Relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Repeat::class);
    }

    //Relacion muchos a muchos 
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
