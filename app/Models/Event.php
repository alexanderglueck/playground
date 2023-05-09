<?php

namespace App\Models;

use App\Support\EventChangeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use RuntimeException;

class Event extends Model
{
    protected $fillable = [
        'starts_at',
        'ends_at',
        'rrule'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function change(EventChangeType $changeType, array $changes)
    {
        switch ($changeType) {
            case EventChangeType::ALL:

                $original = Event::find($this->id);

                $parts = explode(';', $original->rrule);

                for ($i = 0; $i < count($parts); $i++) {
                    if (Str::startsWith($parts[$i], 'BYDAY=')) {
                        // Replace current day (e.g. Monday) (can be calculated from current date) with new posted day (eg Thursday) (can be calculated from new date)
                        // MO,TU

//                        $subParts = explode("BYDAY=", $parts[$i]);


                        $currentDay = match ($this->starts_at->format('N')) {
                            '1' => 'MO',
                            '2' => 'TU',
                            '3' => 'WE',
                            '4' => 'TH',
                            '5' => 'FR',
                            '6' => 'SA',
                            '7' => 'SU',
                        };

                        $newDay = match ((Carbon::parse($changes['starts_at']))->format('N')) {
                            '1' => 'MO',
                            '2' => 'TU',
                            '3' => 'WE',
                            '4' => 'TH',
                            '5' => 'FR',
                            '6' => 'SA',
                            '7' => 'SU',
                            default => throw new \Exception('Unexpected match value'),
                        };

                        $parts[$i] = Str::replace($currentDay, $newDay, $parts[$i]);

                        continue;
                    }

                    // TODO handle case of weekly, original start date has to be changed


                }

                $original->rrule = implode(';', $parts);

                // Also update the RRule if the event is changed to another day
                $original->update();
                break;

            case EventChangeType::SINGLE:
                // Replicate the event
                $event = $this->replicate();
                // Remove the rrule
                $event->rrule = null;
                $event->parent_event_id = $this->parent_event_id ?? $this->id;
                // Apply the changes
                $event->fill($changes)->save();

                // Exclude the event from the original events patterns
                $this->excludedDates()->create([
                    'date' => $this->starts_at
                ]);
                break;
            case EventChangeType::FUTURE:

                $original = Event::find($this->id);
                $event = $original->replicate();
                // Also update RRule to start today

                // Update original until, if no until present, add it

                $parts = explode(';', $this->rrule);

                for ($i = 0; $i < count($parts); $i++) {
                    if (Str::startsWith($parts[$i], 'BYDAY=')) {
                        // Replace current day (e.g. Monday) (can be calculated from current date) with new posted day (eg Thursday) (can be calculated from new date)
                        // MO,TU

//                        $subParts = explode("BYDAY=", $parts[$i]);


                        $currentDay = match ($this->starts_at->format('N')) {
                            '1' => 'MO',
                            '2' => 'TU',
                            '3' => 'WE',
                            '4' => 'TH',
                            '5' => 'FR',
                            '6' => 'SA',
                            '7' => 'SU',
                        };

                        $newDay = match ((Carbon::parse($changes['starts_at']))->format('N')) {
                            '1' => 'MO',
                            '2' => 'TU',
                            '3' => 'WE',
                            '4' => 'TH',
                            '5' => 'FR',
                            '6' => 'SA',
                            '7' => 'SU',
                            default => throw new \Exception('Unexpected match value'),
                        };

                        $parts[$i] = Str::replace($currentDay, $newDay, $parts[$i]);

                        continue;
                    }

                    // TODO handle case of weekly, original start date has to be changed


                }

                $event->rrule = implode(';', $parts);
                $event->fill($changes);
                $event->parent_event_id = $original->parent_event_id ?? $original->id;
                // Also update the RRule if the event is changed to another day
                $event->save();


                $endingRrule = $original->rrule;
                if (Str::contains($endingRrule, 'UNTIL=')) {
                    $parts = explode(';', $this->rrule);

                    for ($i = 0; $i < count($parts); $i++) {
                        if (Str::startsWith($parts[$i], 'UNTIL=')) {
                            $parts[$i] = 'UNTIL=' . ($this->starts_at->subDay(1)->format('Ymd')) . 'T' . $this->starts_at->format('His');
                            break;
                        }
                    }
                    $endingRrule = implode(';', $parts);
                } else {
                    $endingRrule .= ';UNTIL=' . ($this->starts_at->subDay(1)->format('Ymd')) . 'T' . $this->starts_at->format('His');
                }

                // Also update RRule to end today
                $original->update([
                    'rrule' => $endingRrule
                ]);
                break;

            default:
                throw new RuntimeException("Invalid EventChangeType encountered");
        }
    }

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
        $event = [
            "id" => $this->id . '_' . $this->starts_at->format('YmdHis'),
            "title" => $this->name,
            "start" => $this->localizedStartDateTime(),

            'extendedProps' => [
                'is_virtual' => $this->isRecurring(),
            ]
        ];

        if ($this->is_all_day) {
            $event["all_day"] = true;
        } else {
            $event["end"] = $this->localizedEndDateTime();
        }

        return $event;
    }
}
