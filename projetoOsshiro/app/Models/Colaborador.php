<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manutencao;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Colaborador extends Model
{
    use HasFactory;
    protected $table = 'colaboradors';
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function manutencaos(): HasMany
    {
        return $this->hasMany(App\Manutencao::class,'colaborador_id','id');
    }

}
