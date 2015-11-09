<?php namespace Blupl\Securex\Http\Controllers;

use Blupl\Securex\Model\Securex;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Orchestra\Foundation\Http\Controllers\AdminController;
use Orchestra\Support\Facades\Mail as Mailer;


class ApprovalController extends AdminController
{

    public function __construct()
    {
        $this->middleware('approval');
    }

    protected function setupFilters()
    {
        $this->beforeFilter('control.csrf', ['only' => 'delete']);
    }

    /**
     * Get landing page.
     *
     * @return mixed
     */
    public function index(Securex $securex)
    {
        return view('blupl/securex::approval.home-approval', compact('securex'));

    }


    /**
     * Show a role.
     */
    public function show($member, Request $request)
    {
        if($request->has('column') && $request->has('value')) {
            $members = Securex::where($request->get('column'), 'like', $request->get('value'))->where('status', '=', 0)->paginate(15);
        } else {
            $members = Securex::where('status', '=', 0)->paginate(15);
        }
        return view('blupl/securex::approval.list', compact('members'));
    }

    public function showReporter($memberID)
    {
        $member = Securex::find($memberID);


        if($member != null && $member->status == 0) {
            return view('blupl/securex::approval.member', compact('member'));
        }else {
            if($member->status == 1) {
                $massage = "Already Approved";
            } else {
                $massage = "Member Not Found";
            }
            Flash::error($massage);
            return $this->redirect(handles('blupl/securex::approval'));
        }
    }



    /**
     * Update the role.
     * @return mixed
     */
    public function update($memberId, Request $request)
    {
        $member = Securex::find($memberId);
        if ($member->status == 0 && $request->zone != null) {
            foreach ($request->zone as $key => $zone) {
                $member->zone()->create(['zone'=>$zone]);
            }
            $member->grade()->create(['grade'=>$request->grade, 'number'=>$request->number]);
            $member->status = 1;
            $member->save();
        }else {
            if($request->zone == null) {
                $massage = "Must Select One Zone";
                Flash::error($massage);
                return back();
            }elseif($member->status == 1) {
                $massage = "Already Approved";
            } else {
                $massage = "Reporter Not Found";
            }

            Flash::error($massage);
            return $this->redirect(handles('blupl/securex::approval'));
        }


        Flash::success($member->name.' Approved Successfully');
        return $this->redirect(handles('blupl/securex::approval/all'));

    }

    public function batchApproval(Request $request)
    {
        foreach ($request->member as $member) {
            $members[] = Securex::find($member);
        }
        return view('blupl/securex::approval.batch', compact('members'));
    }

    public function storeBatchApproval(Request $request)
    {
        foreach($request->member as $member) {
            $member =Securex::find($member);
            if ($member->status == 0 && $request->zone != null) {
                foreach ($request->zone as $key => $zone) {
                    $member->zone()->create(['zone'=>$zone]);
                }
                $member->grade()->create(['grade'=>$request->grade, 'number'=>$request->number]);
                $member->status = 1;
                $member->save();
            }else {
                $massage = "Must Select One Zone";
                Flash::error($massage);
                return $this->redirect(handles('blupl/securex::approval'));
            }
        }
        Flash::success(' Approved Successfully');
        return $this->redirect(handles('blupl/securex::approval/all'));

    }

    public function archive($memberId)
    {
        $member = Securex::find($memberId);
        $member->status = '3';
        $member->save();
        return $this->redirect(handles('blupl/securex::approval/all'));

    }

    public function pdf($memberID)
    {
        $member = Securex::find($memberID)->toArray();
        $pdf = App::make('dompdf');
        $pdf->loadView('blupl/securex::printing._print-single', $member);

        return $pdf->stream();
    }
}