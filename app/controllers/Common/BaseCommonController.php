<?php

namespace App\Controllers\Common;

class BaseCommonController extends \BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * show error page if user has no permission
     *
     * @param string $resource
     * @return Boolean
     * @throw Exception
     */
    public function requirePermission($resource)
    {
        if (UserRole::hasPermission($resource)) {
            return true;
        } else {
            $this->returnError('You don\'t have permission');
        }
    }

    /**
     * return a error
     *
     * @param $message
     */
    public function returnError($message)
    {
        throw new Exception($message);
    }

    /**
     * Send mail
     *
     * @param string $to
     * @param string $name
     * @param string $subject
     * @param string $templatePath
     * @param array $arrayToPassToTemplate
     * @param array $options
     */
    public function sendEmail($to, $name, $subject, $templatePath, array $arrayToPassToTemplate = array(), array $options = array())
    {
        BaseModel::sendEmail($to, $name, $subject, $templatePath, $arrayToPassToTemplate, $options);
    }

}
