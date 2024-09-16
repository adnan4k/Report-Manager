<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Statement Reports</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Business Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <td class="text-sm">
                                    <p class="pl-5 text-[14px] text-gray-500 font-weight-bold mb-0">
                                        {{ $report->business ? $report->business->business_name : 'N/A' }}
                                    </p>
                                </td>
                                <td>
                                    <p class="badge badge-sm bg-gradient-{{ $report->statement_status ? 'success' : 'warning' }}">{{ $report->statement_status ? 'Reported' : 'Pending' }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-secondary text-xs font-weight-bold">{{$report->statement_due_date}}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <!-- Edit button with modal -->
                                    <button id="changeStatusButton-{{ $report->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="changeStatusModal-{{ $report->id }}" tabindex="-1" aria-labelledby="changeStatusLabel-{{ $report->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-success text-lg" id="changeStatusLabel-{{ $report->id }}">{{ __('Change Status') }}</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="iconify" data-icon="akar-icons:cross"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Modal Inner Form Box Start -->
                                                    <div class="modal-inner-form-box">
                                                        <div class="row">
                                                            <div class="flex flex-row">
                                                                <label class="text-black color-heading font-medium mt-3 mx-2">{{ __('Status') }}</label>
                                                                <!-- Wire model the status field -->
                                                                <select wire:model="statuses.{{ $report->id }}" name="status" class="form-select block w-full mt-1 p-2 border border-black-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                                    <option value="0">{{ __('Pending') }}</option>
                                                                    <option value="1">{{ __('Reported') }}</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Inner Form Box End -->
                                                </div>
                                                <div class="modal-footer justify-content-start">
                                                    <button type="button" class="theme-btn-back me-3 btn btn-secondary" data-bs-dismiss="modal" title="{{ __('Cancel') }}">{{ __('Back') }}</button>
                                                    <!-- Wire click the changeStatus method with the report id -->
                                                    <button wire:click="changeStatus({{ $report->id }})" type="button" class="theme-btn me-3 btn btn-success" title="{{ __('Change') }}">{{ __('Submit') }}</button>
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
        console.log('event is here', event.detail)
    });
</script>