<?php

namespace App\Http\Controllers\Frontend;

use Dotenv\Validator;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Events\TripBookEvent;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Actions\Trip\TripBookStore;
use App\Http\Controllers\Controller;
use App\Mail\CustomerForgetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerSignupRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\CustomerprofileRequest;
use App\Http\Requests\CustomerUpdatePasswordRequest;

class LoginController extends Controller
{
    protected $customer=null;
    public function __construct(Customer $customer)
    {
        $this->customer=$customer;
    }
    public function signUpForm(Request $request)
    {
        return view('frontend.signup');
    }

    public function signup(CustomerSignupRequest $request)
    {
        
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['password']=bcrypt($request->password);
            if($request->image)
            {
                $data['image']=uploadImage($request->image,'customer','300x300');

            }
            else
            {
                $data['image']=null;
            }
            $this->customer->fill($data);
            $this->customer->save();
            DB::commit();
            Toastr::success('Registration Success !!', 'Success !!!');
            return redirect()->route('customer.login');
        }catch(\Throwable $th)
        {
            DB::rollback();
            Toastr::warning('Email Or Password Doesnot Match !!', 'Error !!!');
            return redirect()->back();
        }
    }

    public function login()
    {
        
        return view('frontend.login');
    }

    public function loginData(CustomerLoginRequest $request)
    {
        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            return redirect()->intended(route('customer.dashboard'));
        }
        else
        {
            Toastr::warning('Email Or Password Doesnot Match !!', 'Error !!!');
            return redirect()->back();
        }
    }

    public function forgetPasswordForm()
    {
        return view('frontend.forgetpasswordCustomer');
    }

   

    public function forgetPasswordSend(ForgetPasswordRequest $request)
    {
        $customer=Customer::whereEmail($request->email)->first();
        if(!$customer)
        {
            Toastr::warning('Invalid Email.', 'Error !!!');
            return redirect()->back();
        }
        Mail::to($request->email)->send(new CustomerForgetPassword($request->email));
        Toastr::success('Reset Link Has Been Sent To Your Mail.', 'Success !!!');
        return redirect()->back();
    }

    public function resetLinkPassword(Request $request,$email)
    {
        $customer=Customer::whereEmail($email)->first();
        if(!$customer)
        {
            Toastr::warning('Something Went Wrong.', 'Error !!!');
        }
        return view('frontend.forgetpasswordCustomerlink')->with('email',$email);
    }

    public function updatePassword(CustomerUpdatePasswordRequest $request)
    {
        $customer=Customer::whereEmail($request->email)->first();
        if(!$customer)
        {
            Toastr::warning('Something Went Wrong.', 'Error !!!');
        }

        DB::beginTransaction();
        try{
            $customer->password=bcrypt($request->password);
            $status=$customer->save();
            if($status)
            {
                DB::commit();
                if(auth()->guard('customer')->user())
                {
                    Auth::guard('customer')->logout();
                }
                Toastr::success('password Updated Successfully !!.', 'Success !!!');
                return redirect()->route('customer.login');
            }
            else
            {
                Toastr::warning('Something Went Wrong.', 'Error !!!');
                return redirect()->route('customer.forgetPassword');
            }
        }catch(\Throwable $th)
        {
            DB::rollBack();
            Toastr::warning('Something Went Wrong.', 'Error !!!');
            return redirect()->route('customer.forgetPassword');
        }
    }

    public function customerDashboard()
    {
        $customer=auth()->guard('customer')->user();
        $customerTrip=$customer->getTrip;
        return view('frontend.dashboardcus',compact('customerTrip'));
    }

    public function customerProfile()
    {
        $customer=auth()->guard('customer')->user();
        if(!$customer)
        {
            Toastr::warning('Something Went Wrong.', 'Error !!!');
        }

        return view('frontend.customerprofile',compact('customer'));
    }

    public function customerProfileUpdate(CustomerprofileRequest $request)
    {
       
        $customer=auth()->guard('customer')->user();
        if(!$customer)
        {
            Toastr::warning('Something Went Wrong.', 'Error !!!');
        }
        $data=$request->all();
        DB::beginTransaction();
        try{
            if($request->image)
            {
                $data['image']=uploadImage($request->image,'customer','300x300');
            }

            $customer->fill($data);
            $customer->save();
            DB::commit();
            Toastr::success('Upadetd Success !!', 'Success !!!');
            return redirect()->route('customer.dashboard');
        }catch(\Throwable $th)
        {
            DB::rollback();
            Toastr::warning('Something Went Wrong !!', 'Error !!!');
            return redirect()->back();
        }

       
    }

    public function checkValidity(Request $request)
    {
        
        switch($request->validbookin)
        {
            case 0:
                DB::beginTransaction();
                try{
                    $dataValue=session()->get('bookData');
                    $data=(new TripBookStore())->guest($dataValue);
                    event(new TripBookEvent($data));
                    DB::commit();
                    session()->forget('bookData');
                    Toastr::success('Success', 'Thank You');
                    return redirect()->route('book',$dataValue['trip_id']);
                    }catch(\Throwable $th)
                    {
                        DB::rollBack();
                        Toastr::warning('Something Went Wrong', 'Error !! ');
                        return back();
                    }
                break;
            case 1:
                return view('frontend.booklogin');
                break;
            default:
            session()->forget('bookData');
            Toastr::warning('Something Went Wrong !!', 'Error !! ');
            return redirect()->route('index');
            break;

        }
    }

    public function bookLoginForm(CustomerLoginRequest $request)
    {
        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            return redirect()->intended(route('customer.bookloginData'));
        }
        else
        {
            Toastr::warning('Email Or Password Doesnot Match !!', 'Error !!!');
            return view('frontend.booklogin');
        }
    }

    public function bookWithLogin()
    {
        $customer=auth()->guard('customer')->user();
        if(!$customer)
        {
            Toastr::warning('Something Went Wrong.', 'Error !!!');
            return redirect()->route('index');
        }
        DB::beginTransaction();
        try{
            $dataValue=session()->get('bookData');
            $dataValue['customer_id']=$customer->id;
            $data=(new TripBookStore())->guest($dataValue);
            event(new TripBookEvent($data));
            DB::commit();
            session()->forget('bookData');
            Toastr::success('Success', 'Thank You');
            return redirect()->route('book',$dataValue['trip_id']);
            }catch(\Throwable $th)
            {
                DB::rollBack();
                Toastr::warning('Something Went Wrong', 'Error !! ');
                return redirect()->route('book',$dataValue['trip_id']);
            }
    }
}
