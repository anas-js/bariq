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
           'timeline'=> ['required',function (string $attr, mixed $value, Closure $falis) {
            if(is_array($value)) {
                if(!isset($value['start']) || !isset($value['end'])) {
                    $falis('start and end requerd');
                    return;
            }


                try {
                  $dateStart = Carbon::parse($value['start']);
                  $dateEnd =  Carbon::parse($value['end']);

                  if($dateStart->greaterThan($dateEnd)) {
                    $falis('date end must smaller');
                  }

                } catch(Exception $e){
                    $falis('type date error');
                }

                $this->merge(['isArray'=>true]);

            } else if (is_string($value)) {
                if(!in_array($value,["0","1","m","30",'365','all'])) {
                    $falis('select date type error');
                }

                $this->merge(['isArray'=>false]);
            } else {
                $falis('data type error');
            }


           }],
        ];
    }
}
