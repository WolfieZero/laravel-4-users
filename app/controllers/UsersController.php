<?php

class UsersController extends \BaseController {


    protected $layout = "layouts.main";


    /**
     * Default method actions
     */
    public function __construct() {

        // Protect against CSRF attacks - http://j.mp/1lErYeg
        $this->beforeFilter('csrf', array('on'=>'post'));

        // Make sure the user is authorised to access the area
        $this->beforeFilter('auth', array('only'=>array('getDashboard','getEdit')));

    }


    /**
     * Gives the register view
     *
     * @return  View
     */
    public function getRegister() {

        $this->layout->content = View::make('users.register');

    }


    /**
     * Gives the login view
     *
     * @return  View
     */
    public function getLogin() {

        $this->layout->content = View::make('users.login');

    }



    public function getEdit() {

        $this->layout->content = View::make('users.edit');

    }


    /**
     * Lets the user logout
     *
     * @return  Redirect
     */
    public function getLogout() {

        Auth::logout();
        return Redirect::to('users/login')
            ->with('message', 'Your are now logged out!')
            ->with('message-type', 'info');

    }


    public function postCreate() {

        $validator = Validator::make(
            Input::all(),  // Grabs user submitted form data
            User::$rules   // Grabs validation rules from the `User` model
        );

        // Call `passes()` object to see if `Input::all()` validatates against
        // `User::$rules` to then return a boolean value
        if ($validator->passes()) {

            // validation has passed, save user in DB

            // Grab our `User` model and store it as `$user` to allow us to
            // assign and use variables and ojbects
            $user = new User;

            // Get the input values based on the field names and store then in
            // variables relating to the column names
            $user->firstname = Input::get('firstname');
            $user->lastname  = Input::get('lastname');
            $user->email     = Input::get('email');
            $user->password  = Hash::make(Input::get('password'));

            // Save the variable data back into the DB
            $user->save();

            // Returns the login page
            return Redirect::to('users/login')
                ->with('message', 'Thanks for registering!')
                ->with('message-type', 'success');

        } else {

            // validation has failed, display error messages

            return Redirect::to('users/register')
                ->with('message', 'The following errors occurred')
                ->with('message-type', 'warning')
                ->withErrors($validator)  // Lets us use the issues
                ->withInput();            // Passes originally inputted values

        }

    }


    public function postSignin() {

        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {

            return Redirect::to('users/dashboard')
                ->with('message', 'You are now logged in!')
                ->with('message-type', 'success');

        } else {

            return Redirect::to('users/login')
                ->with('message', 'Your username/password combination was incorrect')
                ->with('message-type', 'danger')
                ->withInput();

        }

    }


    public function getDashboard() {

        $this->layout->content = View::make('users.dashboard');

    }


}