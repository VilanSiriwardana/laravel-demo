<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Log;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = AuditLog::with('user')->latest();

            if ($request->filled('action')) {
                $query->where('action', $request->action);
            }
            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            $logs = $query->paginate(25)->withQueryString();

            if (config('app.debug')) {
                Log::info('Audit logs page loaded', [
                    'count' => $logs->count(),
                    'total' => $logs->total(),
                    'filters' => $request->only(['action', 'user_id']),
                ]);
            }

            return view('admin.audit-logs.index', compact('logs'));
        } catch (\Throwable $e) {
            Log::error('Audit logs page failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(500, 'Audit logs page failed to load.');
        }
    }
}
