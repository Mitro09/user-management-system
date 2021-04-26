<?php

class UserValidation {

    public const FIRTS_NAME_ERROR_NONE_MSG = 'Il nome è corretto'; 
    public const FIRTS_NAME_ERROR_REQUIRED_MSG = 'Il nome è obbligatorio'; 

    public const LAST_NAME_ERROR_NONE_MSG = 'Il cognome è corretto';
    public const LAST_NAME_ERROR_REQUIRED_MSG = 'Il cognome è obbligatorio';

    public const EMAIL_ERROR_NONE_MSG = 'Email corretta';
    public const EMAIL_ERROR_REQUIRED_MSG = 'Email obbligatoria';
    public const EMAIL_ERROR_MSG = 'Email errata';


    private $user;
    private $errors = [];
    private $isValid = true;

    public $firstNameResult;
    public $lastNameResult;
    public $emailResult;

    public function __construct(User $user) {
        $this->user = $user;
        $this->validate();
    }

    private function validate()
    {   
        $this->firstNameResult =  $this->validateFirstName();
        $this->errors['firstName'] = $this->firstNameResult;
        $this->lastNameResult = $this->validateLastName();
        $this->errors['lastName'] = $this->lastNameResult;
        $this->emailResult = $this->validateEmail();
        $this->errors['email'] = $this->emailResult;
        

        if(!$this->firstNameResult->getIsValid() && 
           !$this->lastNameResult->getIsValid()  &&
           !$this->emailResult->getIsValid()){
                $this->isValid = false;   
        }


    }

    private function validateFirstName():?ValidationResult
    {
        $firstName = trim($this->user->getFirstName());
        if(empty($firstName)){
            $validationResult = new ValidationResult(self::FIRTS_NAME_ERROR_REQUIRED_MSG,false,$firstName);
        } else {
            $validationResult = new ValidationResult(self::FIRTS_NAME_ERROR_NONE_MSG,true,$firstName);
        };
        return $validationResult;
    }

    private function validateLastName():?ValidationResult
    {
        $lastName = trim($this->user->getLastName());
        if(empty($lastName)){
            $validationResult = new ValidationResult(self::LAST_NAME_ERROR_REQUIRED_MSG,false,$lastName);
        } else {
            $validationResult = new ValidationResult(self::LAST_NAME_ERROR_NONE_MSG,true,$lastName);
        };
        return $validationResult;
    }

    private function validateEmail():?ValidationResult
    {
        $email = trim($this->user->getEmail());
        if(empty($email)){
            $validationResult = new ValidationResult(self::EMAIL_ERROR_REQUIRED_MSG,false,$email);
        } else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $validationResult = new ValidationResult(self::EMAIL_ERROR_MSG,false,$email);
        }
        else{
            $validationResult = new ValidationResult(self::EMAIL_ERROR_NONE_MSG,true,$email);
        }
        return $validationResult;
    }

    /**
     *  foreach($userValidation->getErrors() as $error ){
     *   echo "<li</li>"
     *  }
     * 
     */
    public function getErrors()
    {
        return $this->errors; 
    }

    /**
     * $userValidation->getError('firstName');
     * @var ValidationResult $errorKey Chiave associativa che contiene un ValidationResult corrispondente
     */
    public function getError($errorKey)
    {
        return $this->errors[$errorKey];
    }

}