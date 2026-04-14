<?php

function successResponse($data = null, $message = 'Success', $code = 200)
{
    return response()->json([
        'status' => true,
        'message' => $message,
        'data' => $data,
        'errors' => null
    ], $code);
}

function errorResponse($message = 'Error', $errors = null, $code = 400)
{
    return response()->json([
        'status' => false,
        'message' => $message,
        'data' => null,
        'errors' => $errors
    ], $code);
}

