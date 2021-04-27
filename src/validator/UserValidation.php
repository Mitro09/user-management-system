<?php
namespace patrickmitrotti\usm\validator;

use patrickmitrotti\usm\entity\User;

class UserValidation {

    public const FIRTS_NAME_ERROR_NONE_MSG = 'Il nome è corretto'; 
    public const FIRTS_NAME_ERROR_REQUIRED_MSG = 'Il nome è obbligatorio'; 

    public const LAST_NAME_ERROR_NONE_MSG = 'Il cognome è corretto';
    public const LAST_NAME_ERROR_REQUIRED_MSG = 'Il cognome è obbligatorio';

    public const EMAIL_ERROR_NONE_MSG = 'Email corretta';
    public const EMAIL_ERROR_REQUIRED_MSG = 'Email obbligatoria';
    public const EMAIL_ERROR_MSG = 'Email errata';

    public const DATE_ERROR_NONE_MSG = 'La data è corretta';
    public const DATE_ERROR_REQUIRED_MSG = 'La data è obbligatoria';


    private $user;
    private $errors = [];
    private $isValid = true;

    public $firstNameResult;
    public $lastNameResult;
    public $emailResult;
    public $birthdayResult;

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
        $this->birthdayResult = $this->validateBirthday();
        $this->errors['birthday'] = $this->birthdayResult;
        

        if(!$this->firstNameResult->getIsValid() && 
           !$this->lastNameResult->getIsValid()  &&
           !$this->emailResult->getIsValid()     &&
           !$this->birthdayResult->getIsValid()){
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

    private function validateBirthday():?ValidationResult
    {
        $birthday = $this->user->getBirthday();
        if(empty($birthday)){
            $validationResult = new ValidationResult(self::DATE_ERROR_REQUIRED_MSG,false,$birthday);
        } else {
            $validationResult = new ValidationResult(self::DATE_ERROR_NONE_MSG,true,$birthday);
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


    /**
     * Get the value of isValid
     */ 
    public function getIsValid()
    {
        $this->isValid = true;
        foreach ($this->errors as $validation){
            $this->isValid = $this->isValid && $validation->getIsValid();
        }
        return $this->isValid;
    }


}