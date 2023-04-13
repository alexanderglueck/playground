<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Shareable
{
    public function share(): string;

    public function shareableLinks(): MorphMany;
}
