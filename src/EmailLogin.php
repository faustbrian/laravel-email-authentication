<?php

namespace BrianFaust\EmailAuth;

class EmailLogin extends Model
{
    public $fillable = ['email', 'token'];

    public function user()
    {
        return $this->hasOne(
            config('email-authenticate.database.models.user'), 'email', 'email'
        );
    }

    public static function createForEmail($email)
    {
        return self::create([
            'email' => $email,
            'token' => str_random(20),
        ]);
    }

    public static function validFromToken($token)
    {
        $expiresAfter = Carbon::parse(config('email-authenticate.lifetime'));

        return self::where('token', $token)
            ->where('created_at', '>', $expiresAfter)
            ->firstOrFail();
    }
}
