<?php

namespace App\Exceptions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // Custom logic for reporting exceptions
        });

        $this->renderable(function (Throwable $e, Request $request) {
            return $this->handleException($e, $request);
        });
    }

    /**
     * Handle exceptions based on their type.
     */
    protected function handleException(Throwable $e, Request $request)
    {
        $response = [
            'success' => false,
            'message' => 'An error occurred.',
        ];

        if ($e instanceof ModelNotFoundException) {
            $response['message'] = 'Resource not found.';
            $statusCode = 404;
        } elseif ($e instanceof NotFoundHttpException) {
            $response['message'] = 'The requested route was not found.';
            $statusCode = 404;
        } elseif ($e instanceof AccessDeniedHttpException) {
            $response['message'] = 'You are not authorized to access this resource.';
            $statusCode = 403;
        } elseif ($e instanceof ValidationException) {
            $response['message'] = 'Validation failed.';
            $response['errors'] = $e->errors();
            $statusCode = 422;
        } elseif ($e instanceof RedirectResponse) {
            $statusCode = 302;
            $response['message'] = 'Redirect encountered' . $e->getTargetUrl();
        } elseif ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
            $response['message'] = $e->getMessage() ?: 'HTTP error occurred.';
        } else {
            $statusCode = 500;
            $response['message'] = 'Internal server error. Please try again later.';
        }

        // Log the exception
        $this->logException($e, $statusCode);

        // Return a JSON response
        return response()->json($response, $statusCode);
    }

    /**
     * Log the exception with appropriate details.
     */
    protected function logException(Throwable $e, int $statusCode): void
    {
        $context = [
            'exception' => $e,
            'code' => $statusCode,
        ];
        logger()->error($e->getMessage(), $context);
    }
}