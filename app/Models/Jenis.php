<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;



    protected $fillable = ['nama_jenis', 'slug'];







    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_jenis'
            ]
        ];
    }
}
