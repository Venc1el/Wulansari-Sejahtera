<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mailData['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 10px;
        }
        ul li strong {
            font-weight: bold;
        }
        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $mailData['title'] }}</h1>
        <br>
        <p>{{ $mailData['body'] }}</p>
        <br>
        <ul>
            <li><strong>Nomor Pesanan:</strong> {{ $mailData['order_id'] }}</li>
            <li><strong>Nama Pelanggan:</strong> {{ $mailData['customer_name'] }}</li>
            <li><strong>Alamat Pelanggan Email:</strong> {{ $mailData['customer_email'] }}</li>
            <li><strong>Nomor Telepon Pelanggan:</strong> {{ $mailData['customer_phone'] }}</li>
            <li><strong>Alamat Pelanggan:</strong> {{ $mailData['customer_address'] }}</li>
            <li><strong>Barang yang dipesan:</strong></li>
            <ul>
                @foreach($mailData['orderItems'] as $orderItem)
                <li>
                    <strong>{{ $orderItem['item_name'] }}</strong><br>
                    Jumlah: {{ $orderItem['quantity'] }}<br>
                    Total Harga: {{ $orderItem['total_price'] }}<br><br>
                </li>
                @endforeach
            </ul>
            <li><strong>Total Harga:</strong> {{ $mailData['total_amount'] }}</li>
        </ul>
        <br>
        <p>Mohon untuk segera memproses pesanan ini dan memberikan konfirmasi kepada pelanggan. </p>
        <p>Thank You</p>
    </div>
</body>
</html>
