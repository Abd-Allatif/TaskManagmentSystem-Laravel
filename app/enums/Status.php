<?php

namespace App\enums;

enum Status: int{
    case Pending = 0;
    case In_Progress = 2;
    case Completed = 4;
    case Expired = 6;
}