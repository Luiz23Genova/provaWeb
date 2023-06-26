<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manutencao;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categoria';
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function manutencaos(): HasMany
    {
        return $this->hasMany(App\Manutencao::class,'categoria_id','id');
    }

}

/*protected $table = 'categorias';


    public function produtos()
    {
        return $this->hasMany(App\Produto::class,'categoria_id','id');
    }*/
