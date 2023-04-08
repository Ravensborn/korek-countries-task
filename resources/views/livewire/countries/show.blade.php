<div>

    <div wire:init="getCountry()"></div>

    @if($loadedCountry)

        <div class="row mt-5">
            <div class="col">
                @if($loadedCountry)
                    <a class="btn shadow-sm bg-body-tertiary text-body" href="{{ route('countries.index') }}">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md-6">

                <img class="w-100 p-md-3 ps-md-0"
                     style="height: 400px;"
                     src="{{ $country['flag'] }}"
                     alt="country flag"
                >

            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">

                <div class="mt-4 mt-md-0">
                    <h2>
                        {{ $country['name'] }}
                    </h2>

                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li class="mt-2">
                                    <span class="fw-bold">Native Name:</span>
                                    {{ reset($country['native_name'])['official'] }}
                                </li>
                                <li class="mt-2">
                                    <span class="fw-bold">Population:</span>
                                    {{ number_format($country['population']) }}
                                </li>
                                <li class="mt-2">
                                    <span class="fw-bold">Region:</span>
                                    {{ $country['region'] }}
                                </li>
                                <li class="mt-2">
                                    <span class="fw-bold">Sub Region:</span>
                                    {{ $country['sub_region'] }}
                                </li>
                                <li class="mt-2">
                                    <span class="fw-bold">Capital:</span>
                                    {{ $country['capital'] }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li class="mt-2">
                                    <span class="fw-bold">Top Level Domain:</span>
                                    @foreach($country['tld'] as $key => $value)
                                        @if($loop->last)
                                            {{ $value }}
                                        @else
                                            {{ $value }},
                                        @endif
                                    @endforeach
                                </li>
                                <li class="mt-2">
                                    <span class="fw-bold">Currencies:</span>
                                    @foreach($country['currencies'] as $key => $value)
                                        @if($loop->last)
                                            {{ $key }}
                                        @else
                                            {{ $key }},
                                        @endif
                                    @endforeach
                                </li>
                                <li class="mt-2">
                                    <span class="fw-bold">Languages:</span>
                                    @foreach($country['languages'] as $key => $value)
                                        @if($loop->last)
                                            {{ $value }}
                                        @else
                                            {{ $value }},
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row" wire:init="initBorderCountries()">
                        <div class="col">
                            Border Countries:
                            <span wire:loading.remove wire:target="initBorderCountries">
                            @forelse($borderCountries as $country)
                                    <a class="btn btn-sm shadow-sm bg-body-tertiary text-body mb-1"
                                       href="{{ route('countries.show', ['alpha' => $country['alpha']]) }}">
                                        {{ $country['name'] }}
                                    </a>
                                @empty
                                    no border countries.
                                @endforelse
                        </span>
                            <div class="spinner-border spinner-border-sm text-secondary" role="status" wire:loading
                                 wire:target="initBorderCountries">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
        </div>
    @else
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="spinner-border text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="col-12 text-center mt-3">
                Loading country data...
            </div>

        </div>
    @endif

</div>
