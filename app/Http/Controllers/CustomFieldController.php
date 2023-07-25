<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomFieldRequest;
use App\Models\Field;
use App\Services\CustomFieldService;
use App\Support\ViewType;
use Illuminate\Http\Request;
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

    public function show(ViewType $viewType)
    {
        return view('custom_fields.show', [
            'viewType' => $viewType,
            'fields' => $this->customFieldService->getCustomFields($viewType)
        ]);
    }

    public function create(ViewType $viewType)
    {
        return view('custom_fields.create', [
            'viewType' => $viewType,
        ]);
    }

    public function store(ViewType $viewType, CustomFieldRequest $request)
    {
        try {
            $field = $this->customFieldService->createCustomField($request->user(), $request->toData(), $viewType);
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->withException($e);
        }

        return redirect()->route('custom_fields.show', $viewType);
    }

    public function destroy(Request $request, ViewType $viewType, Field $field)
    {
        abort_if($field->is_custom == 0, 403);

        $this->customFieldService->deleteCustomField($request->user(), $field);

        return redirect()->route('custom_fields.show', $viewType);
    }
}
