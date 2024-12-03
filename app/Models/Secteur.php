<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



   
    class Secteur extends Model
    {
        use HasFactory;
    
        protected $fillable = [
            'name',
            'description',
            'user_id',
        ];
    
        // Relation avec Merchant
        public function marchants()
        {
            return $this->hasMany(Marchant::class);
        }
    
        // Relation avec Space
        public function spaces()
        {
            return $this->hasMany(Espace::class);
        }
    
        // Relation avec User
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
    
