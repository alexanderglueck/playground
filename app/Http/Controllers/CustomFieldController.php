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

    public function index()
    {
        return view('custom_fields.index', [
            'viewTypes' => ViewType::class
        ]);
    }

    public function create(ViewType $viewType)
    {
        return view('custom_fields.create', [
            'viewType' => $viewType,
            'fields' => $this->customFieldService->getCustomFields($viewType)
        ]);
    }

    public function store(ViewType $viewType, CustomFieldRequest $request)
    {
        try {
            $field = $this->customFieldService->createCustomField($request->user(), $request->toData(), $viewType);
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        return redirect()->route('custom_fields.create', $viewType);
    }
}
