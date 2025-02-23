<?php
/**
 *  + message: string
    + isValid: bool
    + value: any
 */
namespace patrickmitrotti\usm\validator;
class ValidationResult {

    public function __construct($message,$isValid,$value){
        $this->message = $message;
        $this->isValid = $isValid;
        $this->value = $value;
    }

    private $message ;
    private $isValid ;


    /**
     * Get the value of isValid
     */ 
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * Set the value of isValid
     *
     * @return  self
     */ 
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

        /**
         * Get the value of value
         */ 
        public function getValue()
        {
                return $this->value;
        }

        /**
         * Set the value of value
         *
         * @return  self
         */ 
        public function setValue($value)
        {
                $this->value = $value;

                return $this;
        }
}
