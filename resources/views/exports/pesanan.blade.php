<table class="table table-bordered table-md">
    <thead>
        <tr>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">ID Pesanan</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Tanggal</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Rute</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Waktu</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Mobil</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Pemesan</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Harga</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Tiket</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Perubahan Tanggal</th>
            <th class="text-center" style="border: 1px solid black" bgcolor="#609966">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pesanan as $psn)
            <tr>
                @foreach ($psn->keberangkatan as $item)
                    <td class="text-center text-black" style="border: 1px solid black">
                        <p class="font-italic text-uppercase">
                            PSN/{{ $item->id }}/{{ $item->asals->name }}/{{ $item->tujuans->name }}/{{ $psn->id }}
                        </p>
                    </td>
                    <td class="text-center text-black" style="border: 1px solid black">{{ $item->tanggal }}</td>
                    <td class="text-center text-black" style="border: 1px solid black">{{ $item->asals->name }} -
                        {{ $item->tujuans->name }}</td>
                    <td class="text-center text-black" style="border: 1px solid black">{{ $item->pukul }}</td>
                    <td class="text-center text-black" style="border: 1px solid black">{{ $item->mobils->nama }}</td>
                @endforeach

                @foreach ($psn->pemesan as $item)
                    <td class="text-center text-black" style="border: 1px solid black">{{ $item->name }}</td>
                @endforeach

                <td class="text-center text-black" style="border: 1px solid black">Rp.
                    {{ number_format($psn->biaya, 0, ',', '.') }}
                </td>

                @if ($psn->keterangan == 'Sudah Dibayar')
                    <td class="text-center text-black" style="border: 1px solid black">
                        <p class="badge badge-success">{{ $psn->keterangan }}</p>
                    </td>
                @elseif($psn->cancled != null)
                    <td class="text-center text-black" style="border: 1px solid black">
                        <p class="badge badge-danger">{{ $psn->cancled }}</p>
                    </td>
                @else
                    <td class="text-center text-black" style="border: 1px solid black">
                        <p class="badge badge-warning">{{ $psn->keterangan }}</p>
                        {{-- <form action="{{ route('konfirmasiPembayaran', $psn->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-info">Konfirmasi Pembayaran</button>
                                            </form> --}}
                    </td>
                @endif
                <td class="text-center text-black" style="border: 1px solid black">{{ $psn->update_tanggal }}</td>
                <td class="text-center text-black" style="border: 1px solid black">{{ $psn->is_update_tanggal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
