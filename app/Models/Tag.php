<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
        'active'];

    //Relacion muchos a muchos
    public function tasks(){
        return $this->belongsToMany(Task::class);
    }

}