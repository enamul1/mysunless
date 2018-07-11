<?php

class BaseController extends Controller {

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));

        //@todo will be removed by creating a helper
        $className = substr(get_called_class(), strlen('App\Controllers'));
        $nameSpace = explode('.',  str_replace(array('Controller', '\\'), array('', '.'), $className));
        $module = $nameSpace[1];
        $controller = $nameSpace[2];
        $action = substr(strstr(\Route::currentRouteAction(), '@'), 1);
        $pos = strrpos($action, "@");
        if ($pos !== false) {
            $action = substr(strstr($action, '@'), 1);
        }

        \View::share(array('module' => $module, 'controller' => $controller, 'action' => $action));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
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
    	if(!Auth::check()) {
    		Redirect::route("/login");
    	} else {
            throw new Exception($message, 403);
        }
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
