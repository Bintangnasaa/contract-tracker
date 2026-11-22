<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::latest()->get();
        return view('equipments.index', compact('equipments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:kamera,audio,lighting,aksesoris',
            'stock' => 'required|integer|min:0',
        ]);

        Equipment::create($validated);

        return back()->with('success', 'Alat produksi berhasil ditambahkan!');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return back()->with('success', 'Alat berhasil dihapus!');
    }
}