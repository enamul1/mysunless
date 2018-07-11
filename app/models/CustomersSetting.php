<?php
class CustomersSetting extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers_settings';

    /**
     * Soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

    public static $unguarded = true;

    /**
     * add a customer setting
     *
     * @param array $data
     * @return Faq
     */
    public static function add(array $data)
    {
        $customerId = Auth::getUser()->ID;
        $settings['reminder_15'] = isset($data['reminder_15']) ? 1 : 0;
        $settings['reminder_30'] = isset($data['reminder_30']) ? 1 : 0;
        $settings['reminder_45'] = isset($data['reminder_45']) ? 1 : 0;

        $customersSetting =  self::getCustomersSettingByCustomerId($customerId);
        if ($customersSetting instanceof self) {
            $data = array_merge($settings, $data);
            return $customersSetting->update($data);
        }


        $settings['customer_id'] = $customerId;
        $settings['email_instructions'] = $data['email_instructions'];
        $settings['default_cost'] = $data['default_cost'];
        return self::create($settings);

    }

    /**
     * get CustomersSetting by customer_id
     *
     * @param $customer_id
     * @return CustomersSetting
     */
    public static function getCustomersSettingByCustomerId($customer_id)
    {
        $customersSetting = self::where('customer_id', $customer_id)->first();
        return $customersSetting;
    }

    /**
     * Get email instruction text
     *
     * @return string
     */
    public static function getEmailInstructionsText()
    {
        $customerId = Auth::getUser()->ID;
        $customersSetting =  self::getCustomersSettingByCustomerId($customerId);

        if ($customersSetting instanceof self) {
            return $customersSetting->email_instructions;
        }

        return Setting::getEmailInstructionText();
    }

    /**
     * Get email instruction text
     *
     * @return string
     */
    public static function getDefaultCost()
    {
        $customerId = Auth::getUser()->ID;
        $customersSetting =  self::getCustomersSettingByCustomerId($customerId);

        if ($customersSetting instanceof self) {
            return $customersSetting->default_cost;
        }

        return '';
    }
}
