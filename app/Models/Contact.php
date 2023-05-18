<?php

namespace App\Models;

use App\Models\Scopes\LimitContactsScope;
use App\Support\AccessRight;
use App\Support\CanBeFlashed;
use App\Support\CustomContact;
use App\Support\CustomFielded;
use App\Support\Flashable;
use App\Support\HasCustomFields;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Contact extends Model implements CustomFielded, Flashable
{
    use HasFactory, HasCustomFields, CanBeFlashed;

    protected static function booted(): void
    {
        Model::addGlobalScope(new LimitContactsScope());
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

    public function getViewType(): ViewType
    {
        return ViewType::CONTACT;
    }

    public function getCustomFieldClass(): string
    {
        return CustomContact::class;
    }

    public function scopeVisibleTo(Builder $query, User $user): void
    {
        $query->whereExists(function (QueryBuilder $query) use ($user) {
            $query->select('contact_contact_group.contact_id')
                ->from('contact_contact_group')
                ->join('contact_group_user', 'contact_group_user.contact_group_id', '=', 'contact_contact_group.contact_group_id')
                ->whereIn('contact_group_user.privilege', [AccessRight::READ, AccessRight::WRITE])
                ->where('contact_group_user.user_id', '=', $user->id)
                ->whereColumn('contact_contact_group.contact_id', '=', 'contacts.id');
        });
    }
}
