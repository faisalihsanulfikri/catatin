<?php

namespace App\Models;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class AchievementStudent extends Model
{
    use GetterId, GetterDate;

    protected $table = "achievement_student";
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

    public function student()
    {
        return $this->hasOne(
            "App\Models\Student",
            "student_id", "id"
        );
    }

    public function achievement()
    {
        return $this->hasOne(
            "App\Models\Achievement",
            "achievement_id", "id"
        );
    }

    public function hasDescription(): bool
    {
        return $this->description != null;
    }

    public function getLimitDescription(): string
    {
        if ($this->hasDescription()) {
            return \Illuminate\Support\Str::limit($this->description, 50, $end='...');
        }
        return "-";
    }
}
