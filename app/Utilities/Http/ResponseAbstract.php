<?php

namespace App\Utilities\Http;

abstract class ResponseAbstract
{

  protected $httpCode;//int
  protected $status;//string
  protected $code;//string
  protected $message;//string
  protected $data;//array or object
  protected $error;//array or object

  private $availableStatuses = [
    "success", "error", "failed"
  ];

  /* 
    00 = ok
    01 = exception
    02 = invalid data supplied
    03 = auth failed
    04 = not found
    05 = server failed
    06 = communication failed 
  */
  private $availableCodes = [
    "00", "01", "02", "03", "04", "05", "06"
  ];

  abstract function send();

  public function setHttpCode(int $httpCode): ResponseAbstract
  {
    $this->httpCode = $httpCode;
    return $this;
  }

  public function setStatus(string $status): ResponseAbstract
  {
    if (in_array($status, $this->availableStatuses)) {
      $this->status = $status;
    }    
    return $this;
  }

  public function setCode(string $code): ResponseAbstract
  {
    if (in_array($code, $this->availableCodes)) {
      $this->code = $code;
    }    
    return $this;
  }

  public function setMessage(string $message): ResponseAbstract
  {
    $this->message = $message;
    return $this;
  }

  public function setData($data): ResponseAbstract
  {
    if (is_array($data) || is_object($data)) {
      $this->data = $data;
    }    
    return $this;
  }

  public function setError($error): ResponseAbstract
  {
    if (is_array($error) || is_object($error)) {
      if (is_array($error)) {
        $error = (object) $error;
      }
      $this->error = $error;
    }
    return $this;
  }

  public function hasStatus(): bool
  {
    return isset($this->status) && is_string($this->status);
  }

  public function hasCode(): bool
  {
    return isset($this->code) && is_string($this->code);
  }

  public function hasMessage(): bool
  {
    return isset($this->message) && is_string($this->message);
  }

  public function hasData(): bool
  {
    return isset($this->data) && (is_array($this->data) || is_object($this->data));
  }

  public function hasError(): bool
  {
    return isset($this->error) && is_object($this->error);
  }

}