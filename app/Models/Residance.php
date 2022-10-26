<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residance extends Model
{
    use HasFactory;
    protected $fillable = [
        'residential_name',
        'unit_number',
        'type_residential',
        'description'
    ]; // tambahkan $fillable
}
