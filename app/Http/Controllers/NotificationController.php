<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class NotificationController extends AppBaseController
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the Notification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $notifications = Notification::paginate(config('app.limit'));

        return view('notifications.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
    public function create()
    {
        return view('notifications.create');
    }

    /**
     * Store a newly created notification in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        return Validator::make($request->all(), [ 
            'title' => 'required', 
            'description' => 'required'
        ]);
       
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $coupon = Notification::create($input);

        Flash::success('Notification saved successfully.');

        return redirect(route('notifications.index'));
    }

    /**
     * Display the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('notifications.index'));
        }

        return view('notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notification = Notification::find($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('notifications.index'));
        }

        return view('notifications.edit')->with('notification', $notification);
    }

    /**
     * Update the specified notification in storage.
     *
     * @param int $id
     * @param UpdateCouponRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        return Validator::make($request->all(), [ 
            'title' => 'required', 
            'description' => 'required'
        ]);
       
        $notification = Notification::find($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('notifications.index'));
        }
        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $notification = Notification::update($input, $id);

        Flash::success('Notification updated successfully.');

        return redirect(route('notifications.index'));
    }

    /**
     * Remove the specified Notification from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('notifications.index'));
        }

        Notification::delete($id);

        Flash::success('Notification deleted successfully.');

        return redirect(route('notifications.index'));
    }
}
