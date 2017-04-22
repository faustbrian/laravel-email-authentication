<?php



declare(strict_types=1);

namespace BrianFaust\EmailAuth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $usersTable = config('email-authenticate.database.users');

        return [
            'email' => 'required|email|exists:'.$usersTable,
        ];
    }
}
