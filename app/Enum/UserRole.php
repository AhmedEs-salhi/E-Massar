<?php

namespace App\Enum;

enum UserRole: string
{
    case Admin = "Admin";
    case Teacher = "Teacher";
    case Student = "Student";
}
