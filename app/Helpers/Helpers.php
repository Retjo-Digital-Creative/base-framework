<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class Helpers
{
    /**
     * Return JSON response to user
     *
     * @param array|string|object $data
     * @param int $code
     * @param array $headers
     * @return \Illuminate\Http\Response
     */
    public static function response($data, int $code, array $headers = [])
    {
        return response()
            ->json($data, $code)
            ->withHeaders(Arr::collapse([
                [
                    'Content-Type' => 'application/json'
                ], $headers
            ]));
    }
}
