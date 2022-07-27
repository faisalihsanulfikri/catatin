<?php

namespace App\Utilities\Http;

use App\Utilities\Http\ResponseJson;

class Response {
  
  private $type;
  private $responseData;
  private $responseBuilder;
  private $response;

  public function __construct()
  {
    $this->setDefaultData();
  }

  public function send()
  {
    $this->response = $this->responseBuilder
      ->setType($this->type)
      ->setData($this->responseData)
      ->build();
    return $this->response->send();
  }

  public function setStatus(string $status): Response
  {
    $this->responseData["status"] = $status;
    return $this;
  }

  public function setHttpCode(int $httpCode): Response
  {
    $this->responseData["httpCode"] = $httpCode;
    return $this;
  }
  
  public function setCode(string $code): Response
  {
    $this->responseData["code"] = $code;
    return $this;
  }

  public function setMessage(string $message): Response
  {
    $this->responseData["message"] = $message;
    return $this;
  }

  public function addDataObject(string $objectName, $objectData): Response
  {
    $this->responseData["data"][$objectName] = (object) $objectData;
    return $this;
  }

  public function setData($data): Response
  {
    if (is_array($data) || is_object($data)) {
      $this->responseData["data"] = $data;
    }    
    return $this;
  }

  public function setError($error): Response
  {
    if (is_array($error) || is_object($error)) {
      $this->responseData["error"] = $error;
    }
    return $this;
  }

  public function success(): Response
  {
    $this->responseData["status"] = "success";
    $this->responseData["code"] = "200";
    $this->responseData["message"] = "Successfully connected";
    $this->responseData["httpCode"] = 200;
    return $this;
  }

  public function unauthenticate(): Response
  {
    $this->responseData["status"] = "error";
    $this->responseData["code"] = "401";
    $this->responseData["message"] = "Unauthenticated access";
    $this->responseData["httpCode"] = 401;
    return $this;
  }

  public function forbidden(): Response
  {
    $this->responseData["status"] = "error";
    $this->responseData["code"] = "403";
    $this->responseData["message"] = "Forbidden access";
    $this->responseData["httpCode"] = 403;
    return $this;
  }

  public function badRequest(): Response
  {
    $this->responseData["status"] = "failed";
    $this->responseData["code"] = "400";
    $this->responseData["message"] = "Bad request";
    $this->responseData["httpCode"] = 400;
    return $this;
  }
  
  public function notFound(): Response
  {
    $this->responseData["status"] = "error";
    $this->responseData["code"] = "404";
    $this->responseData["message"] = "Data not found";
    $this->responseData["httpCode"] = 404;
    return $this;
  }

  public function invalidData(): Response
  {
    $this->responseData["status"] = "error";
    $this->responseData["code"] = "422";
    $this->responseData["message"] = "Invalid data";
    $this->responseData["httpCode"] = 422;
    return $this;
  }
  
  public function setType(string $type): Response
  {
    $this->type = $type;
    return $this;
  }

  public function setResponseData($responseData): Response
  {
    $this->responseData = $responseData;
    return $this;
  }

  private function setDefaultData(): Response
  {
    $this->type = "json";
    $this->responseData = [];
    $this->responseBuilder = (new ResponseBuilder());
    return $this;
  }
  
}