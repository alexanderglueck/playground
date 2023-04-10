<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function isRecurring(): bool
    {
        return $this->rrule !== null;
    }

    public function localizedStartDateTime()
    {
        return $this->starts_at->timezone("Europe/Vienna")->format('Y-m-d H:i:s');
    }

    public function originStartDateTime()
    {
        return $this->starts_at->timezone($this->timezone)->format('Y-m-d H:i:s');
    }

    public function localizedEndDateTime()
    {
        return $this->ends_at->timezone("Europe/Vienna")->format('Y-m-d H:i:s');
    }

    public function originEndDateTime()
    {
        return $this->ends_at->timezone($this->timezone)->format('Y-m-d H:i:s');
    }

    public function excludedDates(): HasMany
    {
        return $this->hasMany(ExcludedDate::class);
    }

    public function toArray()
    {
        return [
            ...parent::toArray(),
            'localizedStartDateTime' => $this->localizedStartDateTime(),
            'originStartDateTime' => $this->originStartDateTime(),
            'localizedEndDateTime' => $this->localizedEndDateTime(),
            'originEndDateTime' => $this->originEndDateTime(),
        ];
    }

    public function toFullCalendarEvent(): array
    {
        if ($this->is_all_day) {
            return [
                "title" => $this->name,
                "start" => $this->localizedStartDateTime(),
                "all_day" => true
            ];
        }

        return [
            "title" => $this->name,
            "start" => $this->localizedStartDateTime(),
            "end" => $this->localizedEndDateTime()
        ];
    }
}
