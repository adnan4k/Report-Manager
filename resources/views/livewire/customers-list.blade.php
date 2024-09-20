<div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="flex flex-row justify-between bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Customers </h6>
                        <a href="/register-cusotmer" wire:navigate class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"> Add New </a>
                    </div>

                </div>
                <div class="card-body px-0 pb-2">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-1 py-1">
                                        Customer
                                    </th>
                                    <th scope="col" class="px-1 py-1 text-center">
                                        Phone
                                    </th>
                                    <th scope="col" class="px-3 py-1 text-center">
                                        Address
                                    </th>
                                    <th scope="col" class="px-1 py-1 text-center">
                                        Business Name
                                    </th>
                                    <th scope="col" class="px-1 py-1 text-center">
                                        Payment
                                    </th>
                                    <th scope="col" class="px-1 py-1 text-center">
                                        TIN
                                    </th>
                                    <th scope="col" class="px-1 py-1 text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="text-sm font-medium text-gray-900 dark:text-white">{{ $customer->name }}</h6>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $customer->email }}</p>
                                        </div>
                                    </td>

                                    <td class="px-2 py-1 text-center">
                                        <p class="text-xs text-gray-900 dark:text-white">{{ $customer->phone }}</p>
                                    </td>

                                    <td class="px-2 py-1 text-center">
                                        <p class="text-sm text-gray-900 dark:text-white">{{ $customer->address }}</p>
                                    </td>

                                    <td class="px-2 py-1 text-center">
                                        @if($customer->businesses->isNotEmpty())
                                        @foreach ($customer->businesses as $business)
                                        <div>
                                            <span class="text-xs font-bold">{{ $business->business_name }}</span>
                                        </div>
                                        @endforeach
                                        @else
                                        <span class="text-xs text-gray-500 dark:text-gray-400">N/A</span>
                                        @endif
                                    </td>

                                    <td class="px-2 py-1 text-center">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="text-sm font-medium text-gray-900 dark:text-white">{{ $customer->businesses->first()->price ?? "" }}</h6>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Not Paid</p>
                                        </div>
                                    </td>

                                    <td class="px-2 py-1 text-center">
                                        @if($customer->businesses->isNotEmpty())
                                        @foreach ($customer->businesses as $business)
                                        <div>
                                            <span class="text-xs font-bold">{{ $business->tin }}</span>
                                        </div>
                                        @endforeach
                                        @else
                                        <span class="text-xs text-gray-500 dark:text-gray-400">N/A</span>
                                        @endif
                                    </td>

                                    <td class="px-2 py-1 text-center">
                                        <!-- Edit Icon -->
                                        <a wire:navigate href="{{route('edit',['id'=>$customer->id])}}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600" data-tooltip-target="tooltip-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a wire:navigate href="{{route('details')}}" class="mx-2 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600" data-tooltip-target="tooltip-edit">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Delete Icon -->
                                        <button wire:click.prevent="deleteConfirmation({{$customer->id}})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600 ">
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