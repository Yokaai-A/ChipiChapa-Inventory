<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $faktur->nomor_invoice }}</title>
    <!-- We purposefully avoid navbar constraints and use simple print-ready Tailwind or CSS -->
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; margin: 0; padding: 20px; background: #fdfdfd; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); background: #fff; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px; }
        .header-company h1 { margin: 0; color: #4F46E5; font-size: 28px; letter-spacing: -1px; }
        .header-company p { margin: 5px 0 0 0; color: #666; font-size: 14px; }
        .header-invoice { text-align: right; }
        .header-invoice h2 { margin: 0 0 5px 0; color: #333; font-size: 24px; text-transform: uppercase; }
        .header-invoice p { margin: 0; color: #666; font-size: 14px; }
        .customer-info { margin-bottom: 40px; display: flex; justify-content: space-between; }
        .customer-info div { flex: 1; }
        .customer-info h4 { margin: 0 0 10px 0; color: #333; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid #eee; padding-bottom: 5px; display: inline-block; }
        .customer-info p { margin: 3px 0; font-size: 14px; line-height: 1.5; }
        table { w-full; width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { text-align: left; padding: 12px; background-color: #f8f9fa; border-bottom: 2px solid #ddd; font-size: 13px; text-transform: uppercase; color: #555; }
        td { padding: 12px; border-bottom: 1px solid #eee; vertical-align: top; font-size: 14px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row { font-weight: bold; font-size: 18px; }
        .total-row td { border-top: 2px solid #333; padding-top: 15px; }
        .print-btn { display: block; width: 100%; max-width: 200px; margin: 30px auto; padding: 12px; background: #4F46E5; color: white; text-align: center; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; font-weight: bold; }
        .print-btn:hover { background: #4338CA; }
        .badge { display: inline-block; padding: 2px 6px; background: #e0e7ff; color: #3730a3; border-radius: 3px; font-size: 11px; font-weight: bold; margin-bottom: 4px; }
        
        @media print {
            body { background: white; padding: 0; }
            .invoice-box { box-shadow: none; border: none; padding: 0; max-width: 100%; }
            .print-btn, .back-btn { display: none !important; }
        }

        .back-btn { display: inline-block; text-decoration: none; color: #666; margin-bottom: 20px; font-size: 14px; }
        .back-btn:hover { color: #333; text-decoration: underline; }
    </style>
</head>
<body>
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') ?? '/admin/products' }}" class="back-btn">&larr; Kembali ke Dashboard</a>
    @else
        <a href="{{ route('catalog') }}" class="back-btn">&larr; Kembali ke Katalog</a>
    @endif

    <div class="invoice-box">
        <div class="header">
            <div class="header-company">
                <h1>PT ChipiChapa</h1>
                <p>Aplikasi Pendataan Barang Terbaik</p>
            </div>
            <div class="header-invoice">
                <h2>INVOICE</h2>
                <p># {{ $faktur->nomor_invoice }}</p>
                <p>Tanggal: {{ $faktur->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="customer-info">
            <div>
                <h4>Ditagihkan Kepada:</h4>
                <p><strong>{{ $faktur->user->nama_lengkap }}</strong></p>
                <p>{{ $faktur->user->email }}</p>
                <p>{{ $faktur->user->no_hp }}</p>
            </div>
            <div style="margin-left: 40px;">
                <h4>Dikirim Ke:</h4>
                <p>{{ $faktur->alamat_pengiriman }}</p>
                <p>Kode Pos: {{ $faktur->kode_pos }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-right">Harga</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faktur->detailFakturs as $detail)
                <tr>
                    <td>
                        <strong>{{ $detail->product->nama_barang ?? 'Produk Terhapus' }}</strong>
                    </td>
                    <td class="text-center">
                        <span class="badge">{{ $detail->product->category->nama_kategori ?? '-' }}</span>
                    </td>
                    <td class="text-right">Rp. {{ number_format($detail->product->harga_barang ?? ($detail->subtotal / $detail->kuantitas), 0, ',', '.') }}</td>
                    <td class="text-center">x{{ $detail->kuantitas }}</td>
                    <td class="text-right">Rp. {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4" class="text-right">TOTAL KESELURUHAN</td>
                    <td class="text-right">Rp. {{ number_format($faktur->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 50px; text-align: center; color: #777; font-size: 12px; border-top: 1px dashed #ddd; padding-top: 20px;">
            Terima kasih telah berbelanja di PT ChipiChapa. Invoice ini adalah bukti transaksi yang sah.
        </div>
    </div>

    <button class="print-btn" onclick="window.print()">Cetak Faktur</button>
</body>
</html>
