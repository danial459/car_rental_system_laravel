<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_plate';
    public $incrementing = false;

    protected $fillable = [

        'car_no_plate','user_name','start_date','end_date','pick_up',
        'note','price',
    ];

    public function toggleUnderService()
    {
        $this->under_service = !$this->under_service;
        return $this;
    }

    public function changeBookActive()
    {
        $this->pivot->active = 0;
        $this->pivot->save();
        return $this;
    }

    public function users(){

        return $this->belongsToMany(User::class,'booking','no_plate','name')
                    ->withPivot(['id','start_date','start_time','end_time','end_date','pick_up','note','price'])
                    ->withTimestamps();

    }
}
