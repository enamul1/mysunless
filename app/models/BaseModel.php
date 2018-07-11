<?php

class BaseModel extends Eloquent {

    /**
     * Send mail
     *
     * @param string $to
     * @param string $name
     * @param string $subject
     * @param string $templatePath
     * @param array $arrayToPassToTheTemplate
     * @param array $options
     * @return void
     */
    public static function sendEmail($to, $name, $subject, $templatePath, array $arrayToPassToTheTemplate = array(), array $options = array())
    {
        $delay = 50;
        if (isset($options['delay'])) {
            $delay = $options['delay'];
        }
        \Mail::later($delay, $templatePath, $arrayToPassToTheTemplate, function($message) use ($to, $name, $subject){

            $message->to($to, $name)->subject($subject);
        });
    }
}
