<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'uzytkownicy'; 
    protected $fillable = ['imie', 'email', 'haslo', 'rola', 'ulubiona_ksiazka_id', 'najmniej_lubiana_ksiazka_id', 'opis']; 
    protected $primaryKey = 'id';

    public $timestamps = true;
    const CREATED_AT = 'utworzono';
    const UPDATED_AT = 'zaaktualizowano';


  





}

