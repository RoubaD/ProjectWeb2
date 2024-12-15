<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt for Reservation #{{ $reservation->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 10px;
        }
        h1 {
            text-align: center;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            font-size: 14px;
        }
        .total {
            font-weight: bold;
            margin-top: 20px;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <h1>Receipt for Reservation #{{ $reservation->id }}</h1>

    <div class="details">
        <p><strong>Client Name:</strong> {{ $reservation->user }}</p>
        <p><strong>Destination:</strong> {{ $reservation->destinationDetails->name }}</p>
        <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($reservation->start_date)->format('M d, Y') }}</p>
        <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($reservation->end_date)->format('M d, Y') }}</p>
        <p><strong>Reservation Date:</strong> {{ \Carbon\Carbon::parse($reservation->reserved_date)->format('M d, Y') }}</p>
    </div>

    <div class="total">
        <p><strong>Total Amount Paid:</strong> ${{ number_format($reservation->destinationDetails->price, 2) }}</p>
    </div>

    <div class="footer">
        <p>Thank you for your reservation!</p>
        <p>For any inquiries, contact us at support@hostapp.com</p>
    </div>

</body>
</html>
