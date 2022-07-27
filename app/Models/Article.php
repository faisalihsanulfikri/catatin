<?php

namespace App\Models;

use App\Traits\Meta\GetterId;
use App\Traits\Meta\GetterDate;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use GetterId, GetterDate;

    protected $table = "article";
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

    public function hasContent(): bool
    {
      return $this->content != null;
    }
  
    public function getLimitContent(): string
    {
      if ($this->hasContent()) {
        return \Illuminate\Support\Str::limit($this->content, 100, $end='...');
      }
      return "-";
    }
  
    public function getTableContent(): string
    {
      if ($this->hasContent()) {
        return (html_entity_decode(\Illuminate\Support\Str::limit($this->content, 100, $end='...')));
      }
      return "-";
    }
  
    public function getDecodeContent()
    {
      if ($this->hasContent()) {
        return (html_entity_decode($this->content));
      }
      return "";
    }
  
    public function getAssetThumbnail()
    {
      return url($this->thumbnail);
    }
}
