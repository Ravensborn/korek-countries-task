<?php

namespace App\Http\Livewire\Countries;

use Illuminate\Support\Facades\Http;
use Livewire\Component;


class Index extends Component
{

    private string $apiHost = 'https://restcountries.com';

    public array $countries = [];
    public array $countries_chunk = [];
    public array $regions = [];

    public bool $loadedCountries = false;

    public string $searchTerm = '';
    public string $selectedRegion = 'all';

    public int $perPage = 12;
    public int $page = 0;
    public bool $lastPage = false;
    public bool $firstPage = true;


    public function getRegions()
    {
        //There was no API to get region names, so we are returning static.

        $this->regions = [
            'all',
            'africa',
            'america',
            'asia',
            'europe',
            'oceania',
        ];
    }

    public function getCountries()
    {

        $http = Http::get($this->apiHost . '/v3.1/independent?status=true');

        if ($http->successful()) {

            $countries = $http->json();

//            $countries = array_chunk($countries, 181, false)[1];

            //Cleaning up unnecessary data.
            foreach ($countries as $country) {

                array_push($this->countries, [
                    'name' => $country['name']['common'],
                    'flag' => $country['flags']['svg'],
                    'population' => $country['population'],
                    'region' => $country['region'],
                    'capital' => $country['capital'][0],
                    'cca2' => strtolower($country['cca3']),
                ]);
            }
            $this->loadedCountries = true;
        }
    }


    public function resetFilter()
    {
        $this->searchTerm = '';
        $this->selectedRegion = 'all';
    }

    public function resetPage()
    {
        $this->page = 0;
        $this->lastPage = false;
        $this->firstPage = true;
    }

    public function selectRegion($value)
    {
        if (in_array($value, $this->regions)) {

            $this->resetFilter();
            $this->resetPage();
            $this->selectedRegion = $value;
        }
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function changePage($mode = 'next')
    {

        $countries = $this->countries_chunk;

        if ($mode == 'next') {
            if (array_key_exists(($this->page + 1), $countries)) {
                $this->page++;
            }
        }

        if ($mode == 'previous') {
            if (array_key_exists(($this->page - 1), $countries)) {
                $this->page--;
            }
        }
    }

    public function calculateNextPrevButtonState()
    {
        $this->firstPage = $this->page == array_key_first($this->countries_chunk);
        $this->lastPage = $this->page == array_key_last($this->countries_chunk);
    }

    public function mount()
    {
        //We can immediately load regions since it's not an API call.
        $this->getRegions();

        //We load this after the HTML finishes rendering on the front-end.
        //$this->getCountries();
    }

    public function render()
    {

        /*
         * We don't want to make an API call on each search / refresh.
         * Instead we store the counties as an array and filter through as needed.
         */

        $countries = $this->countries;
        $searchTerm = $this->searchTerm;
        $region = $this->selectedRegion;

        if ($region != 'all') {

            /*
             * No need to make an API call to get countries by region,
             * since the country collection is short and filtering client side will be much faster.
             * However, in other cases filtering by an API call might be better.
             */

            $countries = array_filter($countries, function ($item) use ($region) {
                return false !== stristr($item['region'], $region);
            });

        }

        if ($searchTerm) {

            /*
             * Searching through an array for a matched string occurrence,
             * since the API does not provide a search by name endpoint and also
             * filtering client side is faster.
             */

            $countries = array_filter($countries, function ($item) use ($searchTerm) {
                return false !== str_starts_with(strtolower($item['name']), strtolower($searchTerm));
            });

        }

        //Paginating an array.
        $countries = array_chunk($countries, $this->perPage, false);


        //Mainly for changing pages and calculating next and previous button states.
        $this->countries_chunk = $countries;
        $this->calculateNextPrevButtonState();

        if (count($countries) > 0) {
            $countries = $countries[$this->page];
        }

        return view('livewire.countries.index', [

            'countries_array' => $countries
        ])->extends('layouts.app')->section('content');
    }
}
