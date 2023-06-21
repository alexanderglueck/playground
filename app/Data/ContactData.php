<?php

namespace App\Data;

use App\Models\Country;
use App\Models\View;

class ContactData
{
    public function __construct(
        public readonly ?string  $firstname,
        public readonly ?string  $name,
        public readonly ?string  $company,
        public readonly ?string  $vatId,
        public readonly ?string  $email,
        public readonly ?string  $phone,
        public readonly ?string  $mobilePhone,
        public readonly ?string  $fax,
        public readonly ?string  $dateOfBirth,
        public readonly ?string  $title,
        public readonly ?string  $titleAfter,
        public readonly ?string  $street,
        public readonly ?string  $zip,
        public readonly ?string  $city,
        public readonly ?Country $country,
        public readonly ?string  $gender,
        public readonly ?View    $view,
        public readonly array   $customFields,
        public readonly ?array   $contactGroups
    )
    {
    }

    public function toArray(): array
    {
        return [
            'firstname' => $this->firstname,
            'name' => $this->name,
            'company' => $this->company,
            'vat_id' => $this->vatId,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile_phone' => $this->mobilePhone,
            'fax' => $this->fax,
            'date_of_birth' => $this->dateOfBirth,
            'title' => $this->title,
            'title_after' => $this->titleAfter,
            'street' => $this->street,
            'zip' => $this->zip,
            'city' => $this->city,
            'country' => $this->country?->code,
            'view_id' => $this->view?->id,
        ];
    }
}
