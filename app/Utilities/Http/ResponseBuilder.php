<?php

namespace App\Utilities\Http;

use App\Utilities\Http\ResponseAbstract;
use App\Utilities\Http\ResponseJson;

class ResponseBuilder
{

  private $type;
  private $data;
  private $availableTypes = ['json'];

  public function build(): ResponseAbstract
  {
    $response = new ResponseJson();
    if ($this->isValidType()) {
      if ($this->type === 'json') {        
        if (array_key_exists('status', $this->data)) {
          $response->setStatus($this->data['status']);
        }
        if (array_key_exists('code', $this->data)) {
          $response->setCode($this->data['code']);
        }
        if (array_key_exists('data', $this->data)) {
          $response->setData($this->data['data']);
        }
        if (array_key_exists('message', $this->data)) {
          $response->setMessage($this->data['message']);
        }
        if (array_key_exists('error', $this->data)) {
          $response->setError($this->data['error']);
        }
        if (array_key_exists('httpCode', $this->data)) {
          $response->setHttpCode($this->data['httpCode']);
        }
      }
    }
    return $response;
  }

  public function setData(array $data): ResponseBuilder
  {
    $this->data = $data;
    return $this;
  }
  
  public function setType(string $type): ResponseBuilder
  {
    $this->type = $type;
    return $this;
  }

  private function isValidType(): bool
  {
    return isset($this->type) && 
      in_array($this->type, $this->availableTypes);
  }

}