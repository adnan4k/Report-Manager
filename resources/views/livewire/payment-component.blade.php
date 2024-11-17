<div x-data="{ 
    paymentModal: @entangle('paymentModal').defer, 
    selectedId: @entangle('selectedPaymentId').defer 
}" class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="flex flex-row justify-between bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Payments</h6>
                </div>
            </div>

            <div class="card-body px-0 pb-2">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-1 py-1">Business Name</th>
                                <th scope="col" class="px-1 py-1 text-center">User</th>
                                <th scope="col" class="px-3 py-1 text-center">Initial Payment</th>
                                <th scope="col" class="px-3 py-1 text-center">Paid Amount</th>
                                <th scope="col" class="px-1 py-1 text-center">Status</th>
                                <th scope="col" class="px-3 py-1 text-center">Payment Date</th>
                                <th scope="col" class="px-1 py-1 text-center">Month</th>
                                <th scope="col" class="px-1 py-1 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr x-data="{id:@entangle('id')}" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-2 py-1">
                                    <h6 class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->business->business_name }}</h6>
                                </td>
                                <td class="px-2 py-1 text-center">
                                    <p class="text-xs text-gray-900 dark:text-white">{{ $payment->user->name }}</p>
                                </td>
                                <td class="px-2 py-1 text-center">
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{ $payment->initial_price ? 'ETB ' . number_format($payment->initial_price, 2) : 'ETB 0.00' }}
                                    </p>
                                </td>
                                <td class="px-1 py-1 text-center">
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{ $payment->paid_amount ? 'ETB ' . number_format($payment->paid_amount, 2) : 'ETB 0.00' }}
                                    </p>
                                </td>
                                <td class="px-3 py-4">
                                    <span class="badge {{ $payment->status ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-2 py-1 rounded">
                                        {{ $payment->status ? 'Paid' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="px-2 py-1 text-center">
                                    <p class="text-sm text-gray-900 dark:text-white"> {{ \Carbon\Carbon::parse($payment->payment_date)->format('F j, Y') ?? "N/A" }}
                                    </p>
                                </td>
                                <td class="px-2 py-1 text-center">
                                    <p class="text-sm capitalize text-gray-900 dark:text-white">{{ $payment->month ? ucfirst($payment->month) : 'N/A' }}</p>
                                </td>
                                <td class="px-2 py-1 text-center">
                                    <!-- Edit Icon -->
                                    <button @click="paymentModal = true; selectedId = {{ $payment->id }}" class="px-2 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600">
                                        <i class="fas fa-edit text-blue-600 hover:text-blue-900"></i>
                                    </button>

                                    <!-- Delete Icon -->
                                    <button wire:click.prevent="deletePayment({{ $payment->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                        <i class="fas fa-trash-alt text-red-600 hover:text-red-900"></i>
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

    <!-- Modal -->
    <div x-show="paymentModal" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-75">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Payment</h3>
                    <button @click="paymentModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit.prevent="updatePayment" class="p-4">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="paid_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paid Amount</label>
                            <input wire:model="paid_amount" type="text" id="paid_amount"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5 
                          dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Amount">
                            <!-- Error message -->
                            @error('paid_amount')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="months" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Month</label>
                            <select wire:model="month" id="months"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach (getMonths() as $month)
                                <option value="{{ strtolower($month) }}">{{ $month }}</option>
                                @endforeach
                            </select>
                            <!-- Error message -->
                            @error('month')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select wire:model="status" id="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option class="uppercase" value="0" selected>PENDING</option>
                                <option class="uppercase" value="1">PAID</option>
                            </select>
                            <!-- Error message -->
                            @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="payment_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Date</label>
                            <input wire:model="payment_date" type="date" id="payment_date"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5 
                          dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <!-- Error message -->
                            @error('payment_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button type="button" @click="paymentModal = false"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Back</button>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>