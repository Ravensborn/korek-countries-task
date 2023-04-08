<?php

namespace App\Http\Livewire\Countries;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{

    private string $apiHost = 'https://restcountries.com';
    public string $alpha = '';

    public array $country = [];
    public array $borderCountries = [];
    public bool $loadedCountry = false;

    public function getBorderCountries($array) {

        $borderCountries = [];

        foreach ($array as $item) {

            $http = Http::get( $this->apiHost . '/v3.1/alpha/' . strtolower($item));

            if ($http->successful()) {

                $country = $http->json()[0];

                array_push($borderCountries, [
                    'name' => $country['name']['common'],
                    'alpha' => strtolower($country['cca3']),
                ]);
            }
        }
        $this->borderCountries = $borderCountries;
    }

    public function initBorderCountries() {

        $this->getBorderCountries($this->country['border_countries']);
    }

    public function getCountry()
    {
        $http = Http::get($this->apiHost . '/v3.1/alpha/' . $this->alpha);

        if ($http->successful()) {
            $country = $http->json()[0];
            $this->country = [
                'name' => $country['name']['common'],
                'flag' => $country['flags']['svg'],
                'native_name' => $country['name']['nativeName'],
                'population' => $country['population'],
                'region' => $country['region'],
                'sub_region' => $country['subregion'],
                'capital' => $country['capital'][0],
                'tld' => $country['tld'],
                'currencies' => $country['currencies'],
                'languages' => $country['languages'],
                'border_countries' => array_key_exists('borders', $country) ? $country['borders'] : [],
            ];
            $this->loadedCountry = true;
        }

    }

    public function mount($alpha)
    {

       $this->alpha = $alpha;

    }

    public function render()
    {
        return view('livewire.countries.show')->extends('layouts.app')->section('content');
    }
}
