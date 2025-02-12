<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
//        CustomException::class,
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        if(config('app.app_env') != "local") {
            $this->renderable(function (Throwable $e) {
                if(!$e instanceof ValidationException && !$e instanceof AccessDeniedHttpException && !$e instanceof AuthenticationException) {
//                    Log::debug('GenericException logged: ' . $e->getMessage());
                    return response()->json(['message' => 'Something went wrong!'], 400);
                }
            });

            $this->renderable(function (Exception $e) {
                if(!$e instanceof ValidationException && !$e instanceof AccessDeniedHttpException && !$e instanceof AuthenticationException) {
//                    Log::debug('GenericException logged: ' . $e->getMessage());
                    return response()->json(['message' => 'Something went wrong!'], 400);
                }
            });
        }
    }
}
