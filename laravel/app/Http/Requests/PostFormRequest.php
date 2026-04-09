<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Barryvdh\Debugbar\Facade as DebugBar;

class PostFormRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    // Debugbar::info($this->user());

    return true;
    // if ($this->user()->can_post()) {
    // }
    // return false;
  }
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => 'required|unique:posts|max:255',
      'title' => array('Regex:/^[A-Za-z0-9 ]+$/'),
      'body' => 'required',
    ];
  }
}
