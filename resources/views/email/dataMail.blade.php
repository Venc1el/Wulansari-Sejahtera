<h1>{{ $mailData['title'] }}</h1>
<br>
<p>{{ $mailData['body'] }}</p>
<br>
<ul>
    <li><strong>Nomor Pesanan:</strong> {{ $mailData['order_id'] }}</li>
    <li><strong>Nama Pelanggan:</strong> {{ $mailData['customer_name'] }}</li>
    <li><strong>Alamat Pelanggan Email:</strong> {{ $mailData['customer_email'] }}</li>
    <li><strong>Barang yang dipesan:</strong></li>
    <ul>
        @foreach($mailData['orderItems'] as $orderItem)
        <li>
            <strong>{{ $orderItem['item_name'] }}</strong><br>
            Jumlah: {{ $orderItem['quantity'] }}<br>
            Total Harga: {{ $orderItem['quantity'] * $orderItem['price'] }}<br><br>
        </li>
        @endforeach
    </ul>
    <li><strong>Total Harga:</strong> {{ $mailData['total_amount'] }}</li>
</ul>
<br>
<p>Mohon untuk segera memproses pesanan ini dan memberikan konfirmasi kepada pelanggan. </p>
<p>Thank You</p>
