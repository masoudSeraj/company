<?php

namespace Sunnyr\Company\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Sunnyr\Company\Actions\Fortify\PasswordValidationRules;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => [
                'required',
                'string',
                'max:255',
            ],
            'username' => ['required', 'unique:users', 'max:13', 'regex:/09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/'],
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required',
        ], [
            'lastname.required' => 'ورود نام خانوادگی الزامی است!',
            'name.required' => 'نام الزامی است',
            'max'   => 'تعداد کاراکتر ها بیش از حد مجاز است!',
            'min'  =>  'تعداد کاراکترها کمتر از حد مجاز است',
            'username.unique'   =>  'شماره تماس قبلا در سیستم ثبت شده است!',
            'username.regex'    =>  'فرمت شماره موبایل معتبر نیست'
        ])->validate();

        $user =  User::create([
            'first_name' => $input['name'],
            'last_name' => $input['lastname'],
            'username'  =>  $input['username'],
            'password' => Hash::make($input['password']),
        ]);

        return $user;
    }
}
