<div>


    <div class="row mt-5">
        <div class="col-md-5 col-7">
            <div class="input-group bg-body-tertiary shadow-sm rounded py-2">
                <span class="input-group-text border-0 bg-transparent">
                    <i class="bi bi-search text-body"></i>
                </span>

                <input wire:model="searchTerm" type="text"
                       class="homepage-font-14 bg-body-tertiary text-body form-control border-0 shadow-none"
                       placeholder="Search for a country...">
            </div>

        </div>
        <div class="col-md-2 col-5 offset-md-5">

            <div class="dropdown">
                <button class="homepage-font-14 btn shadow-sm dropdown-toggle w-100 bg-body-tertiary text-body"
                        style="height: 52px;"
                        type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    @if($selectedRegion == 'all')
                        Filter by Region
                    @else
                        {{ ucfirst($selectedRegion) }}
                    @endif
                </button>
                <ul class="dropdown-menu bg-body-tertiary w-100">
                    @foreach($regions as $region)
                        <li>
                            <a class="dropdown-item homepage-font-14 text-body" href="#"
                               wire:click.prevent="selectRegion('{{ $region }}')">
                                {{ ucfirst($region) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

    <div class="row" wire:init="getCountries">
        <div class="col-12 mt-5" wire:loading wire:target="getCountries">
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>


    @if($loadedCountries)
        <div class="row">

            @forelse($countries_array as $country)
                <div class="col-md-3 col-sm-12 gy-5 text-body h-100">
                    <a class="text-decoration-none text-body"
                       href="{{ route('countries.show', ['alpha' => $country['cca2']]) }}">
                        <div class="shadow-sm bg-body-tertiary rounded">

                            <img class="object-fit-cover w-100 rounded-top"
                                 height="200px"
                                 src="{{ $country['flag'] }}"
                                 alt="country flag">

                            <div class="px-5 pb-3 mt-3">
                                <div class="text-truncate">
                                    <h5>{{ $country['name'] }}</h5>
                                </div>
                                <ul class="list-unstyled">

                                    <li class="text-truncate">
                                        <span class="country-sub-text fw-bold">Population:</span>
                                        <span class="country-sub-text">{{ number_format($country['population']) }}</span>

                                    </li>

                                    <li class="text-truncate">
                                        <span class="country-sub-text fw-bold">Region:</span>
                                        <span class="country-sub-text">{{ $country['region']}}</span>
                                    </li>

                                    <li class="text-truncate">

                                        <span class="country-sub-text fw-bold">Capital:</span>
                                        <span class="country-sub-text">{{ $country['capital'] }}</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 my-5 pt-5 text-body text-center">
                    We could not find any items that match your search criteria. Please try using different keywords or
                    filters.
                </div>
            @endforelse

        </div>
    @endif

    <div class="row mt-5 text-center" wire:loading.remove wire:target="getCountries">
        <div class="col-12">
            @if(!$firstPage)
                <button style="width: 120px;" class="btn shadow-sm bg-body-tertiary text-muted me-1"
                        wire:click="changePage('previous')">
                    <i class="bi bi-caret-left"></i>
                    Previous
                </button>
            @endif

            @if(!$lastPage)
                <button style="width: 120px;" class="btn shadow-sm bg-body-tertiary text-muted me-1"
                        wire:click="changePage('next')">
                    Next
                    <i class="bi bi-caret-right"></i>
                </button>
            @endif
        </div>
    </div>


</div>
