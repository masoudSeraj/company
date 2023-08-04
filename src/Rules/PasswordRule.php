<?php

namespace Sunnyr\Company\Rules;

use Laravel\Fortify\Rules\Password;

class PasswordRule extends Password
{
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->message) {
            return $this->message;
        }

        switch (true) {
            case $this->requireUppercase
            && ! $this->requireNumeric
            && ! $this->requireSpecialCharacter:
                    return __('گزینه :attribute باید حد اقل طول :length کاراکتر باشد و حداقل یک حرف بزرگ داشته باشد!', [

                    'length' => $this->length,
                ]);

            case $this->requireNumeric
            && ! $this->requireUppercase
            && ! $this->requireSpecialCharacter:
                    return __('گزینه :attribute باید حداقل طول :length و حداقل حاوی یک عدد باشد!', [

                    'length' => $this->length,
                ]);

            case $this->requireSpecialCharacter
            && ! $this->requireUppercase
            && ! $this->requireNumeric:
                    return __('گزینه :attribute باید حداقل طول :length داشته باشد و حداقل یک کاراکتر خاص داشته باشد', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
            && $this->requireNumeric
            && ! $this->requireSpecialCharacter:
                return __('گزینه :attribute باید حداقل :length کاراکتر داشته باشد و حداقل حاوی یک حرف بزرگ باشد!', [

                    'length' => $this->length,
                    
                ]);

            case $this->requireUppercase
            && $this->requireSpecialCharacter
            && ! $this->requireNumeric:
                return __('گزینه :attribute باید حداقل :length باشد و حداقل حاوی یک کاراکتر حرف بزرگ و یک کاراکتر خاص باشد!', [

                    'length' => $this->length,
                ]);

            case $this->requireUppercase
            && $this->requireNumeric
            && $this->requireSpecialCharacter:
                    return __('گزینه :attribute باید حداقل :length کااکتر باشد و حاوی حداقل یک حرف بزرگ، یک عدد و یک حرف خاص باشد!', [
                    'length' => $this->length,
                ]);

            case $this->requireNumeric
            && $this->requireSpecialCharacter
            && ! $this->requireUppercase:
                return __('گزینه :attribute باید حداقل تعداد :length کاراکتر داشته باشد و و حاوی حداقل یک کاراکتر خاص و یک عدد باشد!', [

                    'length' => $this->length,
                ]);

            default:
                return __('گزینه :attribute باید حداقل حاوی :length کاراکتر باشد!', [
                    'length' => $this->length,
                ]);
        }
    }
}
