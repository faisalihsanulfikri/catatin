<?php

namespace App\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

class User extends Authenticatable
{
    use Notifiable;
    use GetterId;
    use GetterDate;

	protected $table = "user";
    protected $primaryKey = "id";  
    public $incrementing = true;
    public $timestamps = true;
    public $remember = true;
    
    protected $dates = [
        "created_at",
        "updated_at"
    ];
    protected $fillable = [];
    protected $guarded = [];
    protected $hidden = [
        "password", "remember_token",
    ];
    protected $casts = [];
    protected $appends = [];

    public function role()
    {
        return $this->belongsTo(
            "App\Models\User\UserRole",
            "user_role_id", "id"
        );
    }

    public function hasRole(): bool
    {
        return isset($this->role);
    }

    public function getRoleId(): int
    {
        return $this->user_role_id;
    }

    public function getRoleType(): string
    {
        if ($this->hasRole()) {
            return $this->role->getType();
        }
        return 'user';
    }

    public function getFormatedRole(): string
    {
        if ($this->getRoleId() == 1) {
            return 'Superadmin';
        }
        elseif ($this->getRoleId() == 2) {
            return 'Admin';
        }
        elseif ($this->getRoleId() == 3) {
            return 'User';
        }
        return '-';
    }

    public function student()
    {
        return $this->hasOne(
            "App\Models\Student",
            "user_id", "id"
        );
    }

    public function teacher()
    {
        return $this->hasOne(
            "App\Models\Teacher",
            "user_id", "id"
        );
    }

    public function parents()
    {
        return $this->hasOne(
            "App\Models\Parents",
            "user_id", "id"
        );
    }

    public function hasTeacher(): bool
    {
        return isset($this->teacher);
    }

    public function getTeacherId(): int
    {
        if ($this->hasTeacher()) {
            return $this->teacher->getId();
        }
        return 0;
    }

    public function getParentId(): int
    {
        if ($this->parents()) {
            return $this->parents->getId();
        }
        return 0;
    }

    public function getStudentId(): int
    {
        if ($this->student()) {
            return $this->student->getId();
        }
        return 0;
    }

    public function getName()
    {
        return $this->name;
    }

    public function hasActive(): bool
    {
        return isset($this->is_active) && $this->is_active == 1;
    }
}
