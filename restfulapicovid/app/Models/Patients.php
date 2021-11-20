<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    # Kolom tabel 
    protected $fillable = ['name', 'phone', 'address', 'status_id','in_date','out_date'];
}
