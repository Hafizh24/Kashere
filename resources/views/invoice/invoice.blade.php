<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice {{ $transaction->customer->name }}</title>
</head>

<body>
    {{-- <div>{{ $name }}</div> --}}
    <div
        style="background-color: white; border-radius: 0.5rem; padding: 1.5rem; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 30rem; margin: 0 auto;">
        {{-- header --}}
        <div
            style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">
            <div>
                <h1 style="font-size: 1.5rem; line-height: 2rem; font-weight: 700; color: #374151">Invoice</h1>
                <p style="color: #6b7280">Invoice #{{ $transaction->id }}</p>
                <p style="color: #6b7280">Date: {{ $transaction->created_at->format('d M Y') }}</p>
            </div>
            <div>
                <img src="" alt="Logo" class="h-16">
            </div>
        </div>

        {{-- billing --}}
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div>
                <h2 style="font-weight: 700; color: #374151">Billed To</h2>
                <p style="color:#4b5563">{{ $transaction->customer->name }}</p>
                <p style="color:#4b5563">{{ $transaction->customer->email }}</p>
            </div>
            <div style="text-align: right;">
                <h2 style="font-weight: 700; color: #374151">Company</h2>
                {{-- <p style="color:#4b5563">{{ $name }}</p> --}}
                {{-- <p style="color:#4b5563">{{ $email }}</p> --}}
            </div>
        </div>

        {{-- Invoice Items --}}
        <table
            style="margin-top: 1.5rem; width: 100%; border-width: 1px; border-collapse: collapse; border-color: #e2e8f0;">
            <thead>
                <tr style="background-color: #f4f4f6">
                    <th style="border-width: 1px; borcder-color: #e2e8f0; text-align: left; color: #374151">Product</th>
                    <th
                        style="border-width: 1px; border-color: #e2e8f0; text-align: right; color: #374151; padding: 0.5rem">
                        Quantity</th>
                    <th
                        style="border-width: 1px; border-color: #e2e8f0; text-align: right; color: #374151; padding: 0.5rem">
                        Unit Price</th>
                    <th
                        style="border-width: 1px; border-color: #e2e8f0; text-align: right; color: #374151; padding: 0.5rem">
                        Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->transactionProducts as $item)
                    <tr>
                        <td style="border-width: 1px; border-color: #e2e8f0; padding: 0.5rem; color: #4b5563">
                            {{ $item->product->name }}</td>
                        <td
                            style="border-width: 1px; border-color: #e2e8f0; padding: 0.5rem; color: #4b5563; text-align: center">
                            {{ $item->quantity }}</td>
                        <td
                            style="border-width: 1px; border-color: #e2e8f0; padding: 0.5rem; color: #4b5563; text-align: right">
                            {{ number_format($item->unit_amount, 2, '.', ',') }}</td>
                        <td
                            style="border-width: 1px; border-color: #e2e8f0; padding: 0.5rem; color: #4b5563; text-align: right">
                            {{ number_format($item->total_amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #f4f4f6">
                    <td colspan="3"
                        style="border-width: 1px; border-color: #e2e8f0; text-align: right; color: #374151; padding: 0.5rem">
                        Tax
                    </td>
                    <td style="border-width: 1px; border-color: #e2e8f0; color: #374151; padding: 0.5rem">
                        {{ Number::currency($transaction->tax, 'IDR') }}</td>
                </tr>
                {{-- <tr>
                    <td colspan="3"
                        style="border-width: 1px; border-color: #e2e8f0; text-align: right; color: #374151; padding: 0.5rem">
                        Tax (10%)
                    </td>
                    <td style="border-width: 1px; border-color: #e2e8f0; color: #374151; padding: 0.5rem">$12.00</td>
                </tr> --}}
                <tr>
                    <td colspan="3"
                        style="border-width: 1px; border-color: #e2e8f0; text-align: right; color: #374151; padding: 0.5rem">
                        Total</td>
                    <td style="border-width: 1px; border-color: #e2e8f0; color: #374151; padding: 0.5rem">
                        {{ Number::currency($transaction->grand_total, 'IDR') }}</td>
                </tr>
            </tfoot>
        </table>

        {{-- Footer --}}
        <div style="margin-top: 1.5rem; text-align: center; color: #6b7280">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>

</html>
