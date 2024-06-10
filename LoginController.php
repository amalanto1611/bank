<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userreg;
use App\Models\History;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Import Log facade

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function dashboard($email, $name, $id, $balance)

    {
        //dd($id);
        dd($id);
        return view('dasboard', compact('email', 'name', 'id', 'balance'));
    }
    public function signup()
    {
        return view('Registration');
    }
    public function regsubmit(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' =>'required|email|unique:user,email',
                'password' => 'required|string|min:6',
            ]);
    
            // Create a new instance of the UserReg model
            $user = new Userreg();
              //dd($user);
            // Assign validated data to the model attributes
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']); // Hash the password for security
    
            // Save the user to the database
            $user->save();
    
            // If all goes well, return a success message
            return redirect()->route('signup')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            // If an error occurs during the process, catch it and return an error message
            return redirect()->route('signup')->with('error', 'Failed to register user: ' . $e->getMessage());
        }
}
public function check(Request $request)
    {
        //dd($request);
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            //dd($password);
            $user = Userreg::where('email', $email)->first();
              //dd($user);
            if ($user) {
                if (Hash::check($password, $user->password)) {
                    // Password matches, authentication successful
                    // Redirect to dashboard
                    


                    return redirect()->route('dash', ['email' => $email,'name' => $user->name, 'id' => $user->id, 'balance' => $user->balance]);
                } else {
                    // Password does not match
                    return redirect()->back()->with('error', 'Invalid email or password.');
                }
            } else {
                // User not found
                return redirect()->back()->with('error', 'Invalid email or password.');
            }
        } catch (\Exception $e) {
            // An error occurred
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function deposit(Request $request)
    {
        //dd($request);
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'amount' => 'required|integer',
                
            ]);
    
            // Create a new instance of the UserReg model
            
              //dd($user);
            // Assign validated data to the model attributes
            $email=$request->email;
            $amount=$validatedData['amount'];
            //dd($amount);
            $user = Userreg::where('email', $email)->firstOrFail();
           
           // dd($amounthistory);
            $userhistory = new History();
            //dd($userhistory);
            // Update only the balance column
            $user->balance+=$amount;
            $userhistory->amount=$amount;
            $userhistory->type="credit";
            $userhistory->details="deposit";
            $userhistory->email=$email;
          
            $user->save();
            $amounthistory = Userreg::where('email', $email)->value('balance');
            $userhistory->balance=$amounthistory;
            $userhistory->save();
    
            // Save the user to the database
          
              
            // If all goes well, return a success message
            return redirect()->route('dash', ['email' => $email,'name' => $user->name, 'id' => $user->id, 'balance' => $user->balance]);
        } catch (\Exception $e) {
            // If an error occurs during the process, catch it and return an error message
            //return redirect()->route('signup')->with('error', 'Failed to deposit: ' . $e->getMessage());
           //return redirect()->back()->with('error', 'Invalid email or password.');
           $errorMessage = 'Failed to update balance: ' . $e->getMessage();

    // You can also add additional error handling here if needed

    // Store the error message in session flash data
    session()->flash('error', $errorMessage);

    // Redirect back to the same page
    return redirect()->back();
        }

    }
    public function withdraw(Request $request)
    {
        //dd($request);
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'amount' => 'required|integer|regex:/^[0-9]+$/',
                
            ]);
    
            // Create a new instance of the UserReg model
            
              //dd($user);
            // Assign validated data to the model attributes
            
            $email=$request->email;
            
            $amount=$validatedData['amount'];
            
                        $user = Userreg::where('email', $email)->firstOrFail();
                        $userhistory = new History();
                        //dd($userhistory);
                        // Update only the balance column
                        $user->balance-=$amount;
                        $userhistory->amount=$amount;
                        $userhistory->type="debit";
                        $userhistory->details="withdrowal";
                        $userhistory->email=$email;
            // Update only the balance column
            //$user->balance-=$amount;
            
            $user->save();
            $amounthistory = Userreg::where('email', $email)->value('balance');
            $userhistory->balance=$amounthistory;
            $userhistory->save();
            // Save the user to the database
          
            //dd($user);
            // If all goes well, return a success message
            return redirect()->route('dash', ['email' => $email,'name' => $user->name, 'id' => $user->id, 'balance' => $user->balance]);
        } catch (\Exception $e) {
         // If an error occurs during the process, catch it and store the error message in the session flash data
    $errorMessage = 'Failed to update balance: ' . $e->getMessage();

    // You can also add additional error handling here if needed

    // Store the error message in session flash data
    session()->flash('error', $errorMessage);

    // Redirect back to the same page
    return redirect()->back();
        }

    }
    public function transfar(Request $request)
    {
       //dd($request);
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'amount' => 'required|integer|regex:/^[0-9]+$/',
                'emailtr'  => 'required'
                
            ]);
    
            // Create a new instance of the UserReg model
            
              //dd($user);
            // Assign validated data to the model attributes
            
            $emailtr=$validatedData['emailtr'];;
            //dd($emailtr);
            $email=$request->email;
            $name=$request->name;
            //dd($name);
            $id=$request->id;
            $balance=$request->balance;
            $amount=$validatedData['amount'];
            
                        $user = Userreg::where('email', $emailtr)->firstOrFail();
                        $user1 = Userreg::where('email', $email)->firstOrFail();
                         
            // Update only the balance column
            //dd($user);
            $user->balance+=$amount;
            $user1->balance-=$amount;
            $balance1=$user1->balance;
            $user1->save();
            $user->save();
             
            $userhistory = new History();
            $userhistory->amount=$amount;
            $userhistory->type="debit";
            $userhistory->details="transfar to   "."    ".$emailtr;
            $userhistory->email=$email;


            $userhistorytr = new History();
            
            $userhistorytr->amount=$amount;
            $userhistorytr->type="credit";
            $userhistorytr->details="transfar from  ".$email;
            $userhistorytr->email=$emailtr;
            // Save the user to the database
          
            $amounthistory = Userreg::where('email', $email)->value('balance');
            $userhistory->balance=$amounthistory;
            $userhistory->save();

            $amounthistorytr = Userreg::where('email', $emailtr)->value('balance');
            $userhistorytr->balance=$amounthistorytr;
            $userhistorytr->save();

            //dd($user);
            // If all goes well, return a success message
            return redirect()->route('dash', ['email' => $email,'name' => $name, 'id' => $id, 'balance' =>$balance1]);
        } catch (\Exception $e) {
         // If an error occurs during the process, catch it and store the error message in the session flash data
    $errorMessage = 'Failed to update balance: ' . $e->getMessage();

    // You can also add additional error handling here if needed

    // Store the error message in session flash data
    session()->flash('error', $errorMessage);

    // Redirect back to the same page
    return redirect()->back();
        }

    }
    public function statement(Request $request)
    {
       //dd($request);
        $email = $request->input('email');
         $userData= History::where('email', $email)->get();// Adjust this query as needed
        //dd($userData);
        // Pass the fetched data to the Blade view
         return view('statement', ['userData' => $userData]);
       
    }
}