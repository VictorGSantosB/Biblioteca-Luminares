<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
    ];


    public function books()
    {
        return $this->hasMany(Book::class);
    }
    use HasFactory;
}
