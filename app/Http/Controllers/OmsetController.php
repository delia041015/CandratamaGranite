<?php

namespace App\Http\Controllers;

use App\Models\Omset;
use Illuminate\Http\Request;
use App\Models\Grafik; 

class OmsetController extends Controller
{
    public function index()
    {
        $omsets = Omset::orderBy('tanggal', 'desc')->get();
        return view('omsets.index', compact('omsets'));
    }

    public function create()
    {
        return view('omsets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_klien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'project' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        Omset::create($request->all());

        return redirect()->route('omsets.index')->with('success', 'Data omset berhasil ditambahkan!');
    }

    public function edit(Omset $omset)
    {
        return view('omsets.edit', compact('omset'));
    }

    public function update(Request $request, Omset $omset)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_klien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'project' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        $omset->update($request->all());

        return redirect()->route('omsets.index')->with('success', 'Data omset berhasil diperbarui!');
    }

    public function destroy(Omset $omset)
    {
        $omset->delete();
        return redirect()->route('omsets.index')->with('success', 'Data omset berhasil dihapus!');
    }

    public function rekapBulanan()
    {
        $rekap = Omset::selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, SUM(nominal) as total_omset')
            ->groupBy('tahun', 'bulan')
            ->orderByDesc('tahun')
            ->orderBy('bulan')
            ->get();

        // Data untuk tabel dan grafik
        $data = [];
        $totals = []; // Untuk menyimpan total tahunan
        $labels = []; // Label tahun untuk grafik
        $totalPerTahun = []; // Data total omset untuk grafik

        foreach ($rekap as $item) {
            $tahun = $item->tahun;
            $bulan = $item->bulan;

            if (!isset($data[$tahun])) {
                $data[$tahun] = array_fill(1, 12, 0); // Default 0 tiap bulan
                $totals[$tahun] = 0; // Inisialisasi total tahunan
            }

            $data[$tahun][$bulan] = $item->total_omset;
            $totals[$tahun] += $item->total_omset;
        }

        // Siapkan data untuk grafik
        foreach ($totals as $tahun => $total) {
            $labels[] = $tahun;
            $totalPerTahun[] = $total;
        }

        return view('omsets.rekap', compact('data', 'totals', 'labels', 'totalPerTahun'));
    }



}
