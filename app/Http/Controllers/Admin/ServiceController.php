<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Status;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::role(['customer', 'mechanic'])->get();
        $statuses = Status::all();
        return view('admin.services.create', compact('users', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:existing,new',
            'user_id' => 'nullable|exists:users,id',
            'customer_name' => 'nullable|string|max:255',
            'car' => 'required|string',
            'service' => 'required|string',
            'mechanic_ids' => 'required|string', // now coming as comma-separated IDs
        ]);
        
        $mechanicIds = explode(',', $request->mechanic_ids);
        
        // Validate each mechanic id manually
        foreach ($mechanicIds as $id) {
            if (!\App\Models\User::where('id', $id)->whereHas('roles', function($q){
                $q->where('name', 'mechanic');
            })->exists()) {
                return back()->withErrors(['mechanic_ids' => 'Invalid mechanic selected.']);
            }
        }
        
        $service = Service::create([
            'service_ticket' => 'SERV-' . str_pad(Service::max('id') + 1, 3, '0', STR_PAD_LEFT),
            'user_id' => $request->user_type === 'existing' ? $request->user_id : null,
            'customer_name' => $request->user_type === 'new' ? $request->customer_name : null,
            'car' => $request->car,
            'service' => $request->service,
            'price' => 5000,
            'assigned_mechanic' => implode(',', $mechanicIds),
            'status_id' => 3,
        ]);
        
    
        return redirect()->route("services.index")->with("success", "Service created successfully");
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $services = Service::findOrFail($id);
        $statuses = Status::all();
        $users = User::role(['customer', 'mechanic'])->get();
        return view('admin.services.edit', compact('users', 'statuses', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
    
        $request->validate([
            'car' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'mechanic_ids' => 'nullable|string', // comma-separated
            'user_type' => 'required|in:new,existing',
            'customer_name' => 'required_if:user_type,new|string|max:255',
            'user_id' => 'required_if:user_type,existing|nullable|exists:users,id',
        ]);
    
        // Determine customer
        if ($request->user_type === 'new') {
            $service->customer_name = $request->customer_name;
            $service->user_id = null; // unset any linked user
        } else {
            $service->user_id = $request->user_id;
            $service->customer_name = null; // unset name if using linked user
        }
    
        // Update other fields
        $service->car = $request->car;
        $service->service = $request->service;
        $service->assigned_mechanic = $request->mechanic_ids; // still comma-separated
    
        $service->save();
    
        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->route("services.index")->with("success", "Service deleted successfully");
    }
}
