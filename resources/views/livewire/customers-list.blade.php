<div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="flex flex-row justify-between bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Customers </h6>
                        <a href="/register-cusotmer" wire:navigate class="text-white bg-gray-500 rounded mx-5 p-2"> Add New </a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-black text-xxs font-weight-bolder opacity-7">
                                        Customer
                                    </th>

                                    <th class="text-center text-uppercase text-black text-xxs font-weight-bolder opacity-7">
                                        Phone
                                    </th>
                                    <th class="text-center text-uppercase text-black text-xxs font-weight-bolder opacity-7">
                                        Address
                                    </th>
                                    <th class="text-center text-uppercase text-black text-xxs font-weight-bolder opacity-7">
                                        Business Name
                                    </th>
                                    <th class="text-center text-uppercase text-black text-xxs font-weight-bolder opacity-7">
                                        Payment
                                    </th>
                                    <th class="text-center text-uppercase text-black text-xxs font-weight-bolder opacity-7">
                                        TIN
                                    </th>
                                    <th class="text-center text-uppercase text-black text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $customer->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $customer->email }}
                                            </p>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs text-black mb-0">{{ $customer->phone }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-black mb-0">{{ $customer->address }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($customer->businesses->isNotEmpty())
                                        @foreach ($customer->businesses as $business)
                                        <div>
                                            <span class="text-xs font-weight-bold">{{ $business->business_name }}</span>
                                        </div>
                                        @endforeach
                                        @else
                                        <span class="text-xs text-black">N/A</span>
                                        @endif


                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center pl-6">

                                            <h6 class="mb-0 text-sm">{{ $customer->businesses->first()->price ?? "" }}</h6>
                                            <p class="text-xs text-secondary mb-0">Not Paid
                                            </p>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($customer->businesses->isNotEmpty())
                                        @foreach ($customer->businesses as $business)
                                        <div>
                                            <span class="text-xs font-weight-bold">{{ $business->tin }}</span>
                                        </div>
                                        @endforeach
                                        @else
                                        <span class="text-xs text-black">N/A</span>
                                        @endif
                                    </td>

                                    <td class="align-middle text-center">
                                        <!-- Edit Icon -->
                                        <button href="javascript:;" class="text-black font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit customer">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Delete Icon -->
                                        <button wire:click.prevent="deleteConfirmation({{$customer->id}})" class="text-danger font-weight-bold text-xs ms-3" data-toggle="tooltip" data-original-title="Delete customer">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>