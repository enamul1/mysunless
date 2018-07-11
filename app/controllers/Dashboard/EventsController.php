<?php
namespace App\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\EventDispatcher\Event;

class EventsController extends BaseDashboardController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
        $this->requirePermission('edit-events');
    }

    public function index()
    {
        $nearestFiveEvents = \Schedule::getNearestFiveEvents();
        return \View::make('dashboard/events/index')->with('nearestFiveEvents', $nearestFiveEvents);
    }

    public function createEvent()
    {
        \Schedule::sendReminderEmails();
        $id = Input::get('id');
        $eventDetails = array();
        $pageTitle = 'Add New Event';
        if ($id) {
            $eventDetails = \Schedule::getEventDetailsByEventId($id);
            $pageTitle = 'Edit New Event';
        }

        return \View::make('dashboard/events/creates',array(
            'notificationMessage' => \Session::get('notificationMessage'),
            'notificationType'    => \Session::get('notificationType')
        ))->with('eventDetails', $eventDetails)->with('pageTitle', $pageTitle);
    }

    public function saveEvent()
    {
        $input = \Input::all();
        $validator = \Schedule::validator($input);
        if ($validator->fails()) {
            return \Redirect::back()->withInput($input)->withErrors($validator);
        }

        $data = $input;
        $data['from_time'] = date('Y-m-d H:i:s', strtotime($input['event_date'] . ' ' . $input['event_hour_from']));
        $data['to_time'] = date('Y-m-d H:i:s', strtotime($input['event_date'] . ' ' . $input['event_hour_to']));
        $expressiveFromDate = new \ExpressiveDate($data['from_time']);
        $expressiveToDate = new \ExpressiveDate($data['to_time']);
        $today = date('Y-m-d H:i:s', strtotime('now'));
        $expressiveToday = new \ExpressiveDate($today);

        if ($expressiveToday->greaterThan($expressiveFromDate->addMinutes(10))) {
            return \Redirect::back()->withInput($input)->withErrors(array('event_hour_to' => 'Select a future date and time'));
        }

        if ($expressiveFromDate->greaterThan($expressiveToDate)) {
            return \Redirect::back()->withInput($input)->withErrors(array('event_hour_to' => 'Select a valid time range'));
        }

        $id = \Input::get('id');
        if ($id) {
            \Schedule::updateEvent($id, $data);
            $notificationMessage = "You have successfully edited the event.";
        } else {
            \Schedule::add($data);
            $notificationMessage = "You have successfully added a new event.";
        }

        return \Redirect::back()->with(array('notificationMessage' => $notificationMessage, 'notificationType' => 'success'));

    }

    public function getAllEvents()
    {
        $customerId = \Input::get('customerId');

        $eventsArray = \Schedule::getAllEventsByCustomerIdForCalenderDisplay($customerId);
        return \Response::json(array('success' => true, 'events' => $eventsArray), 200);
    }

    public function getEventDetails()
    {
        $eventId = \Input::get('eventId');

        $eventsArray = \Schedule::getEventByIdForCalenderDisplay($eventId);
        return \Response::json(array('success' => true, 'event' => $eventsArray), 200);
    }

    public function getClientsSuggestion()
    {
        $customerId = \Auth::getUser()->ID;

        $query = $_REQUEST["query"];
        $clients = \Client::getAllClientsOfACustomerByQuery($query, $customerId);

        $results = array();
        $results[] = array(
            'id' => 0,
            'newClient' => true,
            'img' => '<span class="img-circle"><i class="fa fa-user fa-2x"></i></span>',
            'add_new' => '<span class="text-primary">Add new Client</span>',
        );

        foreach ($clients as $key => $client) {
            $results[$key + 1] = array(
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'phone' => $client->phone,
                'email' => $client->email,
            	'address' => $client->address,
            	'zip' => $client->zip,
            	'city' => $client->city,
            	'state' => $client->state,
            );
            if (!empty($client->photo)) {
                $results[$key +1 ]['img'] = '<img src="'. $client->photo . '" class="img-circle" alt="">';

            } else {
                $results[$key + 1]['img'] = '<img src="/assets/dashboard/layout/img/avatar.png" class="img-circle" alt="">';
            }

        }
        return \Response::json($results, 200);

    }

    public function deleteEvent($eventId)
    {
        $event = \Schedule::find($eventId);
        if ($event instanceof \Schedule) {
            if (\UserRole::isCustomer() && $event->customer_id == \Auth::getUser()->Id) {
                return;
            }
            $event->delete();
        }
        return Redirect::to('/events');

    }

    public function settings()
    {
        $customerId = \Auth::getUser()->ID;

        $customersSetting = \CustomersSetting::getCustomersSettingByCustomerId($customerId);
        if (!$customersSetting instanceof \CustomersSetting) {
            //by default get global email instructions
            $customersSetting = new \stdClass();
            $customersSetting->email_instructions =  \Setting::getEmailInstructionText();
        }

        return \View::make('dashboard/events/settings',array(
            'notificationMessage' => \Session::get('notificationMessage'),
            'notificationType'    => \Session::get('notificationType')
        ))->with('settings', $customersSetting);

    }

    public function saveSettings()
    {
        $input = \Input::all();
        $rules = array(
            'email_instructions'=>'required|min:10:max:1000',
            'default_cost'=>'required',
            'reminder_message'=>'required_with:reminder_15,reminder_30,reminder_45',
        );

        $validator = \Validator::make($input, $rules);

        if ($validator->fails()) {
            return \Redirect::back()->withInput($input)->withErrors($validator);
        }
        \CustomersSetting::add(\Input::except('_token'));

        return \Redirect::back()->with(array('notificationMessage' => 1, 'notificationType' => 'success'));

    }
}
