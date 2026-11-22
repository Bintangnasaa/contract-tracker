<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Equipment;
use App\Models\EquipmentLoan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentLoanController extends Controller
{
    public function index()
    {
        $loans = EquipmentLoan::with(['content', 'user', 'equipment'])->latest()->get();
        $equipments = Equipment::where('stock', '>', 0)->orderBy('name')->get();
        $contents = Content::where('status', '!=', 'published')->orderBy('title')->get();
        $crews = User::where('role', 'crew')->orderBy('name')->get();

        return view('loans.index', compact('loans', 'equipments', 'contents', 'crews'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content_id' => 'required|exists:contents,id',
            'user_id' => 'required|exists:users,id',
            'equipment_id' => 'required|exists:equipments,id',
            'qty' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
        ]);

        $equipment = Equipment::findOrFail($validated['equipment_id']);

        if ($equipment->stock < $validated['qty']) {
            return back()->withErrors(['qty' => 'Stok alat tidak mencukupi! Sisa stok: ' . $equipment->stock])->withInput();
        }

        DB::transaction(function () use ($validated, $equipment) {
            EquipmentLoan::create([
                'content_id' => $validated['content_id'],
                'user_id' => $validated['user_id'],
                'equipment_id' => $validated['equipment_id'],
                'qty' => $validated['qty'],
                'borrow_date' => $validated['borrow_date'],
                'status' => 'borrowed',
            ]);

            $equipment->decrement('stock', $validated['qty']);
        });

        return back()->with('success', 'Transaksi peminjaman berhasil! Stok alat otomatis berkurang.');
    }

    public function returnEquipment(EquipmentLoan $loan)
    {
        if ($loan->status === 'returned') {
            return back();
        }

        DB::transaction(function () use ($loan) {
            $loan->update([
                'status' => 'returned',
                'return_date' => now(),
            ]);

            $loan->equipment->increment('stock', $loan->qty);
        });

        return back()->with('success', 'Alat telah dikembalikan! Stok otomatis bertambah kembali.');
    }
}