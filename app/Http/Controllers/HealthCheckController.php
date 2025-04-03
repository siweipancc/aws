<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HealthCheckController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $status = 'up';
        $services = [
            'database' => $this->checkDatabase(),
        ];

        // 如果任何服务检查失败，则状态为 down
        if (in_array(false, $services, true)) {
            $status = 'down';
        }

        return response()->json([
            'status' => $status,
            'timestamp' => now()->toIso8601String(),
            'services' => [
                'database' => [
                    'status' => $services['database'] ? 'up' : 'down'
                ]
            ],
            'performance' => [
                'memory_usage' => $this->formatBytes(memory_get_usage(true)),
                'peak_memory_usage' => $this->formatBytes(memory_get_peak_usage(true)),
            ]
        ]);
    }

    private function checkDatabase(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        return round($bytes / (1024 ** $pow), 2) . ' ' . $units[$pow];
    }
}
