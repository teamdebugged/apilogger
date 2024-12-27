<?php

namespace Benjaminwong\ApiLogger\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class APILog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $requestData = [
            'url' => $request->url(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'request_data' => $request->all(),
        ];

        try {
            $response = $next($request);

            DB::table('logs')->insert([
                'method' => $requestData['method'],
                'url' => $requestData['url'],
                'ip' => $requestData['ip'],
                'user_agent' => $requestData['user_agent'],
                'request_data' => json_encode($requestData['request_data']),
                'response_data' => $response->getContent(),
                'status_code' => $response->getStatusCode(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $response;
        } catch (Throwable $e) {
            DB::table('logs')->insert([
                'method' => $requestData['method'],
                'url' => $requestData['url'],
                'ip' => $requestData['ip'],
                'user_agent' => $requestData['user_agent'],
                'request_data' => json_encode($requestData['request_data']),
                'response_data' => json_encode(['error' => $e->getMessage()]),
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            throw $e;
        }
    }
