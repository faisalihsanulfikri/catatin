<?php

namespace App\Models;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use GetterId, GetterDate;

    protected $table = "admission";
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

    public function parents()
    {
        return $this->belongsTo(
            "App\Models\Parents",
            "parent_id", "id"
        );
    }

    public function hasApproved()
    {
        return isset($this->status) && $this->status == 'approved';
    }

    public function formatStatus()
    {
        if ($this->status == 'pending') return 'Pending';
        elseif ($this->status == 'approve') return 'Diterima';
        elseif ($this->status == 'unapprove') return 'Ditolak';
        else return '-';
    }
}
