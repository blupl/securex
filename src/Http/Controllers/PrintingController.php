<?php namespace Blupl\Securex\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Blupl\Securex\Model\Securex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Orchestra\Foundation\Http\Controllers\AdminController;

class PrintingController extends AdminController
{

    public function __construct()
    {
        $this->middleware('printing');
    }

    protected function setupFilters()
    {
        $this->beforeFilter('control.csrf', ['only' => 'delete']);
    }

    /**
     * Get landing pages
     * @return mixed
     */
    public function index(Request $request)
    {
        if($request->has('column') && $request->has('value')) {
            $members = Securex::where($request->get('column'), 'like', $request->get('value'))->where('status', '=', 1)->paginate(15);
        } else {
            $members = Securex::where('status', '=', 1)->paginate(15);
        }
        return view('blupl/securex::printing.list-printing', compact('members'));
    }

    /**
     * Show a role.
     *
     * @param $memberId
     * @return mixed
     * @internal param int $roles
     *
     */
    public function show($memberId)
    {
        $member = Securex::find($memberId);
        $member->role = $member->roleName($member->role);
        $member->extension = 'securex';

        return view('common.printing.print-single', compact('member'));
    }

    public function pdf($memberId)
    {
        $mem = Securex::find($memberId);
        $mem->role = $mem->roleName($mem->role);
        $mem->zone= $mem->zone->toArray();
        $mem->grade= $mem->grade;
        $members[] = $mem->toArray();

        $pdf = App::make('dompdf');
        $pdf->setPaper('a7');
        $pdf->loadView('common.printing._print', compact('members'));

        return $pdf->stream();
    }

    public function batchPrinting(Request $request)
    {
//        dd(Securex::find($request->member[0])->zone);
        foreach($request->member as $member) {
            $mem = Securex::find($member);
            $mem->role = $mem->roleName($mem->role);
            $mem->zone= $mem->zone->toArray();
            $mem->grade= $mem->grade;
            $mem->organization = '';
            $members[] = $mem->toArray();
        }
        $pdf = App::make('dompdf');
        $pdf->setPaper('a7');
        $pdf->loadView('common.printing._print', compact('members'));

        return $pdf->stream();
    }
}