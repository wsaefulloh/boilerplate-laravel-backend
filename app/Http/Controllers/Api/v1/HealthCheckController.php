<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthCheckController extends Controller
{
    use ApiResponseTrait;

    /**
     * Check Application and Database Health Status.
     */
    public function __invoke(): JsonResponse
    {
        $dbStatus = 'OK';
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $dbStatus = 'ERROR: ' . $e->getMessage();
        }

        return $this->successResponse([
            'status'      => 'healthy',
            'app_name'    => config('app.name'),
            'environment' => config('app.env'),
            'php_version' => PHP_VERSION,
            'laravel'     => app()->version(),
            'database'    => $dbStatus,
            'timestamp'   => now()->toIso8601String(),
        ], 'API Health Status Check');
    }
}
