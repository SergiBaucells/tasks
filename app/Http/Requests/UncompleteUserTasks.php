<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UncompleteUserTasks extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('user.tasks.uncomplete');
//        return Auth::user()->can('task.store');
//        return Auth::user()->isSuperAdmin() || Auth::user()->hasRole('TaskManager') ||
//            Auth::user()->id === ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
