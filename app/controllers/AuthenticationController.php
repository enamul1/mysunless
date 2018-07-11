<?php

class AuthenticationController extends BaseController {

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        //echo \Session::get('message');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::check()) {
            if (UserRole::isAdminUser() ) {
                return Redirect::route('/profile');
            }

            if (UserRole::isCustomer() ) {
                return Redirect::route('/dashboard');
            }

        } else {
            Auth::logout();
            return View::make('common/login',
                array(
                    'notificationMessage' => \Session::get('notificationMessage'),
                    'notificationType'    => \Session::get('notificationType')
                ));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = \Input::all();

        $validator = Validator::make(Input::all(), [
            "email" => "required",
            "password" => "required"
        ]);


        if ($validator->passes()) {
            $credentials = [
                "email" => Input::get("email"),
                "password" => Input::get("password")
            ];
            $rememberMe = Input::get('remember_me');
            if (isset($rememberMe)) {
                $isRememberMe = true;
            } else {
                $isRememberMe = false;
            }
            if (Auth::attempt($credentials, $isRememberMe)) {
                //return Redirect::intended("users");
                if (UserRole::isAdminUser() ) {
                    return Redirect::intended('/profile');
                }

                if (UserRole::isCustomer() ) {
                    return Redirect::intended('/dashboard');
                }
            } else {
                return Redirect::to('login')->withErrors('Wrong Credential!')->withInput();
            }
        } else {
            return Redirect::to('login')->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        Auth::logout();
        return Redirect::to('/login');
    }

}
