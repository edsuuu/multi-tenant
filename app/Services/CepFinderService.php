<?php

namespace App\Services;



use Illuminate\Support\Facades\Http;

class CepFinderService
{
    /**
     * Create a new class instance.
     */
    protected array $apiUrls;

    public function __construct()
    {
        $this->apiUrls = [
            'https://viacep.com.br/ws/',
            'https://cep.awesomeapi.com.br/json/',
            'https://brasilapi.com.br/api/cep/v1/',
        ];
    }

    public static function getAddress(string $cep): bool|array
    {
        return (new self())->getCep($cep);
    }

    private function getCep($zipcode): bool|array
    {
        foreach ($this->apiUrls as $url) {
            if (!str_contains($url, 'brasilapi')) {
                $cep =  str_replace('-','', $zipcode);
            }

            $concat = "{$url}{$cep}" . (str_contains($url, 'viacep') ? '/json/' : '');

            $addr = Http::get($concat)->json();

            if (isset($addr['erro']) || empty($addr)) {
                continue;
            }

            return self::normalizeCepResponse($addr);
        }

        return false;
    }

    private static function normalizeCepResponse(array $data): array
    {
        return [
            'cep' => $data['cep'] ?? null,
            'street' => $data['logradouro']
                ?? $data['street']
                    ?? $data['address']
                    ?? null,
            'neighborhood' => $data['bairro']
                ?? $data['neighborhood']
                    ?? $data['district']
                    ?? null,
            'city' => $data['localidade']
                ?? $data['city']
                    ?? null,
            'state' => $data['uf']
                ?? $data['state']
                    ?? null,
        ];
    }
}
