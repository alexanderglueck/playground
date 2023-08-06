<?php

namespace App\Rules;

use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Stripe\Coupon;

class ValidStripeCoupon implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $coupon = Coupon::retrieve($value);

            if ( ! $coupon->valid) {
                $fail('The coupon is invalid.');
            }
        } catch (Exception $ex) {
            $fail('The coupon does not exist.');
        }
    }
}
