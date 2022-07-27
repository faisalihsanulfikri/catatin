<?php

namespace App\Models\User;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

  use GetterId, GetterDate;

	protected $table = "user_role";
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

  public function getType(): string
  {
    return $this->type;
  }
}
