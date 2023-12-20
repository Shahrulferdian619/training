<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\ChartController;
use App\Http\Controllers\Controller;
use App\Models\DaftarProduk;
use App\Models\Kebutuhan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function indexPenjualan ()
    {
        $penjualan = Penjualan::orderBy('tanggal', 'desc')->get();
        $produkTerlaris = $this->getProdukTerlaris();
        // dd($produkTerlaris->penjualanRinci->sum('qty'));
        $chartController = new ChartController();
        $dataChart = $chartController->index();
        // dd($dataChart);
        return view('page.laporan.penjualan.index', compact('penjualan', 'produkTerlaris', 'dataChart'));
    }

    private function getProdukTerlaris()
    {
        // Mendapatkan ID produk terlaris pada bulan ini
        $produkTerlarisId = DB::table('penjualan_rinci')
            ->select('daftar_produk_id', DB::raw('SUM(qty) as total_qty'))
            ->join('penjualan', 'penjualan_rinci.penjualan_id', '=', 'penjualan.id')
            ->whereMonth('penjualan.tanggal', now()->month)
            ->groupBy('daftar_produk_id')
            ->orderByDesc('total_qty')
            ->value('daftar_produk_id');

        // Mendapatkan data produk terlaris
        $produkTerlaris = DaftarProduk::find($produkTerlarisId);

        return $produkTerlaris;
    }

    public function showPenjualan ($id)
    {
        $penjualan = Penjualan::find($id);
        return view('page.laporan.penjualan.show', compact('penjualan'));
    }

    public function indexPembelian ()
    {
        $pembelian = Pembelian::orderBy('tanggal', 'desc')->get();
        return view('page.laporan.pembelian.index', compact('pembelian'));
    }

    public function showPembelian ($id)
    {
        $pembelian = Pembelian::find($id);
        return view('page.laporan.pembelian.show', compact('pembelian'));
    }

    public function indexKeuangan ()
    {
        $tanggal_awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggal_akhir = date('Y-m-d');

        return view('page.laporan.keuangan.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function dataKeuangan($awal, $akhir){
        $no = 1;
        $pendapatan = 0;
        $total_pendapatan = 0;
        $data = array();

        while(strtotime($awal) <= strtotime($akhir)){
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime('+1 day', strtotime($awal)));

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('grantotal');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal%")->sum('grantotal');
            $total_pengeluaran = Kebutuhan::where('created_at', 'LIKE', "%$tanggal%")->sum('grantotal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $total_pendapatan += $pendapatan;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = date('Y/m/d', strtotime($tanggal));
            $row['penjualan'] = number_format($total_penjualan, 0, ',', '.');
            $row['pembelian'] = number_format($total_pembelian, 0, ',', '.');
            $row['pengeluaran'] = number_format($total_pengeluaran, 0, ',', '.');
            $row['pendapatan'] = number_format($pendapatan, 0, ',', '.');

            $data[] = $row;
        }

        $data[] = [
            'DT_RowIndex'=>'',
            'tanggal'=>'',
            'penjualan'=>'',
            'pembelian'=>'',
            'pengeluaran'=>'Total Pendapatan',
            'pendapatan'=> number_format($total_pendapatan, 0, ',', '.'),
        ];

        return response()->json(['data' => $data]);
    }

    public function ubahPeriode (Request $req){
        $tanggal_awal = $req->tanggal_awal;
        $tanggal_akhir = $req->tanggal_akhir;

        return view('page.laporan.keuangan.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    public function forPDF ($awal, $akhir){
        $no = 1;
        $pendapatan = 0;
        $total_pendapatan = 0;
        $data = array();

        while(strtotime($awal) <= strtotime($akhir)){
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime('+1 day', strtotime($awal)));

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('grantotal');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal%")->sum('grantotal');
            $total_pengeluaran = Kebutuhan::where('created_at', 'LIKE', "%$tanggal%")->sum('grantotal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $total_pendapatan += $pendapatan;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = date('Y/m/d', strtotime($tanggal));
            $row['penjualan'] = number_format($total_penjualan, 0, ',', '.');
            $row['pembelian'] = number_format($total_pembelian, 0, ',', '.');
            $row['pengeluaran'] = number_format($total_pengeluaran, 0, ',', '.');
            $row['pendapatan'] = number_format($pendapatan, 0, ',', '.');

            $data[] = $row;
        }

        $data[] = [
            'DT_RowIndex'=>'',
            'tanggal'=>'',
            'penjualan'=>'',
            'pembelian'=>'',
            'pengeluaran'=>'Total Pendapatan',
            'pendapatan'=> number_format($total_pendapatan, 0, ',', '.'),
        ];

        return $data;
    }

    public function exportPDF($awal, $akhir)
    {
        $data = $this->forPDF($awal, $akhir);
        $pdf = Pdf::loadView('page.laporan.keuangan.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-pendapatan-' .date('Y-m-d-his'). '.pdf');
    }
}

