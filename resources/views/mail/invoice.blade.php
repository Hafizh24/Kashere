<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice {{ $transaction->customer->name }}</title>
</head>

<body>
    <div
        style="margin-top: 40px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 5rem;">
        <h1 style="font-size: 1.5rem; line-height: 2rem; font-weight: 700;">Hello,
            <span style="font-weight: 700; color:#6b7280">{{ $transaction->customer->name }}</span>.
        </h1>
        <p style="margin-top: 12px; font-size: 18px; line-height: 28px;">Hooray, your transaction
            has been processed.
            Here are the
            transaction details on
            attachment:</p>
    </div>
</body>

</html>
