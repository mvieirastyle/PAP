<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
        protected $fillable = [
                'type',
        ];

        public function animals()
        {
                return $this->belongsToMany(Animal::class);
        }
}
