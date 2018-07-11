<?php
class Setting extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

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
    public static function validator(array $input)
    {
        $rules = array(
            'setting_type'=>'required',
            'name'=>'required',
            'value'=>'required'
        );

        return Validator::make($input, $rules);

    }

    /**
     * add a setting
     *
     * @param array $data
     */
    public static function add(array $data)
    {
        return self::create($data);
    }

    /**
     * get setting
     *
     * @param string $name
     * @return string
     */
    public static function getSetting($name)
    {
        $setting = self::where('name', $name)->first();
        if ($setting instanceof Setting) {
            return $setting->value;
        }
    }

    /**
     * Get site name
     *
     * @return string
     */
    public static function getSiteName()
    {
        return self::getSetting('SITE_NAME');
    }

    /**
     * Get site URL
     *
     * @return string
     */
    public static function getSiteUrl()
    {
        return self::getSetting('SITE_URL');
    }

    /**
     * Get email instruction text
     *
     * @return string
     */
    public static function getEmailInstructionText()
    {
        return self::getSetting('EMAIL_INSTRUCTION');
    }
    
	/*
	 * Get all settings
	 * 
	 * @return Setting
	 */
	public static function getAllSettings()
	{
		return self::all();
	}
    
	/**
	 * Get Back-end logo
	 *
	 * @return string
	 */
	public static function getBackEndLogo()
	{
		return self::getSetting('BACK_LOGO');
	}
    
	/**
     * Get Front-end logo
     *
     * @return string
     */
    public static function getFrontEndLogo()
    {
        return self::getSetting('FRONT_LOGO');
    }
    
    /** 
	 * Get Phone
	 *
	 * @return string
	 */
	public static function getPhone()
	{
		    return self::getSetting('PHONE');
	}
    
    /** 
	 * Get Email
	 *
	 * @return string
	 */
	public static function getEmail()
	{
        return self::getSetting('EMAIL');
    }
}
