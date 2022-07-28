<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * This provides a unified output format for all API responses.
     *
     * @param array $data Contents to be return to the client.
     * @param string $code Represents the action response code. These are usually string with all caps.
     *                     Action response code does not correlate with HTTP response codes.
     * @param string $message Message are human readable messages that describes the condition of the output.
     * 
     * @return array Formatted array output ready to be sent to the client.
     */
    protected function respondWith(array $data, string $code, string $message = ''): array
    {
        $response = [
            'data' => $data,
            'code' => $code,
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return $response;
    }
}
