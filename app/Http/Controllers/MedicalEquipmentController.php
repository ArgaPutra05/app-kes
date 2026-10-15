<?php

namespace App\Http\Controllers;

use App\Models\MedicalEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MedicalEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MedicalEquipment::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model_number', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Condition filter
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $allowedSorts = ['name', 'code', 'stock', 'price', 'created_at', 'purchase_date'];
        
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, strtolower($sortOrder) === 'asc' ? 'asc' : 'desc');
        } else {
            $query->latest();
        }

        $equipments = $query->paginate(9)->withQueryString();

        // Dashboard Stats
        $stats = [
            'total_types' => MedicalEquipment::count(),
            'total_stock' => MedicalEquipment::sum('stock'),
            'total_asset_value' => MedicalEquipment::selectRaw('SUM(stock * price) as asset_val')->value('asset_val') ?? 0,
            'good_condition' => MedicalEquipment::where('condition', 'Baik')->count(),
            'needs_repair' => MedicalEquipment::whereIn('condition', ['Perlu Perbaikan', 'Kalibrasi'])->count(),
            'broken' => MedicalEquipment::where('condition', 'Rusak')->count(),
        ];

        $categories = ['Diagnostic', 'Life Support', 'Surgical', 'Monitoring', 'Sterilization', 'Laboratory', 'Lainnya'];
        $conditions = ['Baik', 'Perlu Perbaikan', 'Rusak', 'Kalibrasi'];
        $locations = MedicalEquipment::select('location')->distinct()->pluck('location')->toArray();

        return view('alkes.index', compact('equipments', 'stats', 'categories', 'conditions', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ['Diagnostic', 'Life Support', 'Surgical', 'Monitoring', 'Sterilization', 'Laboratory', 'Lainnya'];
        $conditions = ['Baik', 'Perlu Perbaikan', 'Rusak', 'Kalibrasi'];
        
        // Auto-generate code candidate
        $lastId = MedicalEquipment::max('id') ?? 0;
        $suggestedCode = 'ALK-' . date('Y') . '-' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        return view('alkes.create', compact('categories', 'conditions', 'suggestedCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:medical_equipment,code',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'brand' => 'nullable|string|max:100',
            'model_number' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:150',
            'condition' => 'required|string|in:Baik,Perlu Perbaikan,Rusak,Kalibrasi',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'description' => 'nullable|string',
            'purchase_date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $uploadPath = public_path('uploads/alkes');
            
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $request->file('image')->move($uploadPath, $imageName);
            $validated['image'] = $imageName;
        }

        MedicalEquipment::create($validated);

        return redirect()->route('alkes.index')->with('success', 'Alat kesehatan medis berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $equipment = MedicalEquipment::findOrFail($id);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $equipment,
                'formatted_price' => $equipment->formatted_price,
                'image_url' => $equipment->image_url,
                'condition_badge' => $equipment->condition_badge_class,
            ]);
        }

        return view('alkes.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipment = MedicalEquipment::findOrFail($id);
        $categories = ['Diagnostic', 'Life Support', 'Surgical', 'Monitoring', 'Sterilization', 'Laboratory', 'Lainnya'];
        $conditions = ['Baik', 'Perlu Perbaikan', 'Rusak', 'Kalibrasi'];

        return view('alkes.edit', compact('equipment', 'categories', 'conditions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $equipment = MedicalEquipment::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:medical_equipment,code,' . $id,
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'brand' => 'nullable|string|max:100',
            'model_number' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:150',
            'condition' => 'required|string|in:Baik,Perlu Perbaikan,Rusak,Kalibrasi',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'description' => 'nullable|string',
            'purchase_date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = public_path('uploads/alkes');

            // Delete old image if present
            if ($equipment->image && File::exists($uploadPath . '/' . $equipment->image)) {
                File::delete($uploadPath . '/' . $equipment->image);
            }

            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $request->file('image')->move($uploadPath, $imageName);
            $validated['image'] = $imageName;
        }

        $equipment->update($validated);

        return redirect()->route('alkes.index')->with('success', 'Data alat kesehatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipment = MedicalEquipment::findOrFail($id);

        if ($equipment->image) {
            $imagePath = public_path('uploads/alkes/' . $equipment->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $equipment->delete();

        return redirect()->route('alkes.index')->with('success', 'Data alat kesehatan berhasil dihapus!');
    }
}
