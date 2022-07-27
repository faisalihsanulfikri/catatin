<?php

namespace App\Models;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use GetterId, GetterDate;

    protected $table = "parent";
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

    public function user()
    {
      return $this->hasOne(
        "App\Models\User\User",
        "id", "user_id"
      );
    }

    public function students()
    {
      return $this->belongsToMany(
        "App\Models\Student",
        "id", "parent_id"
      );
    }
}
