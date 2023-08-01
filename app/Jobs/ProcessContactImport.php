<?php

namespace App\Jobs;

use App\Data\ContactData;
use App\Models\ContactImport;
use App\Models\Country;
use App\Models\User;
use App\Notifications\ContactImportFinished;
use App\Services\ContactService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SimpleExcel\SimpleExcelReader;

class ProcessContactImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User          $user,
        private ContactImport $contactImport,
        private bool          $skipHeader,
        private array         $mapping
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ContactService $contactService): void
    {
        $import = SimpleExcelReader::create(\Storage::path($this->contactImport->file_path));

        $flippedMapping = array_flip($this->mapping);

        if ( ! $this->skipHeader) {
            $temp = [];
            foreach ($this->mapping as $key => $value) {
                $temp[$key] = $key;
            }

            $contactData = new ContactData(
                firstname: $this->getMappedValue($temp, $flippedMapping, 'firstname'),
                name: $this->getMappedValue($temp, $flippedMapping, 'name'),
                company: $this->getMappedValue($temp, $flippedMapping, 'company'),
                vatId: $this->getMappedValue($temp, $flippedMapping, 'vat_id'),
                email: $this->getMappedValue($temp, $flippedMapping, 'email'),
                phone: $this->getMappedValue($temp, $flippedMapping, 'phone'),
                mobilePhone: $this->getMappedValue($temp, $flippedMapping, 'mobile_phone'),
                fax: $this->getMappedValue($temp, $flippedMapping, 'fax'),
                dateOfBirth: $this->getMappedValue($temp, $flippedMapping, 'date_of_birth'),
                title: $this->getMappedValue($temp, $flippedMapping, 'title'),
                titleAfter: $this->getMappedValue($temp, $flippedMapping, 'title_after'),
                street: $this->getMappedValue($temp, $flippedMapping, 'street'),
                zip: $this->getMappedValue($temp, $flippedMapping, 'zip'),
                city: $this->getMappedValue($temp, $flippedMapping, 'city'),
                country: isset($flippedMapping['country']) ? Country::query()->where('code', '=', $temp[$flippedMapping['country']])->first() : null,
                gender: $this->getMappedValue($temp, $flippedMapping, 'gender'),
                view: null,
                customFields: $this->getCustomFields($temp),
                contactGroups: $this->getMappedValue($temp, $flippedMapping, 'contact_group')
            );

            $contactService->createContact($this->user, $contactData);
        }

        $import
            ->getRows()
            ->each(function (array $rowProperties) use ($contactService, $flippedMapping) {
                $contactData = new ContactData(
                    firstname: $this->getMappedValue($rowProperties, $flippedMapping, 'firstname'),
                    name: $this->getMappedValue($rowProperties, $flippedMapping, 'name'),
                    company: $this->getMappedValue($rowProperties, $flippedMapping, 'company'),
                    vatId: $this->getMappedValue($rowProperties, $flippedMapping, 'vat_id'),
                    email: $this->getMappedValue($rowProperties, $flippedMapping, 'email'),
                    phone: $this->getMappedValue($rowProperties, $flippedMapping, 'phone'),
                    mobilePhone: $this->getMappedValue($rowProperties, $flippedMapping, 'mobile_phone'),
                    fax: $this->getMappedValue($rowProperties, $flippedMapping, 'fax'),
                    dateOfBirth: $this->getMappedValue($rowProperties, $flippedMapping, 'date_of_birth'),
                    title: $this->getMappedValue($rowProperties, $flippedMapping, 'title'),
                    titleAfter: $this->getMappedValue($rowProperties, $flippedMapping, 'title_after'),
                    street: $this->getMappedValue($rowProperties, $flippedMapping, 'street'),
                    zip: $this->getMappedValue($rowProperties, $flippedMapping, 'zip'),
                    city: $this->getMappedValue($rowProperties, $flippedMapping, 'city'),
                    country: isset($flippedMapping['country']) ? Country::query()->where('code', '=', $rowProperties[$flippedMapping['country']])->first() : null,
                    gender: $this->getMappedValue($rowProperties, $flippedMapping, 'gender'),
                    view: null,
                    customFields: $this->getCustomFields($rowProperties),
                    contactGroups: $this->getMappedValue($rowProperties, $flippedMapping, 'contact_group')
                );

                $contactService->createContact($this->user, $contactData);
            });

        \Storage::delete($this->contactImport->file_path);

        $this->contactImport->completed_at = now();
        $this->contactImport->save();

        $this->user->notify(new ContactImportFinished());
    }

    private function getMappedValue(array $rowProperties, array $flippedMapping, string $key): ?string
    {
        return isset($flippedMapping[$key]) ? $rowProperties[$flippedMapping[$key]] : null;
    }

    private function getCustomFields(array $validated): array
    {
        $keys = [];

        foreach ($validated as $key => $value) {
            if ( ! str_starts_with($this->mapping[$key], 'custom_')) {
                continue;
            }

            $keys[$key] = $value;
        }

        return $keys;
    }
}
