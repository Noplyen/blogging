<?php
namespace App\Exceptions;
class ValidationExceptions extends \Exception
{
    private array $validationMessage;
    public function __construct(string $message,?array $validationMessage)
    {
        parent::__construct($message);
        $this->validationMessage = $validationMessage;
    }

    public function getValidationMessage(): array
    {
        return $this->validationMessage;
    }
}