<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    // protected $table = "my_table"; en caso de la convencion que tiene laravel por defecto se puede usar esta linea de codigo para difinir la tabla
 
    // protected $guarded = ['id'] esta propiedad hace lo contrario a fillable, guarda todos los campos excepto los que estan aqui escritos

    // protected $fillable = [
    //     'title',
    //     'url',
    //     'description'
    // ];

    use SoftDeletes;

    protected $guarded = [];

    public function getRouteKeyName(){
        return 'url';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
