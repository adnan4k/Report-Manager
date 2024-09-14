<div class="container mx-auto p-6 border-4   rounded-xl shadow-lg " id="register">


    <form class="" method="POST">
        @csrf
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="-mt-10">
                        <h1>Register Customer</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Progress Bar Container -->
        <ol id="stepper" class="flex justify-center items-center w-full text-sm text-gray-500 font-medium sm:text-base mb-2">
            {{$currentStep}} Out of {{$totalStep}}
        </ol>

        <script>
            toastr.success('Customer Registration Successfully Completed.');
        </script>

        <!-- Step 1: User Details -->
        @if ($currentStep === 1)
        <div class="step1 forms" method="POST" id="step1">

            <div class="step">
                <h3 class="mb-4 text-2xl font-medium leading-none text-gray-900 dark:text-white">Customer Details</h3>
                <div class="grid gap-3 w-[90%] font-[14px] mb-4 sm:grid-cols-2">
                    <!-- Name Field -->
                    <div class="mb-4">

                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input wire:model="name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name.example" required="">
                        @error('name')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <!-- Email Field -->
                    <div class="mb-4">

                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input wire:model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                        @error('email')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <!-- Phone Field -->
                    <div class="mb-4">

                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <input wire:model="phone" type="phone" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-456-7890" required="">
                        @error('phone')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <!-- Address Field -->
                    <div class="mb-4">

                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input wire:model="address" type="address" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1234 Main St" required="">
                        @error('address')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
        @elseif($currentStep === 2)
        <div class="step2 forms">
            <!-- Step 2: business Details -->
            <div id="step2" class="step ">
                <h3 class="mb-4 text-2xl font-medium leading-none text-gray-900 dark:text-white">Business Details</h3>
                <div class="grid gap-3 w-[90%] font-[14px] mb-4 sm:grid-cols-2">
                    <div class="mb-4">

                        <label for="business-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Business Name</label>
                        <input wire:model="business_name" type="text" name="business_name" id="business_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="company name" required="">
                        @error('business_name')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="mb-4">

                        <label for="report_center" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Report Center</label>
                        <input wire:model="report_center" type="text" name="report_center" id="report_center" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="report center" required="">
                        @error('report_center')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                    <div class="mb-4">

                        <label for="tin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIN</label>
                        <input wire:model="tin" type="text" name="tin" id="tin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123" required="">
                        @error('tin')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="mb-4">

                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input wire:model="price" type="price" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0 ETB" required="">
                        @error('price')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                    <div class="mb-4">

                        <label for="taxtype_due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tax/TOT Report Due Date</label>
                        <input wire:model="taxtype_due_date" type="date" name="taxtype_due_date" id="taxtype_due_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123" required="">
                        @error('taxtype_due_date')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="mb-4">

                        <label for="payroll_due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payroll Report Due Date</label>
                        <input wire:model="payroll_due_date" type="date" name="payroll_due_date" id="payroll_due_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123" required="">
                        @error('payroll_due_date')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="mb-4">

                        <label for="statement_due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statement Report Due Date</label>
                        <input wire:model="statement_due_date" type="date" name="statement_due_date" id="statement_due_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 w-[90%] font-[14px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123" required="">
                        @error('statement_due_date')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>



                </div>

            </div>
        </div>

        @elseif($currentStep === 3)
        <div class="step3 forms">
            <div id="step3" class="step">
                <h3 class="mb-4 text-2xl font-medium leading-none text-gray-900 dark:text-white">Upload Documents</h3>
                <div class="grid gap-3 w-[90%] font-[14px] mb-4 sm:grid-cols-2">
                    <!-- Payroll Document -->
                    <div class="mb-4">

                        <label for="payroll" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payroll Document</label>
                        <input wire:model="payroll" type="file" name="payroll" id="payroll" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        @error('payroll') <!-- Error Handling -->
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                    <!-- Pension Document -->
                    <div class="mb-4">

                        <label for="pension" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pension Document</label>
                        <input wire:model="pension" type="file" name="pension" id="pension" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        @error('pension') <!-- Error Handling -->
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                    <!-- Tax Document -->
                    <div class="mb-4">

                        <label for="tax" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tax/TOT Document</label>
                        <input wire:model="tax" type="file" name="tax" id="tax" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        @error('tax') <!-- Error Handling -->
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                    <!-- Income Statement -->
                    <div class="mb-4">

                        <label for="income_statement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Income Statement</label>
                        <input wire:model="income_statement" type="file" name="income_statement" id="income_statement" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        @error('income_statement') <!-- Error Handling -->
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                    <!-- Balance Sheet -->
                    <div class="mb-4">

                        <label for="balance_sheet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Balance Sheet</label>
                        <input wire:model="balance_sheet" type="file" name="balance_sheet" id="balance_sheet" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        @error('balance_sheet') <!-- Error Handling -->
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        @endif



        <div class="flex justify-between m-4 sm:m-10">
            @if ($currentStep > 1)
            <button wire:click="decrementSteps" type="button" class="text-gray-700 bg-red-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Previous Step</button>

            @endif
            @if ($currentStep < $totalStep)
                <button wire:click="incrementSteps" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>

                @endif
                @if ($currentStep === $totalStep)
                <button wire:click="submit" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                @endif
        </div>
        <!-- Step 3: Document Upload -->

    </form>
</div>