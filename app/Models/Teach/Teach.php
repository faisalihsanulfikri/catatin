<?php

namespace App\Models\Teach;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class Teach extends Model
{
    use GetterId, GetterDate;

    protected $table = "teach";
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

    public function details()
    {
        return $this->hasMany(
            "App\Models\Teach\TeachDetail",
            "teach_id", "id"
        );
    }

    public function getFormatedSemester()
    {
        if ($this->semester == 'odd') return 'Ganjil';
        if ($this->semester == 'even') return 'Genap';
        return '-';
    }
}
