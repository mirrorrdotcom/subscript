<?php

namespace App\Models;

use App\Contracts\Auditable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Consumer extends Model implements Auditable
{
    use Authenticatable, SoftDeletes;

    public const TOKEN_LENGTH = 60;

    protected $fillable = [
        "name", "description", "is_active",
    ];

    protected $guarded = [
        "api_token",
    ];

    protected $casts = [
        "is_active" => "boolean",
    ];

    public function generateAndSetNewApiToken()
    {
        $this->api_token = $this->generateUniqueConsumerApiToken();
        return $this;
    }

    private function generateUniqueConsumerApiToken()
    {
        do {
            $token = Str::random(self::TOKEN_LENGTH);
        } while (! empty(self::where('api_token', $token)->first()));

        return $token;
    }
}
