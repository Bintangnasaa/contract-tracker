<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;



class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::with('campaign');

        // Filter berdasarkan status, platform, atau pencarian judul
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('platform')) {
            $query->where('platform', $request->platform);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $contents = $query->orderBy('deadline', 'asc')->get();

        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        $campaigns = Campaign::where('status', 'active')->get();
        return view('contents.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'platform' => 'required|in:ig_reels,tiktok,youtube,shorts',
            'script_link' => 'nullable|url',
            'asset_link' => 'nullable|url',
            'status' => 'required|in:idea,scripting,shooting,editing,published',
            'deadline' => 'required|date',
        ]);

        Content::create($validated);

        return redirect()->route('contents.index')->with('success', 'Konten berhasil ditambahkan!');
    }

    public function show(Content $content)
    {
        $content->load(['campaign', 'tasks.user']);
        $crews = User::where('role', 'crew')->orderBy('name')->get();

        return view('contents.show', compact('content', 'crews'));
    }

    public function edit(Content $content)
    {
        $campaigns = Campaign::all();
        return view('contents.edit', compact('content', 'campaigns'));
    }

    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'platform' => 'required|in:ig_reels,tiktok,youtube,shorts',
            'script_link' => 'nullable|url',
            'asset_link' => 'nullable|url',
            'status' => 'required|in:idea,scripting,shooting,editing,published',
            'deadline' => 'required|date',
        ]);

        $content->update($validated);

        return redirect()->route('contents.index')->with('success', 'Konten berhasil diperbarui!');
    }

    public function updateStatus(Request $request, Content $content)
    {
        $request->validate([
            'status' => 'required|in:idea,scripting,shooting,editing,published',
        ]);

        $content->update(['status' => $request->status]);

        return back()->with('success', 'Status konten berhasil diubah!');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('contents.index')->with('success', 'Konten berhasil dihapus!');
    }
}