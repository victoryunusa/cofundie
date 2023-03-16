<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Project;
use App\Models\Projectmeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:projects-create')->only('create', 'store');
        $this->middleware('permission:projects-read')->only('index', 'show');
        $this->middleware('permission:projects-update')->only('edit', 'update');
        $this->middleware('permission:projects-delete')->only('edit', 'destroy');
    }

    public function index()
    {
        $projects = Project::latest()->paginate();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'invest_type' => 'required|integer',
            'min_invest' => 'required|integer',
            'max_invest' => 'required|integer',
            'capital_back' => 'required|integer',
            'is_period' => 'required|integer',
            'profit_range' => 'required|string',
            'loss_range' => 'required|string',
            'location' => 'required|url',
            'address' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'required|string',
            'preview' => 'required|string',
            'installment_amount' => 'nullable|integer',
            'installment_duration' => 'nullable|integer',
            'late_fees' => 'nullable|integer'
        ]);

        $project = Project::create($request->all() + [
            'slug' => Str::slug($request->title)
        ]);
        Projectmeta::create([
            'key' => 'meta',
            'project_id' => $project->id,
            'value' => [
                'location' => $request->location,
                'description' => $request->description,
                'galleries' => $request->multi_images,
                'icon' => $request->icon,
                'text' => $request->text,
                'item' => $request->item,
            ],
        ]);
        Projectmeta::create([
            'key' => 'installments',
            'project_id' => $project->id,
            'value' => [
                'installment_amount' => $request->installment_amount,
                'total_installments' => $request->total_installments,
                'installment_duration' => $request->installment_duration,
                'late_fees' => $request->late_fees,
            ],
        ]);

        \Cache::forget('website.heading.' . current_locale());

        return response()->json([
            'message' => __('Project plan created successfully.'),
            'redirect' => route('admin.projects.index'),
        ]);
    }

    public function show($id)
    {
        $project = Project::with('meta')->findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::with('meta', 'installment')->findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'invest_type' => 'required|integer',
            'min_invest' => 'required|integer',
            'max_invest' => 'required|integer',
            'max_invest' => 'required|integer',
            'capital_back' => 'required|integer',
            'is_period' => 'required|integer',
            'status' => 'required|boolean',
            'profit_range' => 'required|string',
            'loss_range' => 'required|string',
            'location' => 'required|url',
            'address' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'required|string',
            'preview' => 'required|string',
            'accept_new_investor' => 'required|boolean',
            'installment_amount' => 'nullable|integer',
            'installment_duration' => 'nullable|integer',
            'late_fees' => 'nullable|integer'
        ]);

        $project = Project::with('meta')->findOrFail($id);
        $project->update($request->except('accept_installments') + [
            'slug' => Str::slug($request->title),
            'accept_installments' => $request->accept_installments ? 1 : 0,
        ]);
        $meta = Projectmeta::where('project_id', $id)->where('key', 'meta')->first();
        $meta->update([
            'key' => 'meta',
            'value' => [
                'location' => $request->location,
                'description' => $request->description,
                'galleries' => $request->multi_images,
                'icon' => $request->icon,
                'text' => $request->text,
                'item' => $request->item,
            ],
        ]);

        $project = Project::findOrFail($id);
        if ($project->accept_installments) {
            $projectmeta = Projectmeta::where('project_id', $id)->where('key', 'installments')->first();
            if ($projectmeta) {
                $projectmeta->update([
                    'key' => 'installments',
                    'project_id' => $id,
                    'value' => ['installment_amount' => $request->installment_amount, 'total_installments' => $request->total_installments, 'installment_duration' => $request->installment_duration, 'late_fees' => $request->late_fees],
                ]);
            }
            else {
                Projectmeta::create([
                    'key' => 'installments',
                    'project_id' => $id,
                    'value' => ['installment_amount' => $request->installment_amount, 'total_installments' => $request->total_installments, 'installment_duration' => $request->installment_duration, 'late_fees' => $request->late_fees],
                ]);
            }
        }
        \Cache::forget('website.heading.' . current_locale());
        return response()->json([
            'message' => __('Project plan updated successfully.'),
            'redirect' => route('admin.projects.index'),
        ]);
    }

    public function deleteAll(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $project = Project::find($id);
                if (file_exists($project->thumbnail)) {
                    Storage::delete($project->thumbnail);
                }
                if (file_exists($project->preview)) {
                    Storage::delete($project->preview);
                }
                $project->delete();
            }
            return response()->json([
                'message' => __('Projects deleted successfully'),
                'redirect' => route('admin.projects.index')
            ]);
        }
        else {
            return response()->json(__('Please select at least one item.'), 404);
        }
    }
}
