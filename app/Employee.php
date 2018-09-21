<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;

class Employee extends Model
{
    //
    protected $fillable = ['company_id', 'name', 'last_name', 'email', 'phone'];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
