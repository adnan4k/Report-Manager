<div class="flex flex-row h-screen overflow-hidden">
    <!-- Sidebar -->
    @livewire('layout.sidebar', ['customerId' => $customer->id])

    <div class="ml-4">
        <!-- Customer Profile -->
        @livewire('customer-detail', ['customerId' => $customer->id])

        <!-- Conditional Business and Report Details -->
        @if (Route::currentRouteName() == 'business-detail')
            @livewire('business-detail', ['customerId' => $customer->id])
        @endif

        @if (Route::currentRouteName() == 'report-detail')
            @livewire('report-detail', ['customerId' => $customer->id])
        @endif
    </div>
</div>
