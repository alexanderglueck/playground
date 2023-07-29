<?php

namespace App\Support;

enum LayoutMode: string
{
    case EDIT = 'edit';
    case VIEW = 'view';
    case VALUE = 'value';
    case RAW = 'raw';
}
