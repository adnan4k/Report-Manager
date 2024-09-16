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
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'register-cusotmer' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="fas fa-user-circle text-lg"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('document-list') }}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'user-management' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="fas fa-file-excel text-lg"></i>
                        <span>Documents</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('statement-reports') }}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'tables' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="fa fa-file" aria-hidden="true"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('billing') }}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'billing' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="material-icons">receipt_long</i>
                        <span>Billing</span>
                    </a>
                </li>
            
                <li>
                    <a href="{{ route('rtl') }}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'rtl' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="material-icons">format_textdirection_r_to_l</i>
                        <span>RTL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('notifications') }}"
                        class="flex items-center space-x-2 p-2 rounded text-white transition {{ Route::currentRouteName() == 'notifications' ? 'bg-gradient-primary' : 'hover:bg-gray-700' }}">
                        <i class="material-icons">notifications</i>
                        <span>Notifications</span>
                    </a>
                </li>
                <li class="mt-3">
                    <h6 class="px-4 text-xs text-white font-bold">Account pages</h6>
                </li>

            </ul>
        </nav>
    </div>


</aside>