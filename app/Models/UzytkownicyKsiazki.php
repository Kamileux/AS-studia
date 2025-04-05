<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UzytkownicyKsiazki extends Model
{
    use HasFactory;
    
    protected $table = 'uzytkownicy_ksiazki'; 
    protected $fillable = ['uzytkownik_id', 'ksiazka_id', 'ocena']; 
    
    // Relacja jeden
    public function uzytkownik()
    {
        return $this->belongsTo(User::class, 'uzytkownik_id');
    }
    
    // Relacja dwa
    public function ksiazka()
    {
        return $this->belongsTo(Ksiazka::class, 'ksiazka_id');
    }
}
