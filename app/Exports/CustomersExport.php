<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings,WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 30,
            'D' => 40,
            'E' => 20,
            'F' => 10,
            'G' => 10,

        ];
    }
    public function collection()
    {
        return User::with(['businesses'])->get()->map(function ($user) {
            // Aggregate data from businesses
            $businessData = $user->businesses->map(function ($business) {
                return [
                    'Business Name' => $business->business_name,
                    'Price' => $business->price,
                    'Payment Status' => $business->payment_status ?? 'Not Paid',
                    'TIN' => $business->tin ?? 'N/A'
                ];
            })->toArray();

            // Flatten business data into a single string
            $businessNames = collect($businessData)->pluck('Business Name')->implode(', ');
            $prices = collect($businessData)->pluck('Price')->implode(', ');
            $tins = collect($businessData)->pluck('TIN')->implode(', ');

            // Return combined data for each user
            return [
                'Customer' => $user->name,
                'Email' => $user->email,
                'Phone' => $user->phone ?? 'N/A',
                'Address' => $user->address ?? 'N/A',
                'Business Name' => $businessNames ?? 'N/A',
                'Price' => $prices ?? 'N/A',
                'TIN' => $tins ?? 'N/A'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Customer',
            'Email',
            'Phone',
            'Address',
            'Business Name',
            'Price',
            'TIN'
        ];
    }
}
