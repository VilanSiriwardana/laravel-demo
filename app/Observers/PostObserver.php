<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\AuditLog;

class PostObserver
{
    public function created(Post $post)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'created',
            'auditable_type' => Post::class,
            'auditable_id' => $post->id,
            'new_values' => $post->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function updated(Post $post)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'auditable_type' => Post::class,
            'auditable_id' => $post->id,
            'old_values' => $post->getOriginal(),
            'new_values' => $post->getChanges(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function deleted(Post $post)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'auditable_type' => Post::class,
            'auditable_id' => $post->id,
            'old_values' => $post->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
