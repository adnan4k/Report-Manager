<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Reports</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Business Name</th>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    TOT/VAT
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Payroll</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Statement</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($reports as $report )

                                @endforeach
                                <td>

                                    <p class="text-xs text-secondary mb-0">
                                        {{ $report->business ? $report->business->business_name : 'N/A' }}

                                    </p>

                                </td>
                                <td>
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{$report->tax_due_date}}</span>
                                    <span class="badge badge-sm bg-gradient-{{ $report->tax_status ? 'success' : 'warning' }}">Pending</span>

                                </td>
                                <td>
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{$report->payroll_due_date}}</span>
                                    <span class="badge badge-sm bg-gradient-{{ $report->payroll_status ? 'success' : 'warning' }}">Pending</span>

                                </td>
                                <td>
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{$report->statement_due_date}}</span>
                                    <span class="badge badge-sm bg-gradient-{{ $report->statement_status ? 'success' : 'warning' }}">Pending</span>

                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>