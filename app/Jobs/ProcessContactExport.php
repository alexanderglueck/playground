<?php

namespace App\Jobs;

use App\Models\ContactExport;
use App\Models\User;
use App\Notifications\ContactExportFinished;
use App\Services\ContactService;
use App\Services\FieldService;
use App\Support\LayoutMode;
use App\Support\ViewType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ProcessContactExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User          $user,
        private ContactExport $contactExport
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ContactService $contactService, FieldService $fieldService): void
    {
        $fields = $fieldService->getFields(ViewType::CONTACT);

        $headers = [];

        foreach ($fields as $field) {
            $headers[] = $field->getNameForLabel();
        }

        if (Storage::directoryMissing('public')) {
            Storage::createDirectory('public');
        }

        $writer = SimpleExcelWriter::create(Storage::path('public/' . $this->contactExport->file_path))
            ->addHeader($headers);

        $contacts = $this->contactExport->contactGroup->contacts;

        foreach ($contacts as $contact) {
            $row = [];
            foreach ($fields as $field) {
                $row[] = $contact->renderField($field, LayoutMode::RAW);
            }

            $writer->addRow($row);
        }

        $this->contactExport->completed_at = now();
        $this->contactExport->save();

        $this->user->notify(new ContactExportFinished($this->contactExport->file_path));
    }
}
