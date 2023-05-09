<?php

namespace App\Support;

use App\Models\Event;
use App\Models\ExcludedDate;
use Carbon\Carbon;
use DateTimeImmutable;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Recurr\Exception\InvalidRRule;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use Recurr\Transformer\ArrayTransformerConfig;
use Recurr\Transformer\Constraint\AfterConstraint;
use Recurr\Transformer\Constraint\BeforeConstraint;
use Recurr\Transformer\Constraint\BetweenConstraint;

class EventGenerator
{
    // TODO See https://news.ycombinator.com/item?id=18477975
    public static function events($startUtc, $endUtc)
    {
        $events = self::getEvents($startUtc, $endUtc);

        $finalEvents = [];

        /** @var Event $event */
        foreach ($events as $event) {
            if ( ! $event->isRecurring()) {
                $finalEvents[] = $event;
                continue;
            }

            $generatedEvents = self::generateEvents($event, $startUtc, $endUtc);

            foreach ($generatedEvents as $generatedEvent) {
                $finalEvents[] = $generatedEvent;
            }
        }

        return $finalEvents;
    }

    public static function generateEvents(Event $event, $startUtc = null, $endUtc = null): array
    {
        try {
            if ($startUtc == null && $endUtc == null) {
                $constraint = null;
            } else if ($startUtc != null && $endUtc == null) {
                $constraint = new AfterConstraint(new DateTimeImmutable($startUtc), true);
            } else if ($startUtc == null && $endUtc != null) {
                $constraint = new BeforeConstraint(new DateTimeImmutable($endUtc), true);
            } else {
                $constraint = new BetweenConstraint(new DateTimeImmutable($startUtc), new DateTimeImmutable($endUtc), true);
            }
        } catch (Exception $exception) {
            Log::error('Invalid filter received! ' . $exception->getMessage(), $exception->getTrace());
            return [];
        }

        $transformer = new ArrayTransformer();

        $transformerConfig = new ArrayTransformerConfig();
        $transformerConfig->enableLastDayOfMonthFix();
        $transformer->setConfig($transformerConfig);

        try {
            $rule = new Rule($event->rrule,
                $event->starts_at->timezone($event->timezone),
                $event->ends_at->timezone($event->timezone),
                $event->timezone
            );
        } catch (InvalidRRule $exception) {
            Log::error('Invalid filter received! ' . $exception->getMessage(), $exception->getTrace());
            return [];
        }

        $rule->setExDates($event->excludedDates->map(function (ExcludedDate $excludedDate) {
            return $excludedDate->date;
        })->toArray());

        $events = [];
        foreach ($transformer->transform($rule, $constraint) as $recurrence) {
            $generatedEvent = $event->replicate();
            $generatedEvent->id = $event->id;
            $generatedEvent->starts_at = Carbon::createFromInterface($recurrence->getStart())->shiftTimezone($event->timezone)->setTimezone("UTC");
            $generatedEvent->ends_at = Carbon::createFromInterface($recurrence->getEnd())->shiftTimezone($event->timezone)->setTimezone("UTC");

            $events[] = $generatedEvent;
        }

        return $events;
    }

    private static function getEvents($startUtc, $endUtc): Collection
    {
        return Event::query()
            ->with('excludedDates')
            ->where(function (Builder $query) use ($startUtc, $endUtc) {
                $query->whereNull('rrule')
                    ->where('starts_at', '>=', $startUtc)
                    ->where('starts_at', '<=', $endUtc);
            })
            ->orWhere(function (Builder $query) use ($endUtc) {
                // We don't want events with rrules that start in the future, only past events.
                // We can't filter for <= endDate because of the recurring events
                $query->whereNotNull('rrule')
                    ->where('starts_at', '<=', $endUtc);
            })
            ->get();
    }

    public static function getRecurringEventInstance(Event $event, string $startsAt): Event
    {
        $events = self::generateEvents($event, $startsAt, (int)$startsAt + 1);

        if (isset($events[0])) {
            return $events[0];
        }

        throw new ModelNotFoundException('Recurring event instance could not be found');
    }
}
