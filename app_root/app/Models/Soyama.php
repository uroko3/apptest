<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soyama extends Model
{
    use HasFactory;
    
    protected $fillable = [
    	'name',
    ];
    
    public function scopeFilter() {
    	return $this->find(10066660);
    }
}
