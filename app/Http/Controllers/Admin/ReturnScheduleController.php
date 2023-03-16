<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Models\Returnschedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

class ReturnScheduleController extends Controller
{
    use HasUploader;

    public function index()
    {
        $schedules = Returnschedule::where('project_id', request('project_id'))->with('project')->latest()->paginate();
        return view('admin.return-schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.return-schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer',
            'return_type' => 'required|string',
            'profit_type' => 'required|string',
            'amount' => 'required|integer',
            'attachment' => 'nullable|file',
            'return_date' => 'required|date',
        ]);

        Returnschedule::create($request->except('attachment') + [
            'attachment' => $request->attachment ? $this->upload($request, 'attachment'):NULL,
        ]);

        return response()->json([
            'message' => __('Project return schedule created successfully.'),
            'redirect' => route('admin.return-schedules.index', $request->project_id),
        ]);
    }

    public function show($proejct_id, $id)
    {
        $schedule = Returnschedule::findOrFail($id);
        return Storage::download($schedule->attachment);
    }

    public function edit($proejct_id, $id)
    {
        $schedule = Returnschedule::findOrFail($id);
        return view('admin.return-schedules.edit', compact('schedule'));
    }

    public function update(Request $request, $proejct_id, $id)
    {
        $request->validate([
            'return_type' => 'required|string',
            'profit_type' => 'required|string',
            'amount' => 'required|integer',
            'attachment' => 'nullable|file',
            'return_date' => 'required|date',
        ]);

        $schedule = Returnschedule::findOrFail($id);
        $schedule->update($request->except('attachment') + [
            'attachment' => $request->attachment ? $this->upload($request, 'attachment') : $schedule->attachment,
        ]);

        return response()->json([
            'message' => __('Project return schedule updated successfully.'),
            'redirect' => route('admin.return-schedules.index', $schedule->project_id),
        ]);
    }

    public function destroy($id)
    {
        $schedule = Returnschedule::findOrFail($id);
        $schedule->delete();
        return response()->json([
            'message' => __('Project return schedule deleted successfully.'),
            'redirect' => route('admin.return-schedules.index', $schedule->project_id),
        ]);
    }
}
