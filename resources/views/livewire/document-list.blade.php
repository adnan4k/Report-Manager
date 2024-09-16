<div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="flex flex-row justify-between bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Customers</h6>
                        <a href="/register-customer" wire:navigate class="text-white bg-gray-500 rounded mx-5 p-2"> Add New </a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-black text-xxs font-weight-bolder opacity-7">
                                        Business Name
                                    </th>
                                    <th class="text-uppercase text-black text-xxs font-weight-bolder opacity-7">
                                        Documents
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($businesses as $business)
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                    <p class="text-xs text-black mb-0">{{ $business->business_name }}</h6>
                                    </td>

                                </tr>
                                @foreach ($business->documents as $document  )
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                    <img src="{{ asset('storage/taxs' . $document->tax) }}" class="text-xs text-black mb-0">{{ $document->business_name }}</h6>
                                    </td>
                                    <td>{{ asset('storage/' . $document->tax) }}</td>

                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>