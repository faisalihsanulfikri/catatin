<?php

namespace App\Traits\Meta;

trait GetterDate
{

  public function getCreatedAt(): string
  {
    return $this->created_at;
  }

  public function getUpdatedAt(): string
  {
    return $this->updated_at;
  }

  public function getFormatedCreatedAt(array $parameters = []): string
  {    
    $createdAt = $this->created_at;
    if (count($parameters) > 0) {
      if (array_key_exists("format", $parameters)) {
        $createdAt = date($parameters["format"], strtotime($createdAt));
      }
    }
    return $createdAt;
  }
  
  public function getFormatedUpdatedAt(array $parameters = []): string
  {    
    $updatedAt = $this->updated_at;
    if (count($parameters) > 0) {
      if (array_key_exists("format", $parameters)) {
        $updatedAt = date($parameters["format"], strtotime($updatedAt));
      }
    }
    return $updatedAt;
  }
  
}