<?php

function validate($data, $rules) {
    $errors = [];

    foreach ($rules as $field => $ruleSet) {
        $value = isset($data[$field]) ? $data[$field] : null;
        $ruleSet = explode('|', $ruleSet);

        foreach ($ruleSet as $rule) {
            if ($rule === 'required' && empty($value)) {
                $errors[$field][] = 'This field is required.';
            }

            if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field][] = 'This field must be a valid email address.';
            }

            if (strpos($rule, 'max:') === 0) {
                $maxLength = (int) substr($rule, 4);
                if (strlen($value) > $maxLength) {
                    $errors[$field][] = "This field must not exceed $maxLength characters.";
                }
            }

            if (strpos($rule, 'min:') === 0) {
                $minLength = (int) substr($rule, 4);
                if (strlen($value) < $minLength) {
                    $errors[$field][] = "This field must be at least $minLength characters.";
                }
            }

            // Puedes añadir más reglas aquí, como números, fechas, etc.
        }
    }

    return $errors;
}