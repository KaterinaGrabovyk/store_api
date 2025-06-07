<?php
namespace App\Exceptions;

use Exception;

class NoRouterException extends \Exception{
   protected $message='404';
}