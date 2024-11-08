<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['data_inicio','data_fim','usuario_id','unidade_id','sala_id'];

    public function unidade()
    {
           return $this->belongsTo(Unidade::class,'unidade_id','id');
    }

    public function usuario()
    {
           return $this->belongsTo(User::class,'usuario_id','id');
    }

    public function sala()
    {
           return $this->belongsTo(Sala::class,'sala_id','id');
    }
}
