<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    public function autor()
    {
        return $this->hasOne(Autor::class,'id','autor_id');
    }

    public function getImagenAttribute($value)
    {
        if ($value) {
            return asset('storage/images/' . $value);
        } else {
            return asset('images/profile/no-image.png');
        }
    }

    public function reviewRows()
    {
        return $this->hasMany(Calificacion::class);
    }


    public function avgCalificacion()
    {
        return $this->reviewRows()
        ->selectRaw('avg(puntaje) as promedio, curso_id')
        ->groupBy('curso_id');
    }

    public function getAvgCalificacionAttribute()
    {
        if ( ! array_key_exists('avgCalificacion', $this->relations)) {
            $this->load('avgCalificacion');
        }

        $relation = $this->getRelation('avgCalificacion')->first();

        return ($relation) ? $relation->promedio : null;
    }
}
