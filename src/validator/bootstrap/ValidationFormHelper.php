<?php

class ValidationFormHelper{

    public static function getValidationClass(ValidationResult $validationResult){
        $value = $validationResult->getValue();
        $formControlClass = $validationResult->getIsValid() ? 'is-valid' : 'is-invalid';
        $classMessage = $validationResult->getIsValid() ? 'valid-feedback' : 'invalid-feedback';
        $message = $validationResult->getMessage();

        return [$value,$formControlClass,$classMessage,$message];
    }

    public static function getDefault($defaultValue=''){
        $value = $defaultValue;
        $formControlClass = '';
        $classMessage = '';
        $message='';

        return [$value,$formControlClass,$classMessage,$message];
    }
}