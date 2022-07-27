<?php

namespace App\Models;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use GetterId, GetterDate;

    protected $table = "income";
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
    protected $appends = [];
}
