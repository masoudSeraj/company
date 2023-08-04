<?php
namespace Sunnyr\Company\Enums;

enum Types :int {
    case LANDSCAPE = 0;
    case PORTRAIT = 1;


    public function translate(): string
    {
        return match($this)
        {
            Types::LANDSCAPE   => 'افقی',
            Types::PORTRAIT   => 'عمودی'
        };
    }
}
