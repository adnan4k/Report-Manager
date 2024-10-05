<div x-data="{ open: @entangle('open') }">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="flex flex-row justify-between bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Customers</h6>
                        <button @click="open=true" class="py-2.5 px-3 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"> Add Document </>
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

                                    <!-- Tax Document Files -->
                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">
                                            @foreach(json_decode($document->tax, true) ?? [] as $index =>$file)
                                            @if($loop->last)

                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block mx-1">

                                                <img src="{{ fileTypeChecker($file) ? asset('storage/'.$file) : asset('/assets/images/placeholders/No-PDF-Placeholder.png') }}" alt="Income Statement Document" class="h-14 w-16 object-cover rounded-md">

                                                <a x-show="isHovered" href="{{ asset('storage/'.$file) }}" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300" download>
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </td>

                                    <!-- Income Statement Document Files -->
                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">
                                            @foreach(json_decode($document->income_statement, true) ?? [] as $file)
                                            @if($loop->last)

                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block mx-1">

                                                <img src="{{ fileTypeChecker($file) ? asset('storage/'.$file) : asset('/assets/images/placeholders/No-PDF-Placeholder.png') }}" alt="Income Statement Document" class="h-14 w-16 object-cover rounded-md">

                                                <a x-show="isHovered" href="{{ asset('storage/'.$file) }}" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300" download>
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">
                                            @foreach(json_decode($document->balance_sheet, true) ?? [] as $file)
                                            @if($loop->last)

                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block mx-1">

                                                <img src="{{ fileTypeChecker($file) ? asset('storage/'.$file) : asset('/assets/images/placeholders/No-PDF-Placeholder.png') }}" alt="Income Statement Document" class="h-14 w-16 object-cover rounded-md">

                                                <a x-show="isHovered" href="{{ asset('storage/'.$file) }}" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300" download>
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">
                                            @foreach(json_decode($document->pension, true) ?? [] as $index => $file)
                                            @if($loop->last)
                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block mx-1">


                                                <img src="{{ fileTypeChecker($file) ? asset('storage/'.$file) : asset('/assets/images/placeholders/No-PDF-Placeholder.png') }}" alt="Income Statement Document" class="h-14 w-16 object-cover rounded-md">

                                                <a x-show="isHovered" href="{{ asset('storage/'.$file) }}" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300" download>
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>

                                    </td>


                                    <!-- Repeat similar blocks for Balance Sheet, Pension, Payroll -->
                                    <!-- Example for Payroll -->
                                    <td class="py-1 px-2">
                                        <div class="flex flex-row justify-center">
                                            @foreach(json_decode($document->payroll, true) ?? [] as $file)
                                            @if($loop->last)

                                            <div x-data="{ isHovered: false }"
                                                @mouseenter="isHovered = true"
                                                @mouseleave="isHovered = false"
                                                class="relative inline-block mx-1">

                                                <img src="{{ fileTypeChecker($file) ? asset('storage/'.$file) : asset('/assets/images/placeholders/No-PDF-Placeholder.png') }}" alt="Income Statement Document" class="h-14 w-16 object-cover rounded-md">

                                                <a x-show="isHovered" href="{{ asset('storage/'.$file) }}" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300" download>
                                                    <i class="fas fa-download text-2xl"></i>
                                                </a>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </td>

                                    <td class="py-2 px-4">
                                        <button wire:click="downloadDocuments({{ $business->id }})">
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




                    <div x-show="open" x-on:click.self="open = false" id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 z-50 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                        <div class="relative p-4 w-full max-w-md">
                            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal Header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add New Document</h3>
                                    <button @click="open = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal Form -->
                                <form wire:submit.prevent="uploadDocument" class="p-4">
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <!-- Business Dropdown -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="business" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Business</label>
                                            <select id="business" wire:model="selectedBusiness" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                                <option selected>Select Business</option>
                                                @foreach($businesses as $business)
                                                <option value="{{ $business->id }}">{{ $business->business_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Document Type Dropdown -->
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="document" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Document Type</label>
                                            <select id="document" wire:model="selectedDocumentType" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                                <option selected>Select Document</option>
                                                <option value="tax">VAT/TOT</option>
                                                <option value="payroll">Payroll</option>
                                                <option value="pension">Pension</option>
                                                <option value="income_statement">Income Statement</option>
                                                <option value="balance_sheet">Balance Sheet</option>
                                            </select>
                                        </div>

                                        <!-- File Upload Input -->
                                        <div class="mt-2 col-span-2">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                                            <input wire:model="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                                        </div>
                                    </div>




                                    <!-- Buttons -->
                                    <div class="flex justify-between">
                                        <button @click="open = false" type="button" class="text-gray-900 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                            Back
                                        </button>
                                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                            Add Document
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @script
                    <script>
                        Livewire.on('document-uploaded', function() {
                            Toastify({
                                text: "Document Successfully uploaded",
                                className: "info",
                                style: {
                                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                                }
                            }).showToast();
                        });
                    </script>
                    @endscript


                </div>
            </div>
        </div>
    </div>
</div>