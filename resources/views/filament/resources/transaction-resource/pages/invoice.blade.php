<x-filament-panels::page>
    {{-- {{ $transaction->customer }} --}}

    <div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow">
        {{-- header --}}
        <div class="flex items-center justify-between border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-700">Invoice</h1>
                <p class="text-gray-500">Invoice #{{ $transaction->id }}</p>
                <p class="text-gray-500">Date: {{ $transaction->created_at->format('d M Y') }}</p>
            </div>
            <div>
                <img src="" alt="Logo" class="h-16">
            </div>
        </div>

        {{-- billing --}}
        <div class="mt-6 grid grid-cols-2 gap-4">
            <div>
                <h2 class="font-bold text-gray-700">Billed To</h2>
                <p class="text-gray-600">John Doe</p>
                <p class="text-gray-600">Email</p>
            </div>
            <div class="text-right">
                <h2 class="font-bold text-gray-700">Company</h2>
                <p class="text-gray-600">Your Company name</p>
                <p class="text-gray-600">Email:</p>
            </div>
        </div>

        {{-- Invoice Items --}}
        <table class="mt-6 w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 p-2 text-left text-gray-700">Product</th>
                    <th class="border border-gray-200 p-2 text-right text-gray-700">Quantity</th>
                    <th class="border border-gray-200 p-2 text-right text-gray-700">Unit</th>
                    <th class="border border-gray-200 p-2 text-right text-gray-700">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-200 p-2 text-gray-600">Product</td>
                    <td class="border border-gray-200 p-2 text-right text-gray-600">2</td>
                    <td class="border border-gray-200 p-2 text-right text-gray-600">50</td>
                    <td class="border border-gray-200 p-2 text-right text-gray-600">100</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="bg-gray-100">
                    <td colspan="3" class="border border-gray-200 p-2 text-right font-bold text-gray-700">Subtotal
                    </td>
                    <td class="border border-gray-200 p-2 text-gray-700">$122.00</td>
                </tr>
                <tr>
                    <td colspan="3" class="border border-gray-200 p-2 text-right font-bold text-gray-700">Tax (10%)
                    </td>
                    <td class="border border-gray-200 p-2 text-gray-700">$12.00</td>
                </tr>
                <tr>
                    <td colspan="3" class="border border-gray-200 p-2 text-right font-bold text-gray-700">Total</td>
                    <td class="border border-gray-200 p-2 text-gray-700">$134.00</td>
                </tr>
            </tfoot>
        </table>

        {{-- Footer --}}
        <div class="mt-6 text-center text-gray-500">
            <p>Thank you for your business!</p>
        </div>
    </div>

</x-filament-panels::page>
