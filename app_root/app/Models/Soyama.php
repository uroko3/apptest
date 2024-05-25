<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Soyama extends Model
{
    use HasFactory;
    
    protected $fillable = [
    	'name',
    ];
    
    public function scopeFilter() {
    	return $this->find(10066660);
    }
    
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
    	return $date->format('Y-m-d H:i:s');
    }
}
