<?php

namespace App\Support;

class Flash
{
    private static function message(Flashable $flashable, string $message): void
    {
        $replace = [
            'type' => $flashable->getFlashType(),
            'name' => e($flashable->getFlashName()),
        ];

        if ($flashable->hasShowRoute()) {
            $message .= ' <b><a href=":url">:name</a></b>';
            $replace['url'] = $flashable->getShowRoute();
        }

        flash(__($message, $replace))->success();
    }

    public static function created(Flashable $flashable): void
    {
        $message = __(':type was successfully created!');

        self::message($flashable, $message);
    }

    public static function updated(Flashable $flashable): void
    {
        $message = __(':type was successfully updated!');

        self::message($flashable, $message);
    }
}
