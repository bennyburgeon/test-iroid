<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $table='companies'; 
    protected $primaryKey = 'company_id';
    protected $fillabe = ['name','description','logo','contact_number','annual_turnover','created_by',
    'updated_by'];

 
}
