<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MainModel extends Model
{
    use HasFactory;
    public function get_db_user($id = '', $email = '')
    {
        if ($email != '') {
            $where = "where email = '$email' ";
        } else if ($id != '') {
            $where = "where id = '$id' ";
        } else {
            $where = '';
        }
        $user = DB::select("SELECT * FROM users $where");
        return $user;
    }

    public function get_db_data($tblname, $id = '', $email = '', $name = '')
    {
        $where = '';
        if ($tblname == 'products') {
            if ($name != '') {
                $where = "where product_name = '$name'";
            } else if ($id != '') {
                $where .= "and product_id != '$id'";
            }
        }
        if ($tblname == 'users') {
            if ($id != '') {
                $where = "where id = '$id'";
            } else if ($email != '') {
                $where .= "where email = '$email'";
            }
        }
        if ($tblname == 'customers') {
            if ($id != '') {
                $where = "where id = '$id'";
            } else if ($email != '') {
                $where .= "and email = '$email'";
            }
        }
        if ($tblname == 'admins') {
            if ($id != '') {
                $where = "where id = '$id'";
            } else if ($email != '') {
                $where .= "and email = '$email'";
            }
        }

        $products = DB::select("SELECT * FROM  $tblname $where");
        return $products;
    }


    public function add_product($request)
    {
        $obj = new MainModel();
        // dd($request->name);
        $insert = DB::table('products')->insert([
            'date' => date("Y-m-d H:i:s"),
            'product_name' => $request->name,
            'product_nutrition_composition' => $request->ntcom,
            'serving_unit' => $request->servingunit,
            'product_serving' => $request->serving,
            'product_calories' => $request->calories,
            'product_protein' => $request->proteins,
            'product_carbs' => $request->carbs,
            'product_fat' => $request->fats,
            'product_status' => $request->status,
            'product_comment' => $request->comment,
        ]);
        if ($insert) {
            return 0;
        } else {
            return 1;
        }
    }

    public function update_product($request)
    {
        $update = DB::table('products')
            ->where('product_id', $request->id)
            ->update([
                'updated_at' => date("Y-m-d H:i:s"),
                'product_name' => $request->mname,
                'product_nutrition_composition' => $request->mntcom,
                'serving_unit' => $request->mservingunit,
                'product_serving' => $request->mserving,
                'product_calories' => $request->mcalories,
                'product_protein' => $request->mproteins,
                'product_carbs' => $request->mcarbs,
                'product_fat' => $request->mfats,
                'product_status' => $request->mstatus,
                'product_comment' => $request->mcomment,
            ]);
        if ($update) {
            return 0;
        } else {
            return 1;
        }
    }

    public function delete_data($tblname, $id)
    {
        if ($tblname == 'products') {
            $delete = DB::delete("DELETE FROM `$tblname` WHERE `product_id` = '$id' ");
        } else {
            $delete = DB::delete("DELETE FROM `$tblname` WHERE `id` = '$id' ");
        }
        if ($delete) {
            return 0;
        } else {
            return 1;
        }
    }

    public function add_customer($request)
    {
        // return $request->input();
        $insert = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'C',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        // $date = date('d-m-Y' ,$request->date);
        // return $date;
        $customerid = DB::getPdo()->lastInsertId();
        if ($insert) {
            $customer_insert = DB::table('customers')->insert([
                'id' => $customerid,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'dob' => $request->date,
                'age' => $request->yage,
                'height' => $request->height,
                'weight' => $request->weight,
                'gender' => $request->gender,
                'role' => 'C',
                'Status' => $request->status,
                'address' => $request->address,
                'level' => $request->level,
                'created_at' => date("Y-m-d H:i:s"),
                'bmr' => $request->bmr,
                'bmi' => $request->bmi,
                'cpd' => $request->cpd,
            ]);
            if ($customer_insert) {
                return 0;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }

    public function update_customer($request)
    {
        $obj = new MainModel();
        $update_user = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->mname,
                'email' => $request->memail,
                'password' => Hash::make($request->mpassword),
                'role' => 'C',
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        if ($update_user) {
            $update_customer = DB::table('customers')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->mname,
                    'email' => $request->memail,
                    'password' => Hash::make($request->mpassword),
                    'dob' => $request->mdate,
                    'age' => $request->myage,
                    'height' => $request->mheight,
                    'weight' => $request->mweight,
                    'gender' => $request->mgender,
                    'role' => 'C',
                    'Status' => $request->mstatus,
                    'address' => $request->maddress,
                    'level' => $request->mlevel,
                    'updated_at' => date("Y-m-d H:i:s"),
                    'bmr' => $request->bmr,
                    'bmi' => $request->bmi,
                    'cpd' => $request->cpd,
                ]);
            if ($update_customer) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }

    public function add_nutritionist($request)
    {
        // return $request->input();
        $insert = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'N',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        // $date = date('d-m-Y' ,$request->date);
        // return $date;
        $nutritionistid = DB::getPdo()->lastInsertId();
        if ($insert) {
            $nutritionist_insert = DB::table('nutritionist')->insert([
                'id' => $nutritionistid,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'dob' => $request->date,
                'age' => $request->yage,
                'height' => $request->height,
                'weight' => $request->weight,
                'gender' => $request->gender,
                'role' => 'N',
                'Status' => $request->status,
                'address' => $request->address,
                'level' => $request->level,
                'created_at' => date("Y-m-d H:i:s"),
                'bmr' => $request->bmr,
                'bmi' => $request->bmi,
                'cpd' => $request->cpd,
                'experience' => $request->experience,
            ]);
            if ($nutritionist_insert) {
                return 0;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }

    public function update_nutritionist($request)
    {
        $obj = new MainModel();
        $update_user = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->mname,
                'email' => $request->memail,
                'password' => Hash::make($request->mpassword),
                'role' => 'N',
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        if ($update_user) {
            $update_nutritionist = DB::table('nutritionist')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->mname,
                    'email' => $request->memail,
                    'password' => Hash::make($request->mpassword),
                    'dob' => $request->mdate,
                    'age' => $request->myage,
                    'height' => $request->mheight,
                    'weight' => $request->mweight,
                    'gender' => $request->mgender,
                    'role' => 'N',
                    'Status' => $request->mstatus,
                    'address' => $request->maddress,
                    'level' => $request->mlevel,
                    'updated_at' => date("Y-m-d H:i:s"),
                    'bmr' => $request->bmr,
                    'bmi' => $request->bmi,
                    'cpd' => $request->cpd,
                    'experience' => $request->mexperience,
                ]);
            if ($update_nutritionist) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }

    public function check_duplicate($tblname, $id = '', $email = '')
    {
        $where = '';
        if ($id != '') {
            $where = "where id != '$id' ";
        } else if ($email != '') {
            $where = "where email = '$email' ";
        }
        $result = DB::select("SELECT * FROM $tblname $where");
        return $result;
    }

    public function update_profile($request)
    {
        $update_user = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        if ($update_user) {

            // $update_profile = "UPDATE `admins` SET  `name`='$request->name',`email`='$request->email',`dob`='$request->date',`age`='$request->yage',`height`='$request->height',`weight`='$request->weight',`gender`='$request->gender',`status`='$request->status',`experience`='$request->experience',`level`='$request->level',`address`='$request->address',`bmr`='$request->bmr',`bmi`='$request->bmi',`cpd`='$request->cpd',`about`='$request->about',`updated_at`=".date('Y-m-d H:i:s')." WHERE id = $request->id";
            $update_profile = DB::table('admins')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'dob' => $request->date,
                    'age' => $request->yage,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'gender' => $request->gender,
                    'Status' => $request->status,
                    'address' => $request->address,
                    'level' => $request->level,
                    'updated_at' => date("Y-m-d H:i:s"),
                    'bmr' => $request->bmr,
                    'bmi' => $request->bmi,
                    'cpd' => $request->cpd,
                    'experience' => $request->experience,
                    'about' => $request->about,
                ]);
            if ($update_profile) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }

    public function update_pass($request)
    {
        $update_pass = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => Hash::make($request->new),
            ]);
        if ($update_pass) {
            $update_pass_admin = DB::table('admins')
                ->where('id', $request->id)
                ->update([
                    'password' => Hash::make($request->new),
                ]);
            if ($update_pass_admin) {
                return 0;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }

    public function daily_intake($request)
    {
        $result = false;
        if (isset($request->pro_id) && $request->pro_id != '') 
        {
            DB::beginTransaction();
            foreach ($request->pro_id as $key => $row)
            {
                $result = DB::table('intake')->insert([
                    'userid' => session('user_id'),
                    'pro_id' => $request->pro_id[$key],
                    'type' => $request->type,
                    'pro_name' => $request->name[$key],
                    'pro_com' => $request->pnc[$key],
                    'serving' => $request->serving[$key],
                    'sunit' => $request->sunit[$key],
                    'calories' => $request->cal[$key],
                    'protein' => $request->prot[$key],
                    'carbs' => $request->carb[$key],
                    'fat' => $request->fat[$key],
                    'created_date' => date("Y-m-d H:i:s"),
                    'date' => date("Y-m-d")
                ]);
                if (!$result) 
                {
                    break;
                }
            }
            if ($result) 
            {
                DB::commit();
                return 0;
            } 
            else
            {
                DB::rollBack();
                return 1;
            }
        }
    }

    public function get_intake($request)
    {
        $data =DB::select("SELECT * FROM `intake` WHERE `userid` = $request->id and `date` BETWEEN '$request->fromdate' and '$request->todate'");
        return $data;
    }
    
}
