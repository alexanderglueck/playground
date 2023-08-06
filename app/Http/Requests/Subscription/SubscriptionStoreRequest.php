<?php

namespace App\Http\Requests\Subscription;

use App\Models\Plan;
use Illuminate\Validation\Rule;
use App\Rules\ValidStripeCoupon;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'plan' => [
                'required',
                Rule::exists(Plan::class, 'gateway_id')->where(function ($query) {
                    $query->where('active', true);
                })
            ],
            'token' => 'required',
            'coupon' => [
                'nullable', new ValidStripeCoupon()
            ]
        ];
    }
}
