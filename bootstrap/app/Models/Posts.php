<?php
// El modelo post solo acepta el titulo, la url y content para hacer la 
// insercion en la base de datos
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;
    /*$fillable indicara cuales son los campos de la base de datos
    en los que se podra hacer una incersion masiva*/
    protected $fillable = ['title', 'url_clean', 'content'];
}
