<?php

namespace App\Models\Evaluation;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use GetterId, GetterDate;

    protected $table = "evaluation";
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
            "App\Models\Evaluation\EvaluationDetail",
            "evaluation_id", "id"
        );
    }

    public function getFormatedCreatedAt()
    {
        return $this->created_at == null ? '-' : Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->timezone('Asia/Jakarta')->format('d/m/Y');
    }

    public function getFormatedSemester()
    {
        if ($this->semester == 'odd') return 'Ganjil';
        if ($this->semester == 'even') return 'Genap';
        return '-';
    }
}
