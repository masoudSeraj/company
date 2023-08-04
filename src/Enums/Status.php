<?php
namespace Sunnyr\Company\Enums;

enum Status :int {
    case INACTIVE = 0;
    case ACTIVE = 1;


    public function translate(): string
    {
        return match($this)
        {
            Status::ACTIVE   => 'فعال',
            Status::INACTIVE   => 'غیر فعال'
        };
    }
}