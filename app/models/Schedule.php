<?php

class Schedule extends BaseModel {

    protected $table = 'events';

    /**
     * Soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

    public static $unguarded = true;
    
    /**
     * validate user input
     *
     * @param array $input
     * @return \Illuminate\Validation\Validator
     */
    public static function validator(array $input, $update=false)
    {
    	if (!$update) {
    		$rules = array(
    				'client_id' =>  'required|numeric',
    				'first_name' =>  'required',
    				'last_name' =>  'required',
    				'email' =>  'required | email',
    				'phone'=>array('required','regex:/^[\(]?(\d{0,3})[\)]?[\s]?[\-]?(\d{3})[\s]?[\-]?(\d{4})[\s]?[x]?(\d*)$/'),
    				'event_date'=> 'required|date',
    				'event_hour_from' => 'required|date_format:h:i A',
    				'event_hour_to' => 'required|date_format:h:i A',
    				'address' => 'required',
    				'zip' => 'required',
    				'city' => 'required',
    				'state' => 'required',
    				'cost' => 'required',
    				'email_instruction' => 'required',
    		);
    	} else {
    		$rules = array(
    			
    		);
    	}
    
    	return Validator::make($input, $rules);
    }
    
    /**
     * add a client
     *
     * @param array $data
     * @return Bool
     */
    public static function add(array $data)
    {	
        if ($data['client_id'] == 0) {
            $clientData = array(
                'customer_id' => Auth::user()->ID,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
            	'address' => $data['address'],
            	'zip' => $data['zip'],
            	'city' => $data['city'],
            	'state' => $data['state'],
            );

            $client = Client::add($clientData);
        } else {
            $client = Client::getClientById($data['client_id']);
        }

        if ($client instanceof Client) {

            $eventData = [
                'customer_id' => Auth::user()->ID,
                'client_id' => $client->id,
                'from_time' => $data['from_time'],
                'to_time' => $data['to_time'],
                'address' => $data['address'],
                'zip' => $data['zip'],
                'city' => $data['city'],
                'state' => $data['state'],
                'cost' => $data['cost'],
                'email_instruction' => $data['email_instruction'],
            ];
            $event =  self::create($eventData);
            
            if ($event instanceof Schedule) {
                $fromExpressiveDate = new \ExpressiveDate($event->from_time);
                $eventDetails['serviceDate'] = $fromExpressiveDate->getLongDate();
                $eventDetails['business_name'] = Auth::getUser()->company;
                $eventDetails['location'] = $event->address .', '.$event->zip.', '. $event->city.', '.$event->state;
                $eventDetails['cost'] =  money_format('%i', (float) $event->cost);
                $eventDetails['email_instruction'] =  $event->email_instruction;
                
                self::sendEmail($client->email,
                    $client->first_name .' '. $client->last_name,
                    "MySunless Event",
                    "dashboard/events/emailNewEvent",
                    array('eventDetails' => $eventDetails)
                );
            }
        }

        return false;

    }

