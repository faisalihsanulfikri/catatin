<?php

namespace App\Models;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use GetterId, GetterDate;

    protected $table = "student";
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

    public function parents()
    {
      return $this->hasOne(
        "App\Models\Parents",
        "id", "parent_id"
      );
    }

    public function achievementStudents()
    {
      return $this->hasMany(
        "App\Models\AchievementStudent",
        "student_id", "id"
      );
    }

    public function evaluationDetails()
    {
      return $this->hasMany(
        "App\Models\Evaluation\EvaluationDetail",
        "student_id", "id"
      );
    }
}
