<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        .general {
            width: 50%;
            border-collapse: collapse;
        }

        .table-info {
            width: 100%;
            border-collapse: collapse;
        }

        col-info {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>{{ $title }}</h2>

    @foreach ($pesanans->keberangkatan as $keberangkatan)
        <h3>
            <p class="text-uppercase">
                PSN/{{ $keberangkatan->id }}/{{ $keberangkatan->asals->name }}/{{ $keberangkatan->tujuans->name }}/{{ $pesanans->id }}
            </p>

        </h3>
        <table class="general">
            <tr>
                <td>Tanggal</td>
                <td>{{ $keberangkatan->tanggal }}</td>
            </tr>

            <tr>
                <td>Waktu</td>
                <td>{{ $keberangkatan->pukul }}</td>
            </tr>
            <tr>
                <td>Rute Perjalanan</td>
                <td>{{ $keberangkatan->asals->name }} - {{ $keberangkatan->tujuans->name }}</td>
            </tr>
            <tr>
                <td>Mobil</td>
                <td>{{ $keberangkatan->mobils->nama }}</td>
            </tr>
        </table>
    @endforeach
    <br>
    <table class="table-info">
        <tr style="border: 1px solid black;
            padding: 8px;
            text-align: left;">
            <td style="border: 1px solid black;
            padding: 8px;
            text-align: left;">Rute Perjalanan
            </td>
            <td style="border: 1px solid black;
            padding: 8px;
            text-align: left;">Pemesan</td>
            <td style="border: 1px solid black;
            padding: 8px;
            text-align: left;">Jumlah Pesanan
            </td>
            <td style="border: 1px solid black;
            padding: 8px;
            text-align: left;">Biaya</td>
            <td style="border: 1px solid black;
            padding: 8px;
            text-align: left;">Perubahan
                tanggal</td>

        </tr>
        <tr style="border: 1px solid black; padding: 8px; text-align: left;">
            @foreach ($pesanans->keberangkatan as $keberangkatan)
                <td style="border: 1px solid black; padding: 8px; text-align: left;">
                    {{ $keberangkatan->asals->name }} - {{ $keberangkatan->tujuans->name }}</td>
            @endforeach
            @foreach ($pesanans->pemesan as $pemesan)
                <td style="border: 1px solid black; padding: 8px; text-align: left;">
                    {{ $pemesan->name }}</td>
            @endforeach
            <td style="border: 1px solid black; padding: 8px; text-align: left;">
                {{ $pesanans->jml_bangku }}</td>
            <td style="border: 1px solid black;padding: 8px;text-align: left;">Rp.
                {{ number_format($pesanans->biaya, 0, ',', '.') }}</td>
            <td style="border: 1px solid black; padding: 8px; text-align: left;">
                {{ $pesanans->update_tanggal }}
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p style="text-align: right">PT Athira Travel</p> <br><br><br><br><br>
    <p style="text-align: right">..................................</p>

</body>

</html>
