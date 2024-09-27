<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">tax Reports</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-3">
                                    Business Name
                                </th>
                                <th scope="col" class="px-3 py-3">
                                    Tax type
                                </th>
                              
                                <th scope="col" class="px-3 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-3 py-3 text-center">
                                    Due Date
                                </th>
                                <th scope="col" class="px-3 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $report->business ? $report->business->business_name : 'N/A' }}
                                </td>
                                <td class="uppercase px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $report->business ? $report->business->tax_type : 'N/A' }}
                                </td>
                                <td class="px-3 py-4">
                                    <span class="badge {{ $report->tax_status ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-2 py-1 rounded">
                                        {{ $report->tax_status ? 'Reported' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="px-3 py-4 text-center">
                                    <span class="text-gray-500">{{ \Carbon\Carbon::parse($report->tax_due_date)->format('F j, Y') }}</span>
                                </td>
                                <td class="px-3 py-4 text-center">
                                    <button id="changeStatusButton-{{ $report->id }}" class="text-blue-600 dark:text-blue-500 hover:underline">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="changeStatusModal-{{ $report->id }}" tabindex="-1" aria-labelledby="changeStatusLabel-{{ $report->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-lg text-gray-800" id="changeStatusLabel-{{ $report->id }}">
                                                        Change Status
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="flex flex-col">
                                                        <label class="text-black mt-3">{{ __('Status') }}</label>
                                                        <select wire:model="statuses.{{ $report->id }}" class="form-select mt-1 p-2 border border-gray-300 rounded focus:ring focus:ring-indigo-500">
                                                            <option value="0">Pending</option>
                                                            <option value="1">Reported</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button wire:click="changeStatus({{ $report->id }})" type="button" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<script>
    // Add event listeners for all buttons with unique ids
    document.querySelectorAll('[id^="changeStatusButton-"]').forEach(button => {
        button.addEventListener('click', function() {
            const reportId = this.id.split('-')[1]; // Extract the report id
            const modal = document.getElementById('changeStatusModal-' + reportId); // Find corresponding modal
            const modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        });
    });

    window.addEventListener('status-updated', event => {
        // Hide any open modal
        const modals = document.querySelectorAll('.modal.show'); // Select all currently visible modals
        modals.forEach(modal => {
            const modalInstance = bootstrap.Modal.getInstance(modal); // Get the instance of the currently open modal
            if (modalInstance) {
                modalInstance.hide(); // Hide the modal
            }
        });

        // Display Toastr notification
        Toastify({
            text: "Status successfully updated",
            className: "info",
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
        }).showToast();
    });
</script>