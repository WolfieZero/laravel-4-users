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


    public function postEdit() {

        // Gets the current user object
        $user = User::find(Auth::user()->id);
        //dd($user->firstname, $user);

        $user->firstname = Input::get('firstname');
        $user->lastname  = Input::get('lastname');
        $user->email     = Input::get('email');
        $user->password  = Hash::make(Input::get('password'));
        $user->location  = Input::get('location');

        $user->save();

            //set the name of the file
            //$filename = Input::file('image.name');

            //Upload the file
            //Input::upload('image', 'public/uploads', $filename);


            // Save the variable data back into the DB
            //$user->save();

            // Returns the login page
/*            return Redirect::to('users/login')
                ->with('message', 'Thanks for registering!')
                ->with('message-type', 'success');*/

        return Redirect::to('users/edit')
            ->with('message', 'Your details have been updated')
            ->with('message-type', 'success');


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
            Input::all(),        // Grabs user submitted form data
            User::$rules['new']  // Grabs validation rules from the `User` model
        );

        // Call `passes()` object to see if `Input::all()` validatates against
        // `User::$rules` to then return a boolean value
        if ($validator->passes()) {

            // validation has passed, save user in DB

            // Using `create()` we can directly save our variables into the DB
            // so long as they are in the protected property `User::$fillable`
            $user = User::create([
                'firstname' => Input::get('firstname'),
                'lastname'  => Input::get('lastname'),
                'email'     => Input::get('email'),
                'password'  => Hash::make(Input::get('password'))
            ]);

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


    public function postLogin() {

        if( Auth::attempt([
            'email'    => Input::get('email'),
            'password' => Input::get('password')
        ]) ) {

            return Redirect::intended('users/dashboard')
                ->with('message', 'You are now logged in!')
                ->with('message-type', 'success');

        } else {

            return Redirect::to('login')
                ->with('message', 'Your username/password combination was incorrect')
                ->with('message-type', 'danger')
                ->withInput();

        }

    }


    /**
     * Gives the delete view
     *
     * @return  View
     */
    public function getDelete() {

        $this->layout->content = View::make('users.delete');

    }


    public function postDelete() {

        $user = User::find(Auth::user()->id);
        $user->delete();

        return Redirect::to('login')
            ->with('message', 'User, ' . $user->firstname . ' has been deleted. Bye bye!')
            ->with('message-type', 'success');

    }


    public function getDashboard() {

        $this->layout->content = View::make('users.dashboard');

    }


}