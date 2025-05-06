<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
        protected $fillable = [
            'user_id', 
            'name', 
            'email', 
            'phone', 
            'service', 
            'date', 
            'time', 
            'rating', 
            'review'
        ];
        

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
