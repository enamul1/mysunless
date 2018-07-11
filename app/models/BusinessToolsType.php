<?php
class BusinessToolsType extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_tools_types';

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
    public static function getBusinessToolsTypeById($id)
    {
        $businessToolType = self::find($id);
        if ($businessToolType instanceof self) {
            return $businessToolType->name;
        }
    }

    public static function getAllBusinessToolsTypes()
    {
        $businessToolsTypes = self::all();
        return $businessToolsTypes;
    }
    
}
