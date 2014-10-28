<?php

class AccountController extends BaseController {
	
	public function getSignIn(){
		return View::make('account.signin');
	}

	public function postSignIn(){

        $validator = Validator::make(
            array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            ),
            array(
                'email' => 'required|email',
                'password' => 'required'
            )
        );
        if($validator->fails()){
            return Response::json([
                'success'=>false,
                'error'=>$validator->errors()->toArray()
            ]);
        }
        $remember = (Input::has('remember')) ? true : false;

        $auth = Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'active' => 1
        ), $remember);

        if($auth){
            //return Redirect::route('account-sign-in');
            return Response::json(['success'=>true]);
        }else{
            return Response::json([
                'success'=>false,
                'error'=> array('error' => 'Email/password wrong or your account is still not activated.'),
                'redirect'=> Redirect::intended('/')
            ]);

        }
    }
		/*
		 * $validator = Validator::make(Input::all(),
			array(
				'email' => 'required|email',
				'password' => 'required'
			)			
		);
		if($validator->fails()){
			return Redirect::route('account-sign-in')
				->withErrors($validator)
				->withInput();
		}else{
			
			$remember = (Input::has('remember')) ? true : false;
			
			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			), $remember);
			
			if($auth){
				return Redirect::intended('/');
			}else{
				return Redirect::route('account-sign-in')
					->with('global', 'Email/password wrong or your account is still not activated.');
	
			}
		}
		
		return Redirect::route('account-sign-in')
			->with('global', 'There was a problem with signing you in.');
		
	}
	*/
	public function getSignOut(){
		Auth::logout();
		return Redirect::route('home');
	}

	public function getProfile(){		
		return View::make('account.profile');
	}

	public function getEditProfile(){		
		return View::make('account.editprofile');
	}
	
	public function getCreate() {
		return View::make('account.create');
	}
	
	public function postCreate() {
		/*$validator = Validator::make(Input::all(),
			array(
				'email'			=> 'required|max:50|email|unique:users',
				'username' 		=> 'required|max:20|min:3|unique:users',
				'password' 		=> 'required|min:6',
				'password_' 	=> 'required|same:password'
			)
		);
        */
        $validator = Validator::make(
            array(
                'email' => Input::get('email2'),
                'username' => Input::get('username'),
                'password' => Input::get('password2'),
                'password_again' => Input::get('password2_')
            ),
            array(
                'email' => 'required|min:4|max:50|email|unique:users',
                'username' => 'required|max:20|min:3|unique:users',
                'password' => 'required|min:6',
                'password_again' => 'required|same:password'
            )
        );

        if($validator->fails()){
            return Response::json([
                'success'=>false,
                'error'=>$validator->errors()->toArray()
            ]);
        }else{
		/*
		if($validator->fails()){
			return Redirect::route('account-create')
					->withErrors($validator)
					->withInput();
		*/

			$email 		= Input::get('email2');
			$username 	= Input::get('username');
			$password 	= Input::get('password2');
			
			$code 		= str_random(60);
			
			$user 	= User::create(array(
				'email' => $email,
				'username' => $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0
			));
			
			if($user) {
				
				Mail::send('emails.auth.authentication', array(
					'link' => URL::route('account-activate', $code),
					'username' => $username),
					function($message) use ($user) {
						$message->to($user->email, $user->username)->subject('Activate your account');
					}
			
				
				);

                return Response::json(['success'=>true]);
				//return Redirect::route('home')
				//	->with('global', 'Your account has been created! We have sent you an email to activate your account.');
			}
			
			
		}
		
	}
	
	public function getActivate($code){
		$user = User::where('code', '=', $code)->where('active','=',0);
		if($user->count()){
			$user = $user->first();
			
			$user->active	= 1;
			$user->code		= '';
			
			if($user->save()){
				return Redirect::route('home')
					->with('global', 'Activated! You can now sign in!');
			}
		}
		
		return Redirect::route('home')
			->with('global', 'We could not activate your account. You might have an invalid activation link. Try again later.');
	}
	
	public function getChangePassword(){
		return View::make('account.password');
	}
	
	public function postChangePassword(){
		$validator = Validator::make(Input::all(), 
			array(
				'old_password'	 	=> 'required',
				'password' 			=> 'required|min:6',
				'password_again' 	=> 'required|same:password'
			)
		);
		
		if($validator->fails()){
			return Redirect::route('account-change-password')
				->withErrors($validator);
		}else{
			
			$user 			= User::find(Auth::user()->id);
			
			$old_password 	= Input::get('old_password');
			$password 		= Input::get('password');
			
			if(Hash::check($old_password, $user->getAuthPassword())){
				$user->password = Hash::make($password);
				
				if($user->save()){
					return Redirect::route('home')
						->with('global', 'Your password has been changed.');
				}
			}else{
				return Redirect::route('account-change-password')
			->with('global', 'Your old password is incorrect.');
			}
			
		}
		
		return Redirect::route('account-change-password')
			->with('global', 'Your password could not be changed.');
	}
	
	public function getForgotPassword(){
		return View::make('account.forgot');
	}
	
	public function postForgotPassword(){
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|email'
			)
		);
		
		if($validator->fails()){
			return Redirect::route('account-forgot-password')
				->withErrors($validator)
				->withInput();
		}else{
			
			$user = User::where('email', '=', Input::get('email'));
			
			if($user->count()){
				$user 					= $user->first();
				
				$code 					= str_random(60);
				$password 				= str_random(10);
				
				$user->code				= $code;
				$user->password_temp	= Hash::make($password);
				
				if($user->save()){
					
					Mail::send('emails.auth.recover', array(
						'link' => URL::route('account-recover', $code),
						'username' => $user->username,
						'password' => $password
					),
					function($message) use ($user){
						$message->to($user->email, $user->username)->subject('Your new password');	
					});
					
					return Redirect::route('home')
						->with('global', 'We have sent you a new password by email.');
					
				}
			}
			
		}
		
		return Redirect::route('account-forgot-password')
			->with('global', 'Could not request new password.');
	}

	
	
	public function getRecover($code){
		$user = User::where('code', '=', $code)
			->where('password_temp', '!=', '');
			
		if($user->count()){
			$user = $user->first();
			
			$user->password 		= $user->password_temp;
			$user->password_temp 	= '';
			$user->code 			= '';
			
			if($user->save()){
				return Redirect::route('home')
					->with('global', 'Your account has been recovered and you can sign in with your new password');
			}
			
		}
		
		return Redirect::route('home')
			->with('global', 'Could not recover your account.');
		
	}


	/////////////////////////////////////////******************************///////////////////////////////////////////////
	//////////////////***************************///////////////////***************************///////////////////////////
	///////***********************///////////////////**********///////////*******************************************////
	////*******************************************************************************************************//////////
	////TUTAJ JEST EDDYCJA PROFILU BIT**S??????????????????????????????????????/////////////////////////////////////

	public function postEdit(){
		if(Input::file('photo')!=""){
		$extension = Input::file('photo')->getClientOriginalExtension();

        if($extension == 'jpg' OR $extension == 'png'){

            $filename = "1";
            $destinationPath = 'media/profilePhoto/';
            Input::file('photo')->move($destinationPath, $filename);
        }}

		$validator = Validator::make(
            array(
                'email' => Input::get('email'),
                'old_password' => Input::get('old_password'),
                'password' 	=> Input::get('password'),
				'password_again' => Input::get('password_again'),
                'about' => Input::get('about'),
                'from' => Input::get('from'),
            ),
            array(
                'old_password'	 	=> 'required',
                'password' 			=> 'min:6',
				'password_again' 	=> 'same:password',
				'email'				=> 'required|email',
				'about' 			=> 'min:5',
				'from' 				=> 'min:5'
            )
        );
		
		if($validator->fails()){
			return Redirect::route('home')
				->withErrors($validator);
		}else{
			$index = 1;
			$user = User::find($index);
			$user->about = Input::get('about');	
			$user->email = Input::get('email');
			$user->photo = $index;
			$user->fromc = Input::get('from');
			$user->save();	
			if($user->save()){
				return Redirect::route('home')
					->with('global', 'Your account has been chaned');
					}	
		}
		
	}

}