<?php

namespace App\Http\Requests;

use App\Rules\ImageOrUrl;
use Illuminate\Foundation\Http\FormRequest;

class StoreEditApartmentRequest extends FormRequest
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
        return [
            'user_id' => ['exists:users,id'],
            'category_id' => ['exists:categories,id'],
            'title' => ['required', 'string', 'max:80'],
            'description' => ['required', 'string'],
            'room_number' => ['required', 'numeric', 'min:1'],
            'bed_number' => ['required', 'numeric', 'min:1'],
            'toilet_number' => ['required', 'numeric', 'min:1'],
            'square_meters' => ['required', 'numeric', 'min:1'],
            'img_url' => [new ImageOrUrl],
            'imageOrUrl' => ['required', 'string'],
            'is_visible' => [],
            'address' => ['required'],
            'longitude' => ['decimal:6'],
            'latitude' => ['decimal:6'],
            'services' => ['required', 'array'],
        ];
    }
}
