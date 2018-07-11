<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Client extends BaseModel {

    protected $table = 'clients';

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
    				'first_name' =>  'required',
    				'last_name' =>  'required',
    				'email' =>  'email|unique:clients',
    				'phone'=>array('required','regex:/^[\(]?(\d{0,3})[\)]?[\s]?[\-]?(\d{3})[\s]?[\-]?(\d{4})[\s]?[x]?(\d*)$/'),
    				'address'=>'required',
    				'city' => 'required',
    				'state' => 'required',
    				'zip' => 'required',
    				'photo' => 'mimes:jpg,jpeg|max:5000',
    				'profile_photo' => 'mimes:jpg,jpeg|max:5000'
    		);
    	} else {
    		$rules = array(
    				'first_name' =>  'required',
    				'last_name' =>  'required',
    				'email' =>  'email',
    				'phone'=>array('required','regex:/^[\(]?(\d{0,3})[\)]?[\s]?[\-]?(\d{3})[\s]?[\-]?(\d{4})[\s]?[x]?(\d*)$/'),
    				'address'=>'required',
    				'city' => 'required',
    				'state' => 'required',
    				'zip' => 'required',
    		);
    	}
    
    	return Validator::make($input, $rules);
    }
    
    /**
     * add a client
     *
     * @param array $data
     * @return Client
     */
    public static function add(array $data)
    {
    	return self::create($data);
    }
    
    /*
     * get clients by customer id
     * 
     * @param string $id
     * @return array $clients
     */
    public static function getClientsByCustomerID($id)
    {
    	$clients = self::where('customer_id',$id)->get();
    	return $clients;
    }

    /**
     * get Client by id
     *
     * @param $clientId
     * @return Client
     */
    public static function getClientById($clientId)
    {
        return self::find($clientId);
    }

    /**
     * get All clients of a customer
     *
     * @param $query
     * @return array
     */
    public static function getAllClientsOfACustomerByQuery($query, $customerId = 0)
    {
        $clients = self::where('customer_id', $customerId)->where('first_name', 'LIKE', '%'. $query .'%')->get();
        return $clients;
    }
    
    /**
     * check if a client is belong to a customer
     * 
     * @param string $customerId
     * @param string $clientId
     * @return boolean
     */
    public static function isAClientOfThisCustomer($customerId, $clientId)
    {
    	$client = self::where('customer_id',$customerId)->where('id',$clientId)->get();
    	if(!$client->isEmpty()) {
    		return true;
    	}
    	return false;
    }
    
    /*
     * get all clients
     * 
     * @return array $clients
     */
    public static function getAllClient()
    {
    	$clients = self::get();
    	return $clients;
    }

    /**
     * get url of a client profile pic
     *
     * @param string $type
     * @return string
     */
    public static function getClientPictureById($clientId, $type = 'thumbnail')
    {
        $client = self::getClientById($clientId);
        if (!$client instanceof Client) {
            return;
        }

        if ($client->profile_photo == null) {
            if ($type == 'small') {
                return '/assets/dashboard/layout/img/Tan-Avatar.jpg';
            }
        }
        $clientId = $client->id;

        switch ($type) {
            case 'thumbnail' :
                $url = '/uploads/clients/user_thumbnail_' . $clientId . '.jpg';
                break;
            case 'small' :
                $url = '/uploads/clients/user_small_' . $clientId . '.jpg';
                break;
            default :
                $url = '/uploads/clients/user_thumbnail_' . $clientId . '.jpg';
        }
        return $url;

    }
    
    /*
     * get client full address
    *
    * @return string $address
    */
    public static function getClientFullAddress($id)
    {
    	$client = self::select('address','zip','city','state')->where('id', $id)->first();
    	$address = str_ireplace(" ","+",$client->address).',+'.$client->zip.',+'.str_ireplace(" ","+",$client->city).',+'.str_ireplace(" ","+",$client->state);
    	return $address;
    }

    public static function getClinetNameByClientId($clientId)
    {
        $client = self::select('first_name','last_name')->where('id', $clientId)->first();
        $clientFullName = $client->first_name." ".$client->last_name;
        return $clientFullName;
    }
    
    public static function countryList()
    {
    	$countries = array(
				"-1" => "Select a Country",
    			"USA" => "United States of America",
    			"CA" => "Canada",
    			"AF" => "Afghanistan",
    			"AX" => "Aland Islands",
    			"AL" => "Albania",
    			"DZ" => "Algeria",
    			"AS" => "American Samoa",
    			"AD" => "Andorra",
    			"AO" => "Angola",
    			"AI" => "Anguilla",
    			"AQ" => "Antarctica",
    			"AG" => "Antigua and Barbuda",
    			"AR" => "Argentina",
    			"AM" => "Armenia",
    			"AW" => "Aruba",
    			"AU" => "Australia",
    			"AT" => "Austria",
    			"AZ" => "Azerbaijan",
    			"BS" => "Bahamas",
    			"BH" => "Bahrain",
    			"BD" => "Bangladesh",
    			"BB" => "Barbados",
    			"BY" => "Belarus",
    			"BE" => "Belgium",
    			"BZ" => "Belize",
    			"BJ" => "Benin",
    			"BM" => "Bermuda",
    			"BT" => "Bhutan",
    			"BO" => "Bolivia",
    			"BA" => "Bosnia and Herzegovina",
    			"BW" => "Botswana",
    			"BV" => "Bouvet Island",
    			"BR" => "Brazil",
    			"IO" => "British Indian Ocean Territory",
    			"BN" => "Brunei Darussalam",
    			"BG" => "Bulgaria",
    			"BF" => "Burkina Faso",
    			"BI" => "Burundi",
    			"KH" => "Cambodia",
    			"CM" => "Cameroon",
    			"CV" => "Cape Verde",
    			"KY" => "Cayman Islands",
    			"CF" => "Central African Republic",
    			"TD" => "Chad",
    			"CL" => "Chile",
    			"CN" => "China",
    			"CX" => "Christmas Island",
    			"CC" => "Cocos (Keeling) Islands",
    			"CO" => "Colombia",
    			"KM" => "Comoros",
    			"CG" => "Congo",
    			"CD" => "Congo, The Democratic Republic of The",
    			"CK" => "Cook Islands",
    			"CR" => "Costa Rica",
    			"CI" => "Cote D'ivoire",
    			"HR" => "Croatia",
    			"CU" => "Cuba",
    			"CY" => "Cyprus",
    			"CZ" => "Czech Republic",
    			"DK" => "Denmark",
    			"DJ" => "Djibouti",
    			"DM" => "Dominica",
    			"DO" => "Dominican Republic",
    			"EC" => "Ecuador",
    			"EG" => "Egypt",
    			"SV" => "El Salvador",
    			"GQ" => "Equatorial Guinea",
    			"ER" => "Eritrea",
    			"EE" => "Estonia",
    			"ET" => "Ethiopia",
    			"FK" => "Falkland Islands (Malvinas)",
    			"FO" => "Faroe Islands",
    			"FJ" => "Fiji",
    			"FI" => "Finland",
    			"FR" => "France",
    			"GF" => "French Guiana",
    			"PF" => "French Polynesia",
    			"TF" => "French Southern Territories",
    			"GA" => "Gabon",
    			"GM" => "Gambia",
    			"GE" => "Georgia",
    			"DE" => "Germany",
    			"GH" => "Ghana",
    			"GI" => "Gibraltar",
    			"GR" => "Greece",
    			"GL" => "Greenland",
    			"GD" => "Grenada",
    			"GP" => "Guadeloupe",
    			"GU" => "Guam",
    			"GT" => "Guatemala",
    			"GG" => "Guernsey",
    			"GN" => "Guinea",
    			"GW" => "Guinea-bissau",
    			"GY" => "Guyana",
    			"HT" => "Haiti",
    			"HM" => "Heard Island and Mcdonald Islands",
    			"VA" => "Holy See (Vatican City State)",
    			"HN" => "Honduras",
    			"HK" => "Hong Kong",
    			"HU" => "Hungary",
    			"IS" => "Iceland",
    			"IN" => "India",
    			"ID" => "Indonesia",
    			"IR" => "Iran, Islamic Republic of",
    			"IQ" => "Iraq",
    			"IE" => "Ireland",
    			"IM" => "Isle of Man",
    			"IL" => "Israel",
    			"IT" => "Italy",
    			"JM" => "Jamaica",
    			"JP" => "Japan",
    			"JE" => "Jersey",
    			"JO" => "Jordan",
    			"KZ" => "Kazakhstan",
    			"KE" => "Kenya",
    			"KI" => "Kiribati",
    			"KP" => "Korea, Democratic People's Republic of",
    			"KR" => "Korea, Republic of",
    			"KW" => "Kuwait",
    			"KG" => "Kyrgyzstan",
    			"LA" => "Lao People's Democratic Republic",
    			"LV" => "Latvia",
    			"LB" => "Lebanon",
    			"LS" => "Lesotho",
    			"LR" => "Liberia",
    			"LY" => "Libyan Arab Jamahiriya",
    			"LI" => "Liechtenstein",
    			"LT" => "Lithuania",
    			"LU" => "Luxembourg",
    			"MO" => "Macao",
    			"MK" => "Macedonia, The Former Yugoslav Republic of",
    			"MG" => "Madagascar",
    			"MW" => "Malawi",
    			"MY" => "Malaysia",
    			"MV" => "Maldives",
    			"ML" => "Mali",
    			"MT" => "Malta",
    			"MH" => "Marshall Islands",
    			"MQ" => "Martinique",
    			"MR" => "Mauritania",
    			"MU" => "Mauritius",
    			"YT" => "Mayotte",
    			"MX" => "Mexico",
    			"FM" => "Micronesia, Federated States of",
    			"MD" => "Moldova, Republic of",
    			"MC" => "Monaco",
    			"MN" => "Mongolia",
    			"ME" => "Montenegro",
    			"MS" => "Montserrat",
    			"MA" => "Morocco",
    			"MZ" => "Mozambique",
    			"MM" => "Myanmar",
    			"NA" => "Namibia",
    			"NR" => "Nauru",
    			"NP" => "Nepal",
    			"NL" => "Netherlands",
    			"AN" => "Netherlands Antilles",
    			"NC" => "New Caledonia",
    			"NZ" => "New Zealand",
    			"NI" => "Nicaragua",
    			"NE" => "Niger",
    			"NG" => "Nigeria",
    			"NU" => "Niue",
    			"NF" => "Norfolk Island",
    			"MP" => "Northern Mariana Islands",
    			"NO" => "Norway",
    			"OM" => "Oman",
    			"PK" => "Pakistan",
    			"PW" => "Palau",
    			"PS" => "Palestinian Territory, Occupied",
    			"PA" => "Panama",
    			"PG" => "Papua New Guinea",
    			"PY" => "Paraguay",
    			"PE" => "Peru",
    			"PH" => "Philippines",
    			"PN" => "Pitcairn",
    			"PL" => "Poland",
    			"PT" => "Portugal",
    			"PR" => "Puerto Rico",
    			"QA" => "Qatar",
    			"RE" => "Reunion",
    			"RO" => "Romania",
    			"RU" => "Russian Federation",
    			"RW" => "Rwanda",
    			"SH" => "Saint Helena",
    			"KN" => "Saint Kitts and Nevis",
    			"LC" => "Saint Lucia",
    			"PM" => "Saint Pierre and Miquelon",
    			"VC" => "Saint Vincent and The Grenadines",
    			"WS" => "Samoa",
    			"SM" => "San Marino",
    			"ST" => "Sao Tome and Principe",
    			"SA" => "Saudi Arabia",
    			"SN" => "Senegal",
    			"RS" => "Serbia",
    			"SC" => "Seychelles",
    			"SL" => "Sierra Leone",
    			"SG" => "Singapore",
    			"SK" => "Slovakia",
    			"SI" => "Slovenia",
    			"SB" => "Solomon Islands",
    			"SO" => "Somalia",
    			"ZA" => "South Africa",
    			"GS" => "South Georgia and The South Sandwich Islands",
    			"ES" => "Spain",
    			"LK" => "Sri Lanka",
    			"SD" => "Sudan",
    			"SR" => "Suriname",
    			"SJ" => "Svalbard and Jan Mayen",
    			"SZ" => "Swaziland",
    			"SE" => "Sweden",
    			"CH" => "Switzerland",
    			"SY" => "Syrian Arab Republic",
    			"TW" => "Taiwan, Province of China",
    			"TJ" => "Tajikistan",
    			"TZ" => "Tanzania, United Republic of",
    			"TH" => "Thailand",
    			"TL" => "Timor-leste",
    			"TG" => "Togo",
    			"TK" => "Tokelau",
    			"TO" => "Tonga",
    			"TT" => "Trinidad and Tobago",
    			"TN" => "Tunisia",
    			"TR" => "Turkey",
    			"TM" => "Turkmenistan",
    			"TC" => "Turks and Caicos Islands",
    			"TV" => "Tuvalu",
    			"UG" => "Uganda",
    			"UA" => "Ukraine",
    			"AE" => "United Arab Emirates",
    			"GB" => "United Kingdom",
    			"UM" => "United States Minor Outlying Islands",
    			"UY" => "Uruguay",
    			"UZ" => "Uzbekistan",
    			"VU" => "Vanuatu",
    			"VE" => "Venezuela",
    			"VN" => "Viet Nam",
    			"VG" => "Virgin Islands, British",
    			"VI" => "Virgin Islands, U.S.",
    			"WF" => "Wallis and Futuna",
    			"EH" => "Western Sahara",
    			"YE" => "Yemen",
    			"ZM" => "Zambia",
    			"ZW" => "Zimbabwe");
    	
    	 return $countries;
    }
}
