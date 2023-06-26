<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Categoria;
use App\Models\Colaborador;


class Manutencao extends Model
{
  use HasFactory;
  protected $table = 'manutencaos';
  public $timestamps = false;
  protected $casts = [
      'data' => 'datetime:Y-m-d',
  ];
  public function categoria(): BelongsTo
  {
     return $this->belongsTo(Categoria::class);
  }

  public function colaborador(): BelongsTo
  {
     return $this->belongsTo(Colaborador::class);
  }
}
