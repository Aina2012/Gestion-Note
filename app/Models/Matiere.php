<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $table='matiere';
    protected $primaryKey='id_matiere';

    public $timestamps=false;

    protected $fillable=[
        'id_semestre',
        'nom_matiere',
        'code_matiere',
        'credit',
        'optionel',
        'groupe',
    ];
}