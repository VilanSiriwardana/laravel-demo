<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Audit Logs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <header class="border-b border-slate-200 bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-500">Admin</p>
                <h1 class="text-xl font-semibold text-slate-900">Audit Logs</h1>
            </div>
            <a
                href="/"
                class="inline-flex items-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50"
            >
                Back to Home
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Activity Timeline</h2>
                    <p class="text-sm text-slate-500">Monitor post changes and authentication events.</p>
                </div>
                <div class="text-xs text-slate-500">Updated {{ now()->format('Y-m-d H:i') }}</div>
            </div>

    @if(config('app.debug'))
        <div class="mt-4 rounded border border-yellow-200 bg-yellow-50 px-3 py-2 text-sm text-yellow-800">
            Debug: showing {{ $logs->count() }} of {{ $logs->total() }} records
        </div>
    @endif

            <form method="GET" class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="flex w-full flex-col gap-2 sm:w-auto">
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Action</label>
                    <select name="action" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">All Actions</option>
                        <option value="created" @selected(request('action') === 'created')>Created</option>
                        <option value="updated" @selected(request('action') === 'updated')>Updated</option>
                        <option value="deleted" @selected(request('action') === 'deleted')>Deleted</option>
                        <option value="login" @selected(request('action') === 'login')>Login</option>
                        <option value="failed_login" @selected(request('action') === 'failed_login')>Failed Login</option>
                    </select>
                </div>
                <div class="flex w-full items-end gap-2 sm:w-auto">
                    <button class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">Filter</button>
                    <a href="/admin/audit-logs" class="inline-flex items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50">Reset</a>
                </div>
            </form>

    @if($logs->isEmpty())
            <div class="mt-6 rounded border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                No audit logs found for the current filters.
            </div>
    @else
            <div class="mt-6 overflow-x-auto rounded-xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-100 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Time</th>
                            <th class="px-4 py-3 text-left">User</th>
                            <th class="px-4 py-3 text-left">Action</th>
                            <th class="px-4 py-3 text-left">Model</th>
                            <th class="px-4 py-3 text-left">IP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($logs as $log)
                            @php
                                $actionClass = match ($log->action) {
                                    'deleted' => 'bg-red-100 text-red-800',
                                    'updated' => 'bg-yellow-100 text-yellow-800',
                                    'failed_login' => 'bg-orange-100 text-orange-800',
                                    'login' => 'bg-blue-100 text-blue-800',
                                    default => 'bg-green-100 text-green-800',
                                };

                                $modelLabel = $log->auditable_type ? class_basename($log->auditable_type) : '—';
                                $modelId = $log->auditable_id ? ('#' . $log->auditable_id) : '';
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-slate-700">{{ optional($log->created_at)->format('Y-m-d H:i') ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $log->user?->name ?? 'Guest' }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $actionClass }}">
                                        {{ ucfirst($log->action ?? 'unknown') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-slate-700">{{ $modelLabel }} {{ $modelId }}</td>
                                <td class="px-4 py-3 font-mono text-xs text-slate-600">{{ $log->ip_address ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $logs->links() }}</div>
    @endif
        </div>
    </main>
</div>
</body>
</html>



