<?php

namespace App\Http\Requests;

use App\Data\ContactData;
use App\Models\Contact;
use App\Models\Country;
use App\Models\View;
use App\Services\ViewValidationService;
use App\Support\ViewType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $viewValidationService = app(ViewValidationService::class);

        return $viewValidationService->getRules(Contact::getViewType(), $this->input('view'));
    }

    public function toData(): ContactData
    {
        $validated = $this->validated();

        return new ContactData(
            firstname: $validated['firstname'] ?? null,
            name: $validated['name'] ?? null,
            company: $validated['company'] ?? null,
            vatId: $validated['vat_id'] ?? null,
            email: $validated['email'] ?? null,
            phone: $validated['phone'] ?? null,
            mobilePhone: $validated['mobile_phone'] ?? null,
            fax: $validated['fax'] ?? null,
            dateOfBirth: $validated['date_of_birth'] ?? null,
            title: $validated['title'] ?? null,
            titleAfter: $validated['title_after'] ?? null,
            street: $validated['street'] ?? null,
            zip: $validated['zip'] ?? null,
            city: $validated['city'] ?? null,
            country: isset($validated['country']) ? Country::query()->where('code', '=', $validated['country'])->first() : null,
            gender: $validated['gender'] ?? null,
            view: isset($validated['view']) ? View::find($validated['view']) : null,
            customFields: $this->getCustomFields($validated),
            contactGroups: $validated['contact_group'] ?? null
        );
    }

    private function getCustomFields(array $validated): array
    {
        $keys = [];

        foreach ($validated as $key => $value) {
            if ( ! str_starts_with($key, 'custom_')) {
                continue;
            }

            $keys[$key] = $value;
        }

        return $keys;
    }
}
