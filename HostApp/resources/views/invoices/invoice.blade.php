<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $reservation->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            font-size: 16px;
            line-height: 1.6;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            border-top: 2px solid #ddd;
            margin-top: 20px;
            padding-top: 10px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .invoice-header div {
            flex: 1;
        }
        .invoice-header .right {
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="invoice-header">
            <div>
                <h1>Invoice #{{ $reservation->id }}</h1>
            </div>
            <div class="right">
                <p><strong>Issue Date:</strong> {{ \Carbon\Carbon::now()->format('M d, Y') }}</p>
                <p><strong>Reservation Date:</strong> {{ \Carbon\Carbon::parse($reservation->start_date)->format('M d, Y') }}</p>
            </div>
        </div>

        @if($reservation->destinationDetails)
        <div class="details">
            <p><strong>Destination:</strong> {{ $reservation->destinationDetails->name }}</p>
            <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($reservation->start_date)->format('M d, Y') }}</p>
            <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($reservation->end_date)->format('M d, Y') }}</p>
        </div>

        <div class="total">
            <p><strong>Total Price:</strong> ${{ number_format($reservation->destinationDetails->price, 2) }}</p>
        </div>
        @else
        <p>No destination details available for this reservation.</p>
        @endif

        <div class="footer">
            <p>&copy; {{ \Carbon\Carbon::now()->year }} Your Company Name. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
