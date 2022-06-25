<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginModel extends Model
{
    use HasFactory;
    public function get_db_data($tblname, $id = '', $email = '' , $lmt = '')
    {
        $where = '';
        $limit = '';
        if ($email != '') 
        {
            $where = "where email = '$email' ";
        } 
        else if ($id != '') 
        {
            $where = "where id = '$id' ";
        } 
        else if ($limit != '') 
        {
            $limit .= "limit = $lmt ";
        }

        $user = DB::select("select * from $tblname $where $limit");
        return $user;
    }
    public function insert_user($request)
    {
        // return $request->email;
        $insert = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'A',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        $adminid = DB::getPdo()->lastInsertId();
        if ($insert) {
            $insert_admin = DB::table('admins')->insert([
                'id' => $adminid,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'dob' => $request->date,
                'age' => $request->yage,
                'height' => $request->height,
                'weight' => $request->weight,
                'gender' => $request->gender,
                'role' => 'A',
                'Status' => $request->status,
                'address' => $request->address,
                'level' => $request->level,
                'created_at' => date("Y-m-d H:i:s"),
                'bmr' => $request->bmr,
                'bmi' => $request->bmi,
                'cpd' => $request->cpd
            ]);
           if($insert_admin)
           {
               return 0;
           }
           else
           {
               return 1;
           }
        } 
        else 
        {
            return 2;
        }
    }
}
