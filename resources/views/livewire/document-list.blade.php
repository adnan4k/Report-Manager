<div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="flex flex-row justify-between bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Customers</h6>
                        <!-- <a href="/register-customer" wire:navigate class="text-white bg-gray-500 rounded mx-5 p-2"> Add New </a> -->
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-white text-black">
                                <tr>
                                    <th class="py-2 px-4">Business Name</th>
                                    <th class="py-2 px-4">Tax</th>
                                    <th class="py-2 px-4">Statement</th>
                                    <th class="py-2 px-4">BS</th>
                                    <th class="py-2 px-4">Pension</th>
                                    <th class="py-2 px-4">Payroll</th>
                                    <th class="py-2 px-4">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @foreach($businesses as $business)
                                @if($business->documents->isNotEmpty())
                                @foreach($business->documents as $document)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $business->business_name }}</td>

                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">
                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block">

                                                <!-- Image -->
                                                <img src="{{ asset('storage/'.$document->tax) }}" alt="Tax Document" class="flex flex-row justify-center h-14 w-16 object-cover rounded-md">

                                                <!-- Download Icon -->
                                                <a x-show="isHovered"
                                                    href="{{ asset('storage/'.$document->tax) }}"
                                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                                    download>
                                                    <!-- Font Awesome Icon -->
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Repeat for other document types -->

                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">

                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block">

                                                <!-- Image -->
                                                <img src="{{ asset('storage/'.$document->income_statement) }}" alt="Income Statement Document" class="h-14 w-16 object-cover rounded-md">

                                                <!-- Download Icon -->
                                                <a x-show="isHovered"
                                                    href="{{ asset('storage/'.$document->income_statement) }}"
                                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                                    download>
                                                    <!-- Font Awesome Icon -->
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Continue similar blocks for Balance Sheet, Pension, and Payroll -->

                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">

                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block">

                                                <!-- Image -->
                                                <img src="{{ asset('storage/'.$document->balance_sheet) }}" alt="Balance Sheet Document" class="h-14 w-16 object-cover rounded-md">

                                                <!-- Download Icon -->
                                                <a x-show="isHovered"
                                                    href="{{ asset('storage/'.$document->balance_sheet) }}"
                                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                                    download>
                                                    <!-- Font Awesome Icon -->
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">

                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block">

                                                <!-- Image -->
                                                <img src="{{ asset('storage/'.$document->pension) }}" alt="Pension Document" class="h-14 w-16 object-cover rounded-md">

                                                <!-- Download Icon -->
                                                <a x-show="isHovered"
                                                    href="{{ asset('storage/'.$document->pension) }}"
                                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                                    download>
                                                    <!-- Font Awesome Icon -->
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">

                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block">

                                                <!-- Image -->
                                                <img src="{{ asset('storage/'.$document->payroll) }}" alt="Payroll Document" class="h-14 w-16 object-cover rounded-md">

                                                <!-- Download Icon -->
                                                <a x-show="isHovered"
                                                    href="{{ asset('storage/'.$document->payroll) }}"
                                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                                    download>
                                                    <!-- Font Awesome Icon -->
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-2 px-4">
                                        <button wire:click="downloadDocuments({{$business->id}})" >
                                            <i class="fas fa-download text-2xl"></i>

                                        </button>
                                    </td>
                                </tr>

                                @endforeach
                                @else
                                <tr class="border-b">
                                    <td class="py-2 px-4" colspan="6" class="text-center">No documents available for {{ $business->business_name }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>