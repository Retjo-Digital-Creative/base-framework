<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

/**
 * Ini bukan best practice ya btw. Belakangan aja
 * kalau mau push yang best practice nya boleh2 aja;
 *
 * @todo Pakai best practice pastinya;
 */
class Helpers
{
    /**
     * Return JSON response to user
     *
     * @param array $data
     * @param int $code
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
