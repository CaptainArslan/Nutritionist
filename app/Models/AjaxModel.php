<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AjaxModel extends Model
{
    use HasFactory;
    public function get_db_customer($id = '', $email = '')
    {
        if ($email != '') {
            $where = "where email = '$email' ";
        } else if ($id != '') {
            $where = "where id = '$id' ";
        } else {
            $where = '';
        }
        $user = DB::select("SELECT * FROM customers $where");
        return $user;
    }
    public function get_db_product($id = '')
    {
        $where = '';
        if ($id != '') {
            $where = "WHERE `product_id` = '$id'";
        }
        $product = DB::select("SELECT * FROM `products` $where");
        if(sizeof($product) > 0 )
        return $product;
        else
        return $product = 0;
    }
    public function get_db_nutritionist($id = '')
    {
        $where = '';
        if ($id != '') {
            $where = "WHERE `id` = '$id'";
        }
        $nutrition = DB::select("SELECT * FROM `nutritionist` $where");
        return $nutrition;
    }

    public function intake_product($name)
    {
        $intake = DB::select("SELECT * FROM `products` WHERE `product_name` LIKE '%$name%'");
        return $intake;
    }

    public function delrpt_intake($request){
        $delete = DB::delete("DELETE FROM `intake` WHERE `id` = '$request->id' and `userid` = '$request->userid'");
        if($delete)
        {
            return 0;
        }
        else{
            return 1;
        }
    }
}