    /**
     * add a client
     *
     * @param string id
     * @param array $data
     *
     * @return Bool
     */
    public static function updateEvent($eventId, array $data)
    {
        $schedule = self::getScheduleById($eventId);
        if ($schedule instanceof Schedule) {
            if ($data['client_id'] == 0) {
                $clientData = array(
                    'customer_id' => Auth::user()->ID,
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                );

                $client = Client::add($clientData);
            } else {
                $client = Client::getClientById($data['client_id']);
            }

            if ($client instanceof Client) {

                $eventData = [
                    'customer_id' => Auth::user()->ID,
                    'client_id' => $client->id,
                    'from_time' => $data['from_time'],
                    'to_time' => $data['to_time'],
                    'address' => $data['address'],
                    'zip' => $data['zip'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'cost' => $data['cost'],
                    'email_instruction' => $data['email_instruction'],
                ];
                $event =  self::where('id', $eventId)->update($eventData);

                if ($event instanceof Schedule) {
                    $fromExpressiveDate = new \ExpressiveDate($event->from_time);
                    $eventDetails['serviceDate'] = $fromExpressiveDate->getLongDate();
                    $eventDetails['business_name'] = Auth::getUser()->company;
                    $eventDetails['location'] = $event->location;
                    $eventDetails['cost'] =  money_format('%i', (float) $event->cost);
                    $eventDetails['email_instruction'] =  $event->email_instruction;
                    self::sendEmail($client->email,
                        $client->first_name . $client->last_name,
                        "MySunless Event",
                        "dashboard/events/emailNewEvent",
                        array('eventDetails' => $eventDetails)
                    );
                }
            }
        }

        return false;

    }

    /**
     * Get all events of a client
     *
     * @param $clientId
     * @return array
     */
    public static function getAllEventsByCustomerIdForCalenderDisplay($customerId)
    {
        $events = self::where('customer_id', $customerId)->get();
        $eventsArray = array();
        foreach ($events as $key => $event) {
            $eventsArray[$key]['id'] = $event->id;
            $eventsArray[$key]['client_id'] = $event->client_id;
            $eventsArray[$key]['from_time'] = strtotime($event->from_time);
            $eventsArray[$key]['to_time'] = strtotime($event->to_time);
            $eventsArray[$key]['address'] = $event->address;
            $eventsArray[$key]['cost'] = $event->cost;
            $eventsArray[$key]['isAlreadyPassed'] = false;
            $eventsArray[$key]['isToday'] = false;
            if (time() > $eventsArray[$key]['to_time']) {
                $eventsArray[$key]['isAlreadyPassed'] = true;
            } elseif (date('Ymd') == date('Ymd', $eventsArray[$key]['from_time'])) {
                $eventsArray[$key]['isToday'] = true;
            }
            $client = Client::getClientById($event->client_id);
            if ($client instanceof Client) {
                $eventsArray[$key]['client_name'] = $client->first_name . ' ' . $client->last_name;
                $eventsArray[$key]['client_phone'] = $client->phone;
                $eventsArray[$key]['client_email'] = $client->email;
            }
            $fromExpressiveDate = new ExpressiveDate($event->from_time);
            $toExpressiveDate = new ExpressiveDate($event->to_time);
            $barColorClass = 'panel-success';
            if ($fromExpressiveDate->lessThan(new ExpressiveDate())) {
                $barColorClass = 'panel-danger';
            }
            $eventsArray[$key]['htmlView'] = '
            <div class="panel ' . $barColorClass . ' ">
									<!-- Default panel contents -->
									<div class="panel-heading">
										<h3 class="panel-title">' . $fromExpressiveDate->getRelativeDate() .'</h3>
									</div>
									<div class="panel show-event-date alert alert-block alert-info fade in">
										<strong>' . $fromExpressiveDate->getLongDate()  .  ' to ' .  $toExpressiveDate->format('g:ia') . '</strong>
									</div>
									<!-- List group -->
									<ul class="list-group">
										<li class="list-group-item">
										<strong>Email:</strong> ' . $eventsArray[$key]['client_email'] . '
										</li>
										<li class="list-group-item">
										<strong>Phone:</strong> ' . $eventsArray[$key]['client_phone'] . '
										</li>
										<li class="list-group-item">
										<strong>Address:</strong> ' . $eventsArray[$key]['address'] . '
										</li>
										<li class="list-group-item">
										<strong>Cost:</strong> ' . $eventsArray[$key]['cost'] . '
										</li>
									</ul>
								</div>

            ';

        }
        return $eventsArray;
    }

    /**
     * get Event Details by event id
     *
     * @param string $eventId
     * @return Schedule
     */
    public static function getEventDetailsByEventId($eventId)
    {
        $eventDetails = self::getScheduleById($eventId);
        $client = Client::getClientById($eventDetails->client_id);
        $eventDetails['first_name'] = $client->first_name;
        $eventDetails['last_name'] = $client->last_name;
        $eventDetails['phone'] = $client->phone;
        $eventDetails['email'] = $client->email;
        $eventDate = new ExpressiveDate($eventDetails->from_time);
        $eventToTime = new ExpressiveDate($eventDetails->to_time);
        $eventDetails['event_date'] = $eventDate->format('d-m-Y');
        $eventDetails['event_hour_from'] = $eventDate->format('g:ia');
        $eventDetails['event_hour_to'] = $eventToTime->format('g:ia');

        return $eventDetails;

    }

    /**
     * get an schedule by id
     *
     * @param $eventId
     * @return Schedule
     */
    public static function getScheduleById($eventId)
    {
        return self::find($eventId);
    }
    /**
     * get event details for calendar display
     * @param $eventId
     * @return mixed
     */
    public static function getEventByIdForCalenderDisplay($eventId)
    {
        $event = self::find($eventId);
        $eventArray['id'] = $event->id;
        $client = Client::getClientById($event->client_id);
        if ($client instanceof Client) {
            $eventArray['client_name'] = $client->first_name . ' ' . $client->last_name;
            $eventArray['client_phone'] = $client->phone;
            $eventArray['client_email'] = $client->email;
        }

        return $eventArray;
    }
    
    /*
     * get all cost by months
     * 
     * @return array $monthlyGoals
     */
    public static function getMonthlyIncomes()
    {
		$customerId = Auth::user()->ID;
		$currentMonth = Date('m');
		$monthlyIncomes = \DB::select(DB::raw("SELECT `cost`, DAY(from_time) as day FROM `events` WHERE MONTH(from_time) = '$currentMonth' AND customer_id = $customerId"));
		return $monthlyIncomes;
    }
    
    /*
     * get montly income by customer id
     * 
     * @param string $customerId
     * @return float $totalMonthlyIncome
     */
     public static function getTotalMonthlyIncomeByCustomerId($customerId)
     {  	
		$currentMonth = Date('m');
		$totalMonthlyIncome = \DB::select(DB::raw("SELECT sum(cost) as total_income FROM `events` WHERE MONTH(from_time) = '$currentMonth' AND customer_id = $customerId"));
		return $totalMonthlyIncome;
     }
     
    /*
     * get yearly income by customer id
     * 
     * @param string $customerId
     * @return float $totalYearlyIncome
     */
     public static function getTotalYearlyIncomeByCustomerId($customerId)
     {  
		$currentYear= Date('Y');
		$totalYearlyIncome = \DB::select(DB::raw("SELECT sum(cost) as total_income FROM `events` WHERE YEAR(from_time) = '$currentYear' AND customer_id = $customerId"));
		return $totalYearlyIncome;
     }
     
    /*
     * get all cost by months
     * 
     * @return array $yearlyIncomes
     */
    public static function getYearlyIncomes()
    {
		$customerId = Auth::user()->ID;
		$currentYear = Date('Y');
		$yearlyIncomes = \DB::select(DB::raw("SELECT sum( `cost` ) AS cost, Month( from_time ) AS month FROM `events`
													WHERE YEAR( from_time ) = '$currentYear' AND customer_id = '$customerId'
													GROUP BY MONTH( from_time ) "));
		return $yearlyIncomes;
    }

    public static function sendReminderEmails()
    {
        $events = self::where('from_time', '<' , date('Y-d-m h:i:s', time()))->get();
        foreach ($events as $event) {
            $date = new ExpressiveDate($event->from_time);
            $oneDayReminder = false;
            $fifteenDaysReminder = false;
            $thirtyDaysReminder = false;
            $fortyDaysReminder = false;
            $differentInDays = $date->getDifferenceInDays();
            if ($differentInDays == 0 && $event->email_reminder_1 == 0) {
                $oneDayReminder = true;
            }
            if ($differentInDays == -15 && $event->email_reminder_15 == 0) {
                $fifteenDaysReminder = true;
            }
            if ($differentInDays == -30 && $event->email_reminder_30 == 0) {
                $thirtyDaysReminder = true;
            }
            if ($differentInDays == -45 && $event->email_reminder_45 == 0) {
                $fortyDaysReminder = true;
            }

            if ($oneDayReminder || $fifteenDaysReminder || $thirtyDaysReminder || $fortyDaysReminder) {
                $customerSetting = CustomersSetting::where('customer_id', $event->customer_id)->first();
                if ($customerSetting instanceof CustomersSetting) {
                    if ($oneDayReminder) {
                        $client = Client::getClientById($event->client_id);
                        if ($client instanceof Client) {
                            //send email
                            $fromExpressiveDate = new \ExpressiveDate($event->from_time);
                            $eventDetails['serviceDate'] = $fromExpressiveDate->getLongDate();
                            $eventDetails['business_name'] = Auth::getUser()->company;
                            $eventDetails['location'] = $event->location;
                            $eventDetails['cost'] =  money_format('%i', (float) $event->cost);
                            $eventDetails['email_instruction'] =  $event->email_instruction;
                            self::sendEmail($client->email,
                                $client->first_name . $client->last_name,
                                "MySunless Event - One Day Reminder",
                                "dashboard/events/emailNewEvent",
                                array('eventDetails' => $eventDetails)
                            );
                            $event->email_reminder_1 = 1;
                            $event->save();
                        }
                    }
                    if ($fifteenDaysReminder) {
                        //send email
                        $client = Client::getClientById($event->client_id);
                        if ($client instanceof Client) {
                            //send email
                            $fromExpressiveDate = new \ExpressiveDate($event->from_time);
                            $eventDetails['serviceDate'] = $fromExpressiveDate->getLongDate();
                            $eventDetails['business_name'] = Auth::getUser()->company;
                            $eventDetails['location'] = $event->location;
                            $eventDetails['cost'] =  money_format('%i', (float) $event->cost);
                            $eventDetails['email_instruction'] =  isset($customerSetting->email_instructions) ? $customerSetting->email_instructions : $event->email_instruction;
                            self::sendEmail($client->email,
                                $client->first_name . $client->last_name,
                                "MySunless Reminder",
                                "dashboard/events/emailNewEvent",
                                array('eventDetails' => $eventDetails)
                            );
                            $event->email_reminder_15 = 1;
                            $event->save();
                        }
                    }
                    if ($thirtyDaysReminder) {
                        //send email
                        $client = Client::getClientById($event->client_id);
                        if ($client instanceof Client) {
                            //send email
                            $fromExpressiveDate = new \ExpressiveDate($event->from_time);
                            $eventDetails['serviceDate'] = $fromExpressiveDate->getLongDate();
                            $eventDetails['business_name'] = Auth::getUser()->company;
                            $eventDetails['location'] = $event->location;
                            $eventDetails['cost'] =  money_format('%i', (float) $event->cost);
                            $eventDetails['email_instruction'] =  isset($customerSetting->email_instructions) ? $customerSetting->email_instructions : $event->email_instruction;
                            self::sendEmail($client->email,
                                $client->first_name . $client->last_name,
                                "MySunless Reminder",
                                "dashboard/events/emailNewEvent",
                                array('eventDetails' => $eventDetails)
                            );
                            $event->email_reminder_30 = 1;
                            $event->save();
                        }
                    }
                    if ($fortyDaysReminder) {
                        //send email
                        $client = Client::getClientById($event->client_id);
                        if ($client instanceof Client) {
                            //send email
                            $fromExpressiveDate = new \ExpressiveDate($event->from_time);
                            $eventDetails['serviceDate'] = $fromExpressiveDate->getLongDate();
                            $eventDetails['business_name'] = Auth::getUser()->company;
                            $eventDetails['location'] = $event->location;
                            $eventDetails['cost'] =  money_format('%i', (float) $event->cost);
                            $eventDetails['email_instruction'] =  $event->email_instruction;
                            self::sendEmail($client->email,
                                $client->first_name . $client->last_name,
                                "MySunless Reminder",
                                "dashboard/events/emailNewEvent",
                                array('eventDetails' => $eventDetails)
                            );
                            $event->email_reminder_45 = 1;
                            $event->save();
                        }
                    }
                }
            }

        }
        return $events;
    }

    /*
     * get total number of events in current month by customer id
     *
     * @param string $customerId
     * @return array $currentMonthEventCount
     */
    public static function getMonthlyEventsCountByCustomerId($customerId)
    {
        $currentMonth = Date('m');
        $currentMonthEventCount = \DB::select(DB::raw("SELECT count(*) as total_event FROM `events` WHERE MONTH(from_time) = '$currentMonth' AND customer_id = $customerId"));
        return $currentMonthEventCount;
    }

    /*
     * get 5 recent events of a customer
     *
     * @return $nearestFiveEventsArray
     */
    public static function getNearestFiveEvents()
    {
        $customerId = Auth::user()->ID;
        $nearestFiveEventsArray = array();
        $i = 0;
        $currentTime = date('Y-m-d H:i:s');
        $nearestFiveEvents = self::select('customer_id','client_id','location','from_time')->where('customer_id', $customerId)->where('from_time','>=',$currentTime)->orderBy('from_time', 'asc')->take(5)->get();

        foreach($nearestFiveEvents as $event) {
            $nearestFiveEventsArray[$i]['customer_id']  = $event->customer_id;
            $nearestFiveEventsArray[$i]['client_id']    = $event->client_id;
            $nearestFiveEventsArray[$i]['date']         = date("F, jS", strtotime($event->from_time));
            $nearestFiveEventsArray[$i]['location']     = $event->location;
            $clientFullName = Client::getClinetNameByClientId($event->client_id);
            $nearestFiveEventsArray[$i]['full_name']    = $clientFullName;
            $i++;
        }
        return $nearestFiveEventsArray;
    }
    
    /*
     * get event history by client id
     * 
     * @param int $clientId
     * @return array $eventHistory
     */
    public static function getClientEventHistoryByClientId($clientId)
    {
    	$eventHistory = self::select('from_time','cost')->where('client_id', $clientId)->get();
    	return $eventHistory;
    }

}
