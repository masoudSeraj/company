<?php

namespace Sunnyr\Company\Actions\Fortify;

use Sunnyr\Company\Rules\PasswordRule;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', new PasswordRule, 'confirmed'];
    }
}
