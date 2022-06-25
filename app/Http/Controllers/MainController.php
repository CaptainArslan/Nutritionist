<?php

namespace App\Http\Controllers;

use App\Models\MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function addproduct()
    {
        $obj = new MainModel();
        $data = ['product' => $obj->get_db_data('products')];
        // dd($data);
        return view('addproduct', $data);
    }
    public function add_product(Request $request)
    {
        // SAVE PRODUCTS
        if (isset($request->submit) && $request->submit == 'Save') {
            $request->validate([
                'name' => 'required',
                'ntcom' => 'required',
                'serving' => 'required',
                'servingunit' => 'required',
                'calories' => 'required',
                'proteins' => 'required',
                'carbs' => 'required',
                'fats' => 'required',
                'status' => 'required',
                'comment' => 'nullable',
            ]);
            $obj = new MainModel();
            $data = $obj->get_db_data('products', '', '', $request->name);
            if (count($data) > 0) {
                return back()->with('fail', 'Product Already Present');
            } else {
                $insert = $obj->add_product($request);
                if ($insert == 0) {
                    return back()->with('success', 'Successfuly added');
                } else {
                    return back()->with('fail', 'Error Occured While Saving');
                }
            }
        }
        // UPDATE pRODUCTS
        else if (isset($request->mupdate) && $request->mupdate == 'update') {
            $request->validate([
                'mname' => 'required',
                'mntcom' => 'required',
                'mserving' => 'required',
                'mservingunit' => 'required',
                'mcalories' => 'required',
                'mproteins' => 'required',
                'mcarbs' => 'required',
                'mfats' => 'required',
                'mstatus' => 'required',
                'mcomment' => 'nullable',
            ]);
            $obj = new MainModel();
            $data_check = $obj->get_db_data('products', $request->id, '', $request->mname);
            if (count($data_check) > 1) {
                return back()->with('fail', 'Product Already Present');
            } else {
                $data = $obj->update_product($request);
                if ($data == 0) {
                    return back()->with('success', 'Successfuly Updated');
                } else if ($data == 1) {
                    return back()->with('fail', 'Error Occured While Updation');
                }
            }
        }
        // DELETE PRODUCT
        else if (isset($request->mdelete) && $request->mdelete == 'delete') {
            $obj = new MainModel();
            $delete = $obj->delete_data('products', $request->id);
            if ($delete == 0) {
                return back()->with('success', 'Successfuly Deleted');
            } else if ($delete == 1) {
                return back()->with('fail', 'Error Occured While Deletion');
            }
        }
        $obj = new MainModel();
        $data = ['product' => $obj->get_db_data('products')];
        return view('addproduct', $data);
    }
    public function allproduct()
    {
        $obj = new MainModel();
        $data = ['product' => $obj->get_db_data('products')];
        return view('allproduct', $data);
    }

    public function allcustomer()
    {
        $obj = new MainModel();
        $customer = ['customer' => $obj->get_db_data('customers')];
        return view('/allcustomer', $customer);
    }
    public function addcustomer()
    {
        $obj = new MainModel();
        $customer = ['customer' => $obj->get_db_data('customers', '', '')];
        return view('/addcustomer', $customer);
    }
    public function customer(Request $request)
    {
        if (isset($_POST['addcustomer']) && $_POST['addcustomer']) {
            $request->validate([
                'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3|max:12',
                'address' => 'nullable',
                'date' => 'required|date',
                'yage' => 'required|numeric',
                'height' => 'required|numeric',
                'gender' => 'required|in:male,female',
                'weight' => 'required|numeric',
                'status' => 'required|alpha',
                'level' => 'required',
            ]);
            $gender = $request->gender;
            $weight = $request->weight;
            $height = $request->height;
            $age = $request->yage;
            $level = $request->level;
            // echo "addcustomer";
            // exit;
            //Calculate BMR on the basis of gender
            if ($gender == 'male') {
                $bmr = 66.4730 + 13.7516 * $weight + 5.0033 * $height - 6.7550 * $age;
            } else if ($gender == 'female') {
                $bmr = 655.0955 + 9.5634 * $weight + 1.8496 * $height - 4.6756 * $age;
            }
            //Calculate Callery neede per day (Total BMR)
            if ($level == 'S') {
                $cpd = $bmr * 1.2;
            } else if ($level == 'LA') {
                $cpd = $bmr * 1.375;
            } else if ($level == 'M') {
                $cpd = $bmr * 1.55;
            } else if ($level == 'A') {
                $cpd = $bmr * 1.725;
            } else if ($level == 'VA') {
                $cpd = $bmr * 1.9;
            }
            $meter_height = $height / 100;
            $bmi = $weight / $meter_height * $meter_height;
            $request->bmr = round($bmr);
            $request->bmi = round($bmi);
            $request->cpd = round($cpd);
            $obj = new MainModel();
            $add_customer = $obj->add_customer($request);
            if ($add_customer == 0) {
                return back()->with('success', 'Customer Added Successfully');
            } else if ($add_customer == 2) {
                return back()->with('fail', 'Error Occured While Further Process');
            } else {
                return back()->with('fail', 'Error Occured While Registeration');
            }
        } else if (isset($_POST['mupdate']) && $_POST['mupdate']) {

            $request->validate([
                'mname' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                'memail' => 'required|email',
                'mpassword' => 'required|min:3|max:12',
                'maddress' => 'nullable',
                'mdate' => 'required|date',
                'myage' => 'required|numeric',
                'mheight' => 'required|numeric',
                'mgender' => 'required|in:male,female',
                'mweight' => 'required|numeric',
                'mstatus' => 'required|alpha',
                'mlevel' => 'required',
            ]);
            $gender = $request->mgender;
            $weight = $request->mweight;
            $height = $request->mheight;
            $age = $request->myage;
            $level = $request->mlevel;
            // $password = 123;
            //Calculate BMR on the basis of gender
            if ($gender == 'male') {
                $bmr = 66.4730 + 13.7516 * $weight + 5.0033 * $height - 6.7550 * $age;
            } else if ($gender == 'female') {
                $bmr = 655.0955 + 9.5634 * $weight + 1.8496 * $height - 4.6756 * $age;
            }
            //Calculate Callery neede per day (Total BMR)
            if ($level == 'S') {
                $cpd = $bmr * 1.2;
            } else if ($level == 'LA') {
                $cpd = $bmr * 1.375;
            } else if ($level == 'M') {
                $cpd = $bmr * 1.55;
            } else if ($level == 'A') {
                $cpd = $bmr * 1.725;
            } else if ($level == 'VA') {
                $cpd = $bmr * 1.9;
            }
            $meter_height = $height / 100;
            $bmi = $weight / $meter_height * $meter_height;
            //********************* Formulas BMR
            // BMR=66.4730 + 13.7516 x weight in kg + 5.0033 x height in cm – 6.7550 x age in years.
            // BMR=655.0955 + 9.5634 x weight in kg + 1.8496 x height in cm – 4.6756 x age in years.
            //BMI = weight / height*height in meter
            //********************* End Formulas
            $request->bmr = round($bmr);
            $request->bmi = round($bmi);
            $request->cpd = round($cpd);
            // return $request;
            $obj = new MainModel();
            $data_check = $obj->get_db_data('customers', $request->id, $request->memail, '');
            // var_dump($data_check);
            // exit;
            if (count($data_check) > 1) {
                return back()->with('fail', 'Email Already Present');
            } else {
                // return $request->bmr;
                $update_customer = $obj->update_customer($request);
                if ($update_customer == 0) {
                    return back()->with('success', 'Customer updated Successfully');
                } else if ($update_customer == 2) {
                    return back()->with('fail', 'Error Occured While Further updation Process');
                } else if ($update_customer == 3) {
                    return back()->with('fail', 'Error Occured While updating customer Data');
                } else {
                    return back()->with('fail', 'Error Occured While updation');
                }
            }
        } else if (isset($_POST['mdelete']) && $_POST['mdelete']) {
            $obj = new MainModel();
            $delete = $obj->delete_data('users', $request->id);
            if ($delete == 0) {
                $delete_customer = $obj->delete_data('customers', $request->id);
                if ($delete_customer == 0) {
                    return back()->with('success', 'Successfuly Deleted');
                } else {
                    return back()->with('fail', 'Error Occured While Further Deletion');
                }
            } else if ($delete == 1) {
                return back()->with('fail', 'Error Occured While Deletion');
            }
        }
        // Formulas BMR
        // BMR=66.4730 + 13.7516 x weight in kg + 5.0033 x height in cm – 6.7550 x age in years.
        // BMR=655.0955 + 9.5634 x weight in kg + 1.8496 x height in cm – 4.6756 x age in years.
        //BMI = weight / height*height in meter
        $obj = new MainModel();
        $customer = ['customer' => $obj->get_db_data('customers', '', '')];
        return view('/addcustomer', $customer);
    }

    public function nutrition(Request $request)
    {
        if (isset($_POST['addnutritionist']) && $_POST['addnutritionist'] == 'add') {
            $request->validate([
                'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3|max:12',
                'date' => 'required|date',
                'yage' => 'required|numeric',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'gender' => 'required|in:male,female',
                'level' => 'required',
                'status' => 'required|alpha',
                'experience' => 'required|numeric',
                'address' => 'nullable',
            ]);
            $gender = $request->gender;
            $weight = $request->weight;
            $height = $request->height;
            $age = $request->yage;
            $level = $request->level;
            // echo "addcustomer";
            // exit;
            //Calculate BMR on the basis of gender
            if ($gender == 'male') {
                $bmr = 66.4730 + 13.7516 * $weight + 5.0033 * $height - 6.7550 * $age;
            } else if ($gender == 'female') {
                $bmr = 655.0955 + 9.5634 * $weight + 1.8496 * $height - 4.6756 * $age;
            }
            //Calculate Callery neede per day (Total BMR)
            if ($level == 'S') {
                $cpd = $bmr * 1.2;
            } else if ($level == 'LA') {
                $cpd = $bmr * 1.375;
            } else if ($level == 'M') {
                $cpd = $bmr * 1.55;
            } else if ($level == 'A') {
                $cpd = $bmr * 1.725;
            } else if ($level == 'VA') {
                $cpd = $bmr * 1.9;
            }
            $meter_height = $height / 100;
            $bmi = $weight / $meter_height * $meter_height;
            $request->bmr = round($bmr);
            $request->bmi = round($bmi);
            $request->cpd = round($cpd);
            $obj = new MainModel();
            $add_customer = $obj->add_nutritionist($request);
            if ($add_customer == 0) {
                return back()->with('success', 'Nutritionist Added Successfully');
            } else if ($add_customer == 2) {
                return back()->with('fail', 'Error Occured While Further Process');
            } else {
                return back()->with('fail', 'Error Occured While Registeration');
            }
        } else if (isset($_POST['mupdate']) && $_POST['mupdate'] == 'update') {
            $request->validate([
                'mname' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                'memail' => 'required|email',
                'mpassword' => 'required|min:3|max:12',
                'mdate' => 'required|date',
                'myage' => 'required|numeric',
                'mheight' => 'required|numeric',
                'mweight' => 'required|numeric',
                'mgender' => 'required|in:male,female',
                'mlevel' => 'required',
                'mstatus' => 'required|alpha',
                'mexperience' => 'required|numeric',
                'maddress' => 'nullable',
            ]);
            $gender = $request->mgender;
            $weight = $request->mweight;
            $height = $request->mheight;
            $age = $request->myage;
            $level = $request->mlevel;
            // echo "addcustomer";
            // exit;
            //Calculate BMR on the basis of gender
            if ($gender == 'male') {
                $bmr = 66.4730 + 13.7516 * $weight + 5.0033 * $height - 6.7550 * $age;
            } else if ($gender == 'female') {
                $bmr = 655.0955 + 9.5634 * $weight + 1.8496 * $height - 4.6756 * $age;
            }
            //Calculate Callery neede per day (Total BMR)
            if ($level == 'S') {
                $cpd = $bmr * 1.2;
            } else if ($level == 'LA') {
                $cpd = $bmr * 1.375;
            } else if ($level == 'M') {
                $cpd = $bmr * 1.55;
            } else if ($level == 'A') {
                $cpd = $bmr * 1.725;
            } else if ($level == 'VA') {
                $cpd = $bmr * 1.9;
            }
            $meter_height = $height / 100;
            $bmi = $weight / $meter_height * $meter_height;
            $request->bmr = round($bmr);
            $request->bmi = round($bmi);
            $request->cpd = round($cpd);
            $obj = new MainModel();
            $data_check = $obj->get_db_data('nutritionist', $request->id, $request->memail, '');
            if (count($data_check) > 1) {
                return back()->with('fail', 'Nutritionist already Present');
            } else {
                $update_nutrition = $obj->update_nutritionist($request);
                if ($update_nutrition == 0) {
                    return back()->with('success', 'Nutritionist Updated Successfully');
                } else if ($update_nutrition == 2) {
                    return back()->with('fail', 'Error Occured While Further Updation Process');
                } else {
                    return back()->with('fail', 'Error Occured While Updation');
                }
            }
        } else if (isset($_POST['mdelete']) && $_POST['mdelete'] == 'delete') {
            $obj = new MainModel();
            $delete = $obj->delete_data('users', $request->id);
            if ($delete == 0) {
                $delete_nutritionist = $obj->delete_data('nutritionist', $request->id);
                if ($delete_nutritionist == 0) {
                    return back()->with('success', 'Successfuly Deleted');
                } else {
                    return back()->with('fail', 'Error Occured While Further Deletion');
                }
            } else if ($delete == 1) {
                return back()->with('fail', 'Error Occured While Deletion');
            }
        }
        $obj = new MainModel();
        $nutritionist = ['nutrition' => $obj->get_db_data('nutritionist', '', '')];
        return view('/addnutrition', $nutritionist);
    }

    public function allnutrition(Request $request)
    {
         if (isset($_POST['mupdate']) && $_POST['mupdate'] == 'update') {
            $request->validate([
                'mname' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                'memail' => 'required|email',
                'mpassword' => 'required|min:3|max:12',
                'mdate' => 'required|date',
                'myage' => 'required|numeric',
                'mheight' => 'required|numeric',
                'mweight' => 'required|numeric',
                'mgender' => 'required|in:male,female',
                'mlevel' => 'required',
                'mstatus' => 'required|alpha',
                'mexperience' => 'required|numeric',
                'maddress' => 'nullable',
            ]);
            $gender = $request->mgender;
            $weight = $request->mweight;
            $height = $request->mheight;
            $age = $request->myage;
            $level = $request->mlevel;
            // echo "addcustomer";
            // exit;
            //Calculate BMR on the basis of gender
            if ($gender == 'male') {
                $bmr = 66.4730 + 13.7516 * $weight + 5.0033 * $height - 6.7550 * $age;
            } else if ($gender == 'female') {
                $bmr = 655.0955 + 9.5634 * $weight + 1.8496 * $height - 4.6756 * $age;
            }
            //Calculate Callery neede per day (Total BMR)
            if ($level == 'S') {
                $cpd = $bmr * 1.2;
            } else if ($level == 'LA') {
                $cpd = $bmr * 1.375;
            } else if ($level == 'M') {
                $cpd = $bmr * 1.55;
            } else if ($level == 'A') {
                $cpd = $bmr * 1.725;
            } else if ($level == 'VA') {
                $cpd = $bmr * 1.9;
            }
            $meter_height = $height / 100;
            $bmi = $weight / $meter_height * $meter_height;
            $request->bmr = round($bmr);
            $request->bmi = round($bmi);
            $request->cpd = round($cpd);
            $obj = new MainModel();
            $data_check = $obj->get_db_data('nutritionist', $request->id, $request->memail, '');
            if (count($data_check) > 1) {
                return back()->with('fail', 'Nutritionist already Present');
            } else {
                $update_nutrition = $obj->update_nutritionist($request);
                if ($update_nutrition == 0) {
                    return back()->with('success', 'Nutritionist Updated Successfully');
                } else if ($update_nutrition == 2) {
                    return back()->with('fail', 'Error Occured While Further Updation Process');
                } else {
                    return back()->with('fail', 'Error Occured While Updation');
                }
            }
        } else if (isset($_POST['mdelete']) && $_POST['mdelete'] == 'delete') {
            $obj = new MainModel();
            $delete = $obj->delete_data('users', $request->id);
            if ($delete == 0) {
                $delete_nutritionist = $obj->delete_data('nutritionist', $request->id);
                if ($delete_nutritionist == 0) {
                    return back()->with('success', 'Successfuly Deleted');
                } else {
                    return back()->with('fail', 'Error Occured While Further Deletion');
                }
            } else if ($delete == 1) {
                return back()->with('fail', 'Error Occured While Deletion');
            }
        }
        $obj = new MainModel();
        $nutritionist = ['nutrition' => $obj->get_db_data('nutritionist', '', '')];
        return view('/allnutrition', $nutritionist);
    }
    

    public function profile(Request $request)
    {
        if (isset($_POST['update_profile']) && $_POST['update_profile'] == 'update') {
            $request->validate([
                'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email',
            ]);
            $gender = $request->gender;
            $weight = $request->weight;
            $height = $request->height;
            $age = $request->yage;
            $level = $request->level;
            if ($weight != '' && $height != '' && $age != '' && $gender != '') {
                //Calculate BMR on the basis of gender
                if ($gender == 'male') {
                    $bmr = 66.4730 + 13.7516 * $weight + 5.0033 * $height - 6.7550 * $age;
                } else if ($gender == 'female') {
                    $bmr = 655.0955 + 9.5634 * $weight + 1.8496 * $height - 4.6756 * $age;
                }
                //Calculate Callery neede per day (CPD)
                $meter_height = $height / 100;
                $bmi = $weight / $meter_height * $meter_height;
                if ($level == 'S') {
                    $cpd = $bmr * 1.2;
                } else if ($level == 'LA') {
                    $cpd = $bmr * 1.375;
                } else if ($level == 'M') {
                    $cpd = $bmr * 1.55;
                } else if ($level == 'A') {
                    $cpd = $bmr * 1.725;
                } else if ($level == 'VA') {
                    $cpd = $bmr * 1.9;
                }
                $request->bmr = $bmr;
                $request->bmi = $bmi;
                $request->cpd = $cpd;
                $request->status = 'a';
            }

            $obj = new MainModel();
            $user = $obj->check_duplicate('admins', session('user_id'), $request->email);
            if (count($user) > 0) {
                return back()->with('fail', 'Profile already Present');
            } else {
                if ($request->date == '') {
                    $request->date = $user[0]->dob;
                }
                if ($request->yage == '') {
                    $request->yage = $user[0]->age;
                }
                if ($request->height == '') {
                    $request->height = $user[0]->height;
                }
                if ($request->weight == '') {
                    $request->weight = $user[0]->weight;
                }
                if ($request->level == '') {
                    $request->level = $user[0]->level;
                }
                if ($request->gender == '') {
                    $request->gender = $user[0]->gender;
                }
                if ($request->experience == '') {
                    $request->experience = $user[0]->experience;
                }
                if ($request->about == '') {
                    $request->about = $user[0]->about;
                }
                if ($request->address == '') {
                    $request->address = $user[0]->address;
                }

                $update_profile = $obj->update_profile($request);

                if ($update_profile == 0) {
                    return back()->with('success', 'Profile Updated Successfully');
                } else if ($update_profile == 2) {
                    return back()->with('fail', 'Error Occured While Further Updation Process');
                } else if ($update_profile == 1) {
                    return back()->with('fail', 'Error Occured While Updation');
                } else {
                    return back()->with('fail', 'Other Error');
                }
            }
        }
        $obj = new MainModel();
        $admin = ['admin' => $obj->get_db_data('admins', session('user_id'))];
        return view('profile', $admin);
    }

    public function ch_pass(Request $request)
    {
        if (isset($_POST['submit']) && $_POST['submit'] == 'change') {
            $request->validate([
                'old' => 'required',
                'new' => 'required',
                'confirm' => 'required',
            ]);
            $obj = new MainModel();
            $user = $obj->get_db_data('users', session('user_id'));
            $dbpass = $user[0]->password;

            if (!Hash::check($request->old, $dbpass)) {
                return back()->with('fail', "Password isn't correct");
            } else {
                if ($request->new == $request->confirm) {
                    $response = $obj->update_pass($request);
                    if ($response == 0) {
                        return back()->with('success', 'Successfully Updated');
                    } else {
                        return back()->with('fail', "Error Occured while password updation");
                    }
                } else {
                    return back()->with('fail', "New and Confirm Password Doent not Matched");
                }
            }
        }
        return view('chpass');
    }

    public function dailyintake(Request $request)
    {
        if (isset($request->addintake) && $request->addintake == 'addintake') 
        {
            $obj = new MainModel();
            $user = $obj->daily_intake($request);
            if ($user == 0) 
            {
                return back()->with('success', 'Successfully Added');
            } 
            else 
            {
                return back()->with('fail', "Error Occured while Adding daily intake");
            }
        }
        if (isset($request->addpro) && $request->addpro == 'add') 
        {
            $request->validate([
                'name' => 'required',
                'ntcom' => 'required',
                'serving' => 'required',
                'servingunit' => 'required',
                'calories' => 'required',
                'proteins' => 'required',
                'carbs' => 'required',
                'fats' => 'required',
                'status' => 'required',
                'comment' => 'nullable',
            ]);
            $obj = new MainModel();
            $data = $obj->get_db_data('products', '', '', $request->name);
            if (count($data) > 0) 
            {
                return back()->with('fail', 'Product Already Present');
            } 
            else 
            {
                $insert = $obj->add_product($request);
                if ($insert == 0) 
                {
                    return back()->with('success', 'Successfuly added');
                } 
                else 
                {
                    return back()->with('fail', 'Error Occured While Saving');
                }
            }
        }

        return view('dailyintake');
    }

    public function report(Request $request)
    {
        $intake = array();
        $admin = array();
        if (isset($request->submit) && $request->submit == 'Load') {
            $request->validate([
                'fromdate' => 'required|date',
                'todate' => 'required|date'
            ]);
            // return $request;
            $obj = new MainModel();
            $intake = ['intake' =>  $obj->get_intake($request)];
            $id = session('user_id');
            $admin = ['admins' =>  $obj->get_db_data('admins',$id)];            
        }
        return view('report', $intake, $admin);
    }
}
