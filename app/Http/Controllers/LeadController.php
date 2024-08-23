<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\LeadRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class LeadController extends Controller
{
    public function __construct(
        private LeadRepositoryInterface $leadRepositoryInterface,
        private StatusRepositoryInterface $statusRepositoryInterface,
    ) {}

    public function index(): \Inertia\Response
    {
        return Inertia::render('Lead/Index', [
            'title' => 'Leads page - ' . config('app.name'),
        ]);
    }

    public function get()
    {
        $leads = $this->leadRepositoryInterface->get();
        $countAllLeads = $this->leadRepositoryInterface->countAllLeads();
        $countLeadsInStatusNew = $this->leadRepositoryInterface->countLeadsInStatusNew();
        $countLeadsInStatusAtWork = $this->leadRepositoryInterface->countLeadsInStatusAtWork();
        $countLeadsInStatusCompleted = $this->leadRepositoryInterface->countLeadsInStatusCompleted();
        $statuses = $this->statusRepositoryInterface->get();

        return [
            'leads' => $leads,
            'countAllLeads' => $countAllLeads,
            'countLeadsInStatusNew' => $countLeadsInStatusNew,
            'countLeadsInStatusAtWork' => $countLeadsInStatusAtWork,
            'countLeadsInStatusCompleted' => $countLeadsInStatusCompleted,
            'statuses' => $statuses,
        ];
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Lead/Create', [
            'title' => 'Main page - ' . config('app.name'),
            'success' => session('success') ?? null,
            'errors' => session('errors') ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['string', 'required', 'max:255'],
            'surname' => ['string', 'required', 'max:255'],
            'phone' => ['string', 'required', 'unique:leads,phone', 'min:7', 'max:15'],
            'email' => ['string', 'required', 'email:rfc,dns', 'unique:leads,email', 'max:255'],
            'text' => ['string', 'required', 'max:255'],
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        }

        $this->leadRepositoryInterface->store($request);

        return back()->with('success', 'Lead created successfully.');
    }

    public function delete(int $id)
    {
        $this->leadRepositoryInterface->delete($id);
    }

    public function updateStatus(Request $request, int $id)
    {
        $this->leadRepositoryInterface->updateStatus($id, $request->status);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['string', 'required', 'max:255'],
            'surname' => ['string', 'required', 'max:255'],
            'phone' => ['string', 'required', 'min:7', 'max:16'],
            'email' => ['string', 'required', 'email:rfc,dns', 'max:255'],
        ]);

        if ($validator->fails()) {
            return ['errors' =>  $validator->errors()];
        }

        $this->leadRepositoryInterface->update($id, $request);

        return ['success' => 'Lead updated successfully.'];
    }
}
