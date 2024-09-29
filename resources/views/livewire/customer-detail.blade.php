<div x-data="{ customer: true, business: false, document: false }" class="flex flex-row ">

    <aside id="default-sidebar" class="ml-2 shadow rounded-lg border border-gray-300 z-40 w-64  h-[300px] transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full py-4 px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-center py-2">
                <!-- Large icon from Font Awesome -->
                <i class="fas fa-user-circle fa-4x"></i> <!-- Example of large user icon -->
            </div>

            <!-- Divider -->
            <div class="border-t mb-4 border-gray-700"></div>
            <ul class="  space-y-3 font-medium">
                <li>
                    <button @click="customer = true; business = false; document = false"
                        :class="customer ? 'text-red-500' : 'hover:bg-gray-100 dark:hover:bg-gray-700'"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" aria-current="page">
                        <i class="fas fa-user mr-2"></i> User Detail
                    </button>
                </li>
                <li>
                    <button @click="customer = false; business = true; document = false"
                        :class="business ? 'text-red-500' : 'hover:bg-gray-100 dark:hover:bg-gray-700'"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" aria-current="page">
                        <i class="fas fa-briefcase mr-2"></i> Business Detail
                    </button>
                </li>
                <li>
                    <button @click="customer = false; business = false; document = true"
                        :class="document ? 'text-red-500' : 'hover:bg-gray-100 dark:hover:bg-gray-700'"

                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" aria-current="page">
                        <i class="fas fa-file-alt mr-2"></i> Document Detail
                    </button>
                </li>

            </ul>
        </div>
    </aside>
    <div class="flex flex-row h-screen overflow-hidden">

        <div x-show="customer" class="ml-4">
            <div class="bg-white overflow-hidden shadow rounded-lg border">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        User Profile
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        information about the user.
                    </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Full name
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$customer->name}}
                            </dd>
                        </div>
                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Email address
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$customer->email}}
                            </dd>
                        </div>
                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Phone number
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$customer->phone}}
                            </dd>
                        </div>
                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Address
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$customer->address}}

                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div x-show="business" class="mx-2">
            <div class="bg-white overflow-hidden shadow rounded-lg border">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Business Detail
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        information about the Business.
                    </p>
                </div>
                <div class="flex flex-row ml-4">
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Business name
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{$customer->businesses->first()->business_name}}
                                </dd>
                            </div>
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    TIM
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{$customer->businesses->first()->tin}}
                                </dd>
                            </div>
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm  font-medium text-gray-500">
                                    Tax Type
                                </dt>
                                <dd class="mt-1 uppercase text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{$customer->businesses->first()->tax_type}}
                                </dd>
                            </div>
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Payment
                                </dt>
                                <span class="badge {{ $customer->businesses->first()->status ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-2 py-1 rounded">
                                    {{$customer->businesses->first()->status ? 'PAID' : 'NOT PAID' }}
                                </span>

                            </div>
                        </dl>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">

                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    TOT/VAT
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="badge {{ $customer->businesses->first()->reports->first()->tax_status ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-2 py-1 rounded">
                                        {{$customer->businesses->first()->reports->first()->tax_status ? 'Reported' : 'Pending' }}
                                    </span>
                                </dd>
                                <dt class="text-sm font-medium text-gray-500">DueDate</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($customer->businesses->first()->reports->first()->tax_duedate)->format('F j, Y') }}</dd>
                            </div>
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Payroll
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="badge {{ $customer->businesses->first()->reports->first()->payroll ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-2 py-1 rounded">
                                        {{$customer->businesses->first()->reports->first()->payroll ? 'Reported' : 'Pending' }}
                                    </span>
                                </dd>

                                <dt class="text-sm font-medium text-gray-500">DueDate</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($customer->businesses->first()->reports->first()->payroll_duedate)->format('F j, Y') }}</dd>

                            </div>
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Statement
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="badge {{ $customer->businesses->first()->reports->first()->statement ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-2 py-1 rounded">
                                        {{$customer->businesses->first()->reports->first()->statement ? 'Reported' : 'Pending' }}
                                    </span>
                                </dd>
                                <dt class="text-sm font-medium text-gray-500">DueDate</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($customer->businesses->first()->reports->first()->statement_duedate)->format('F j, Y') }}</dd>
                            </div>


                        </dl>
                    </div>
                </div>


            </div>
        </div>
        <div x-show="document" class="ml-4">
            <div class="bg-white overflow-hidden shadow rounded-lg border">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Documents
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        information about the Documents of User.
                    </p>
                </div>
                @if ($businesses->first()->documents)
                <div class="flex flex-row border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div class="py-3 sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                            <dt class="text-sm font-medium text-gray-500">
                                Pension
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="flex flex-row justify-center">

                                    <div x-data="{ isHovered: false }"
                                        @mouseenter="isHovered = true"
                                        @mouseleave="isHovered = false"
                                        class="relative inline-block">

                                        <!-- Image -->
                                        <img src="{{ asset('storage/'.$businesses->first()->documents->first()->pension) }}" alt="Pension Document" class="h-28 w-32 object-cover rounded-md">

                                        <!-- Download Icon -->
                                        <a x-show="isHovered"
                                            href="{{ asset('storage/'.$businesses->first()->documents->first()->pension) }}"
                                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                            download>
                                            <!-- Font Awesome Icon -->
                                            <i class="fas fa-download text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </dd>
                        </div>
                        <div class="py-3 sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Balance Sheet
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="flex flex-row justify-center">

                                    <div x-data="{ isHovered: false }"
                                        @mouseenter="isHovered = true"
                                        @mouseleave="isHovered = false"
                                        class="relative inline-block">

                                        <!-- Image -->
                                        <img src="{{ asset('storage/'.$businesses->first()->documents->first()->balance_sheet) }}" alt="Pension Document" class="h-28 w-32 object-cover rounded-md">

                                        <!-- Download Icon -->
                                        <a x-show="isHovered"
                                            href="{{ asset('storage/'.$businesses->first()->documents->first()->balance_sheet) }}"
                                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                            download>
                                            <!-- Font Awesome Icon -->
                                            <i class="fas fa-download text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </dd>
                        </div>
                    </dl>
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div class="py-3 sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Payroll
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="flex flex-row justify-center">

                                    <div x-data="{ isHovered: false }"
                                        @mouseenter="isHovered = true"
                                        @mouseleave="isHovered = false"
                                        class="relative inline-block">

                                        <!-- Image -->
                                        <img src="{{ asset('storage/'.$businesses->first()->documents->first()->payroll) }}" alt="Pension Document" class="h-28 w-32 object-cover rounded-md">

                                        <!-- Download Icon -->
                                        <a x-show="isHovered"
                                            href="{{ asset('storage/'.$businesses->first()->documents->first()->payroll) }}"
                                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                            download>
                                            <!-- Font Awesome Icon -->
                                            <i class="fas fa-download text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </dd>
                        </div>
                        <div class="py-3 sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                TOT/VAT
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="flex flex-row justify-center">

                                    <div x-data="{ isHovered: false }"
                                        @mouseenter="isHovered = true"
                                        @mouseleave="isHovered = false"
                                        class="relative inline-block">

                                        <!-- Image -->
                                        <img src="{{ asset('storage/'.$businesses->first()->documents->first()->tax) }}" alt="Tax Document" class="h-28 w-32 object-cover rounded-md">

                                        <!-- Download Icon -->
                                        <a x-show="isHovered"
                                            href="{{ asset('storage/'.$businesses->first()->documents->first()->tax) }}"
                                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                            download>
                                            <!-- Font Awesome Icon -->
                                            <i class="fas fa-download text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </dd>
                        </div>
                        <div class="py-3 sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Income Statement
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="flex flex-row justify-center">

                                    <div x-data="{ isHovered: false }"
                                        @mouseenter="isHovered = true"
                                        @mouseleave="isHovered = false"
                                        class="relative inline-block">

                                        <!-- Image -->
                                        <img src="{{ asset('storage/'.$businesses->first()->documents->first()->income_statement) }}" alt="Tax Document" class="h-28 w-32 object-cover rounded-md">

                                        <!-- Download Icon -->
                                        <a x-show="isHovered"
                                            href="{{ asset('storage/'.$businesses->first()->documents->first()->income_statement) }}"
                                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-md transition duration-300"
                                            download>
                                            <!-- Font Awesome Icon -->
                                            <i class="fas fa-download text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </dd>
                        </div>
                    </dl>
                </div>
                @else
                <h1 class="flex justify-center text-xl font-semibold" > No Documents</h1>
                @endif
              
            </div>
        </div>
    </div>
</div>