<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Event::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'event_date_time' => ['required', 'date', 'after:now'],
            'location' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(Event::categories)],
            'status' => ['required', Rule::in(Event::statuses)],
            'capacity' => ['required', 'integer', 'min:1', 'max:1000'],
        ];
    }
}
