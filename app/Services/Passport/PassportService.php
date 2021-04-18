<?php

namespace App\Services\Passport;

use App\Exceptions\AuthenticationException;
use Illuminate\Http\Request;

class PassportService
{
    public function buildCredentials(array $args = [], $grantType = 'password'): array
    {
        $args = collect($args);
        $credentials = $args->except('directive')->toArray();
        $credentials['client_id'] = $args->get('client_id', env('PASSPORT_CLIENT_ID'));
        $credentials['client_secret'] = $args->get('client_secret', env('PASSPORT_CLIENT_SECRET'));
        $credentials['grant_type'] = $grantType;
        $credentials['scope'] = '*';

        return $credentials;
    }

    public function makeRequest(array $credentials)
    {
        $request = Request::create('oauth/token', 'POST', $credentials, [], [], [
            'HTTP_Accept' => 'application/json',
        ]);

        $response = app()->handle($request);

        $decodedResponse = json_decode($response->getContent(), true);

        if ($response->getStatusCode() != 200) {
            if ($decodedResponse['message'] === 'The provided authorization grant (e.g., authorization code, resource owner credentials) or refresh token is invalid, expired, revoked, does not match the redirection URI used in the authorization request, or was issued to another client.') {
                throw new AuthenticationException(__('Authentication exception'), __('Incorrect username or password'));
            }

            throw new AuthenticationException(__($decodedResponse['error']), __($decodedResponse['message']));
        }

        return $decodedResponse;
    }

}
