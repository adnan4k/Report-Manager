<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="flex flex-col h-full p-4">
        <!-- Sidenav header -->
        <div class="flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <img src="{{ asset('assets') }}/img/logo-ct.png" class="h-10" alt="main_logo">
                <span class="text-white font-semibold">Report Management</span>
            </a>
            <button id="iconSidenav" class="text-white opacity-50 focus:outline-none md:hidden">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <hr class="my-4 border-gray-400">

        <!-- Sidenav Links -->
        <nav class="flex-grow overflow-y-auto">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'dashboard' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('all-customers') }}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'all-customers' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="fas fa-user-circle text-lg"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('document-list') }}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'document-list' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="fas fa-file-excel text-lg"></i>
                        <span>Documents</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('payments')}}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'payments' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="fas fa-wallet"></i>
                         <span>Payments</span>
                    </a>
                </li>

                <!-- Main Sidebar Link -->
                <li x-data="{ open:  true }">
                    <a href="#" @click.prevent="open = !open; "
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'reports' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="fa fa-file" aria-hidden="true"></i>
                        <span>Reports</span>
                        <i :class="{'fa-chevron-up': open, 'fa-chevron-down': !open}" class="fa ml-auto"></i>
                    </a>

                    <!-- Dropdown Menu -->
                    <ul x-show="open" class="ml-3 hover:text-white-100 text-sm text-white mt-2 space-y-2">
                        <li>
                            <a href="{{ route('tax-reports') }}" class="{{ Route::currentRouteName() == 'tax-reports' ? 'bg-gradient-primary' : 'hover:bg-white-700' }} flex items-center space-x-2 p-2  rounded">
                                <i class="fa fa-calculator" aria-hidden="true"></i>
                                <span>VAT/TOT Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('payroll-reports') }}" class="{{ Route::currentRouteName() == 'payroll-reports' ? 'bg-gradient-primary' : 'hover:bg-white-700' }} flex items-center space-x-2 p-2  rounded">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Payroll Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statement-reports') }}" class="{{ Route::currentRouteName() == 'statement-reports' ? 'bg-gradient-primary' : '' }} flex items-center space-x-2 p-2  rounded">
                                <i class="fa fa-file-alt" aria-hidden="true"></i>
                                <span>Statement Reports</span>
                            </a>
                        </li>
                    </ul>
                </li>




            </ul>
        </nav>
    </div>


</aside>