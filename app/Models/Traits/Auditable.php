<?php

namespace App\Models\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    /**
     * Boot the trait.
     */
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->logAudit('created');
        });

        static::updated(function ($model) {
            $model->logAudit('updated');
        });

        static::deleted(function ($model) {
            $model->logAudit('deleted');
        });
    }

    /**
     * Log an audit entry.
     */
    public function logAudit(string $action)
    {
        $user = Auth::user();
        $request = Request::instance();

        AuditLog::create([
            'user_id' => $user ? $user->id : null,
            'action' => $action,
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'old_values' => $action === 'updated' ? $this->getOriginal() : null,
            'new_values' => $action === 'deleted' ? null : $this->getAttributes(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
} 