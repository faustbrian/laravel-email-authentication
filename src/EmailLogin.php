<?php



declare(strict_types=1);

namespace BrianFaust\EmailAuth;

use Illuminate\Database\Eloquent\Relations\HasOne;

class EmailLogin extends Model
{
    public $fillable = ['email', 'token'];

    public function user(): HasOne
    {
        return $this->hasOne(
            config('email-authenticate.database.models.user'), 'email', 'email'
        );
    }

    public static function createForEmail($email): self
    {
        return self::create([
            'email' => $email,
            'token' => str_random(20),
        ]);
    }

    public static function validFromToken($token): self
    {
        $expiresAfter = Carbon::parse(config('email-authenticate.lifetime'));

        return self::where('token', $token)
            ->where('created_at', '>', $expiresAfter)
            ->firstOrFail();
    }
}
