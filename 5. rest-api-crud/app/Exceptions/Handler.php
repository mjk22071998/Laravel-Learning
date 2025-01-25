<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        //403 Exception JSON Response
        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 403);
        }
        
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 401);
        }

        //404 Exception JSON Response
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }

        //404 Exception JSON Response
        if ($exception instanceof RouteNotFoundException) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }

        //404 Exception JSON Response
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'message' => 'The resource you are looking for could not be found.',
            ], Response::HTTP_NOT_FOUND);
        }

        //302 Exception JSON Response
        if($exception instanceof RedirectResponse) {
            return response()->json([
                'success' => false,
                'message' => 'Redirect encountered' . $exception->getTargetUrl(),
            ], 302);
        }

        //Integrity constraint violation Exception JSON Response
        if ($exception instanceof QueryException && strpos($exception->getMessage(), 'Integrity constraint violation') !== false) {
            return response()->json([
                'success' => false,
                'message' => 'Integrity constraint violation: Cannot delete or update a parent row.'
            ], 500);
        }

        return parent::render($request, $exception);
    }
}