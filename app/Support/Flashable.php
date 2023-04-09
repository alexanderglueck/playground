<?php

namespace App\Support;

interface Flashable
{
    public function getFlashType(): string;

    public function getFlashName(): string;

    public function hasShowRoute(): bool;

    public function getShowRoute(): string;
}
