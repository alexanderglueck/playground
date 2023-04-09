<?php

namespace App\Support;

class Flash
{
    public static function created(Flashable $flashable): void
    {
        $message = __(':type was successfully created!');
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
}
