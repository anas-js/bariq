<?php

namespace App\Http\Requests\DashboardController;

use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class incomeReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 'string'
        return [
            'timeline' => ['required', function (string $attr, mixed $value, Closure $falis) {
                $date = json_decode($value, true) ?? $value;

                // dd($date["start"]);
                if (is_array($date)) {
                    if (!isset($date['start']) || !isset($date['end'])) {
                        $falis('start and end requerd');
                        return;
                    }


                    try {
                        $dateStart = Carbon::parse($date['start']);
                        $dateEnd =  Carbon::parse($date['end']);

                        if ($dateStart->greaterThan($dateEnd)) {
                            $falis('date end must smaller');
                        }
                    } catch (Exception $e) {
                        $falis('type date error');
                    }
                    // dd('is Array');
                    $this->merge(['isArray' => true]);

                } else if (is_string($date) || is_int($date)) {
                    if (!in_array($date, ["0", "1", "m", "30", '365', 'all'])) {
                        $falis('select date type error');
                    }

                    $this->merge(['isArray' => false]);
                    // request()->merge(['isArray' => false]);
                } else {
                    $falis('data type error');
                }

            }],
        ];
    }
}
