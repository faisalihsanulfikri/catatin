<?php

namespace App\Utilities\Http;

use App\Utilities\Http\ResponseAbstract;

class ResponseJson extends ResponseAbstract {
    
  public function __construct()
  {
    $this->setDefaultData();
  }

  public function send()
  {
    return response()->json(
      $this->buildResponseData(), 
      $this->httpCode
    );
  }

  private function setDefaultData(): ResponseJson
  {
    $this->setStatus("success");
    $this->setCode("00");
    $this->setMessage("Successfully connected");    
    $this->setHttpCode(200);
    return $this;
  }

  private function buildResponseData(): array
  {
    $responseData = [];
    if ($this->hasStatus()) {
      $responseData['status'] = $this->status;
    }
    if ($this->hasCode()) {
      $responseData['code'] = $this->code;
    }
    if ($this->hasMessage()) {
      $responseData['message'] = $this->message;
    }
    if ($this->hasData()) {
      $responseData['data'] = $this->data;
    }
    if ($this->hasError()) {
      $responseData['error'] = $this->error;
    }
    return $responseData;
  }

  
}