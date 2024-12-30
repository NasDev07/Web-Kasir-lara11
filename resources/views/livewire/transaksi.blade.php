<div>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                @if (!$transaksiAktif)
                    <button class="btn btn-primary" wire:click='transaksiBaru'>Transaksi Baru</button>
                @else
                    <button class="btn btn-danger" wire:click='batalTransaksi'>Batal Transaksi</button>
                @endif
                <button class="btn btn-info" wire:loading>Loading</button>
            </div>
        </div>

        @if ($transaksiAktif)
            <div class="row mt-2">
                <div class="col-8">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 class="card-title">No Invoice : {{ $transaksiAktif->kode }}</h4>
                            <input type="text" class="form-control" placeholder="No Invoice" wire:model.live='kode'>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaProduk as $produk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional($produk->produk)->kode }}</td>
                                            <td>{{ optional($produk->produk)->nama }}</td>
                                            <td>{{ number_format(optional($produk->produk)->harga ?? 0, 2, '.', ',') }}
                                            </td>
                                            <td>{{ $produk->jumlah ?? 0 }}</td>
                                            <td>{{ number_format((optional($produk->produk)->harga ?? 0) * ($produk->jumlah ?? 0), 2, '.', ',') }}
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    wire:click="hapusProduk({{ $produk->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 class="card-title">Total Biaya</h4>
                            <div class="d-flex justify-content-between">
                                <span>Rp. </span>
                                <span>{{ number_format($totalSemuaBelanja, 2, '.', ',') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card border-primary mt-2">
                        <div class="card-body">
                            <h4 class="card-title">Bayar</h4>
                            <input type="number" class="form-control" placeholder="Bayar" wire:model.live='bayar'>
                        </div>
                    </div>
                    <div class="card border-primary mt-2">
                        <div class="card-body">
                            <h4 class="card-title">Kembalian</h4>
                            <div class="d-flex justify-content-between">
                                <span>Rp. </span>
                                <span>{{ number_format($kembalian, 2, '.', ',') }}</span>
                            </div>
                        </div>
                    </div>
                    @if ($bayar)
                        @if ($kembalian < 0)
                            <div class="alert alert-danger mt-2">Uang Kurang</div>
                        @elseif ($kembalian > 0)
                            <button class="btn btn-success mt-2 w-100" wire:click='transaksiSelesai'>Bayar</button>
                        @endif
                    @endif
                </div>
            </div>
        @endif

    </div>

</div>
