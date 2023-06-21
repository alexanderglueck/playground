<?php

namespace App\Models;

use App\Models\Scopes\LimitContactsScope;
use App\Support\CanBeFlashed;
use App\Support\CustomContact;
use App\Support\CustomFielded;
use App\Support\Flashable;
use App\Support\HasCustomFields;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model implements CustomFielded, Flashable
{
    use HasFactory, HasCustomFields, CanBeFlashed;

    protected $fillable = [
        'firstname',
        'name',
        'company',
        'vat_id',
        'email',
        'phone',
        'mobile_phone',
        'fax',
        'date_of_birth',
        'title',
        'title_after',
        'street',
        'zip',
        'city',
        'country',
        'gender',
        'view_id'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new LimitContactsScope());
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function contactGroups(): BelongsToMany
    {
        return $this->belongsToMany(ContactGroup::class)
            ->withTimestamps();
    }

    public static function getViewType(): ViewType
    {
        return ViewType::CONTACT;
    }

    public function getCustomFieldClass(): string
    {
        return CustomContact::class;
    }

    public function getFlashName(): string
    {
        return trim($this->title . ' ' . $this->firstname . ' ' . $this->name . ', ' . $this->title_after);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getThreadedComments()
    {
        return $this->comments()->with('user')->get()->threaded();
    }
}
