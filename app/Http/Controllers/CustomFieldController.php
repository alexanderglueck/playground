<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomFieldRequest;
use App\Services\CustomFieldService;
use App\Support\ViewType;
use RuntimeException;

class CustomFieldController extends Controller
{
    public function __construct(private readonly CustomFieldService $customFieldService)
    {
    }

    public function create()
    {
        return view('custom_fields.create');
    }

    public function store(ViewType $viewType, CustomFieldRequest $request)
    {
        try {
            $field = $this->customFieldService->createCustomField($request->user(), $request->toData(), $viewType);
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        return redirect()->route('custom_fields.create');
    }
}
