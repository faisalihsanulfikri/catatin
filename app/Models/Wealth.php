<?php

namespace App\Models;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class Wealth extends Model
{
    use GetterId, GetterDate;

    protected $table = "wealth";
    protected $primaryKey = "id";  
    public $incrementing = true;
    public $timestamps = true;
    public $remember = false;
        
    protected $dates = [
        "created_at",
        "updated_at"
    ];
    
    protected $fillable = [];

    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];
    protected $appends = [
        'formated_amount'
    ];

    public function getFormatedAmountAttribute()
    {
        return number_format($this->amount);
    }
}
