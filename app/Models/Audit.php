<?php

namespace App\Models;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Audit extends Model
{
    protected $fillable = [
        "user_id", "action", "auditable_id", "auditable_type", "ip_address",
        "user_agent"
    ];

    public function auditable()
    {
        return $this->morphTo("auditable");
    }

    public static function log(string $action, ?Auditable $entity = null, array $extra = [])
    {
        $data = [
            "user_id" => self::getAuthenticatedUserId(),
            "action" => $action,
            "ip_address" => request()->ip(),
            "user_agent" => request()->userAgent(),
            "extra" => json_encode($extra),
        ];

        if ($entity) {
            $data["auditable_id"] = $entity->getKey();
            $data["auditable_type"] = $entity->getMorphClass();
        }

        Audit::create($data);
    }

    protected static function getAuthenticatedUserId(): ?int
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        return $user->id;
    }

    public static function logRegister(?Auditable $entity, array $extra = [])
    {
        self::log("register", $entity, $extra);
    }

    public static function logLogin(array $extra = [])
    {
        self::log("login", null, $extra);
    }

    public static function logLogout(array $extra = [])
    {
        self::log("logout", null, $extra);
    }

    public static function logView(?Auditable $entity = null, array $extra = [])
    {
        self::log("view", $entity, $extra);
    }

    public static function logCreate(?Auditable $entity = null, array $extra = [])
    {
        self::log("create", $entity, $extra);
    }

    public static function logUpdate(?Auditable $entity = null, array $extra = [])
    {
        self::log("update", $entity, $extra);
    }

    public static function logDelete(?Auditable $entity = null, array $extra = [])
    {
        self::log("delete", $entity, $extra);
    }
}
