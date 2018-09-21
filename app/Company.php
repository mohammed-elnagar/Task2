<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'address', 'website', 'logo'
    ];

    public function employee(){
        return $this->hasMany(Employee::class, 'company_id')->paginate(2);
    }
}
