<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Mobil;
use App\Models\Pesanan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class LaporanExportView implements FromView, WithColumnWidths
{
   protected $filter;

    public function __construct(array $filter)
    {
        $this->filter = $filter;
    }

    public function view(): View
    {
        $pesanan = Pesanan::with(['keberangkatan','keberangkatan.mobils','keberangkatan.tujuans','keberangkatan.asals'])
            ->when($this->filter['bulan'] ?? false, function ($q, $bulan) {
                $bulan = Carbon::parse($bulan)->toDate();
                return $q->whereHas('keberangkatan', function ($q) use ($bulan) {
                    $q->whereMonth('tanggal', $bulan->format('m'))
                      ->whereYear('tanggal', $bulan->format('Y'));
                });
            })->when($this->filter['mobil'] ?? false, function ($q, $mobil) {
                return $q->whereHas('keberangkatan.mobils', function ($q) use ($mobil) {
                    $q->where('mobil_id', $mobil);
                });
            })
            ->orderBy('id','desc')
            ->get();

        return view('exports.pesanan', [
            'pesanan' => $pesanan
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,  // ID column
            'B' => 30,  // Tanggal column
            'C' => 30,  // Mobil column
            'D' => 30,  // Tujuan column
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,  // Asal column
            // Add other column widths as needed
        ];
    }
}
