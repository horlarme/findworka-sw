<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Contracts\Validation\Validator;

class ValidationException extends Exception
{
    private $bag;

    /**
     * ValidationException constructor.
     * @param Validator|MessageBag $bag
     */
    public function __construct($bag)
    {
        parent::__construct('Validation Error');
        if ($bag instanceof MessageBag) {
            $this->bag = $bag->all();
        } elseif ($bag instanceof Validator) {
            $this->bag = $bag->errors();
        }
    }

    public function getErrors()
    {
        return $this->bag;
    }
}
