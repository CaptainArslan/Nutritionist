<?php

namespace App\Http\Controllers;

use App\Models\AjaxModel;
use Illuminate\Http\Request;

class AjaxXontroller extends Controller
{
    public function get_product(Request $request)
    {
        $obj = new AjaxModel();
        $product = $obj->get_db_product($request->id);
        echo json_encode($product[0]);
    }
    public function get_customer(Request $request)
    {
        $obj = new AjaxModel();
        $customer = $obj->get_db_customer($request->id);
        echo json_encode($customer[0]);
    }

    public function get_nutritionist(Request $request)
    {
        $obj = new AjaxModel();
        $nutritionist = $obj->get_db_nutritionist($request->id);
        echo json_encode($nutritionist[0]);
    }

    public function intake_product(Request $request)
    {
        $obj = new AjaxModel();
        $intake = $obj->intake_product($request->name);

        if (sizeof($intake) > 0) {
            $com = '';
            array_multisort($intake, SORT_DESC);
            $result = '
            <table class="table table-responsive-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Nutrition Composition</th>
                    <th>Serving</th>
                    <th>Calories</th>
                    <th>Protein</th>
                    <th>Carbs</th>
                    <th>Fats</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($intake as $key => $row) 
            {
                if ($row->product_nutrition_composition == 'BGCRP')
                    $com = 'Breads, Grains, Cereals, Pasta, Rice';
                elseif ($row->product_nutrition_composition == 'MF')
                    $com = 'Meat and Fish';
                elseif ($row->product_nutrition_composition == 'FFJ')
                    $com = 'Fruit and Fruit Juices';
                elseif ($row->product_nutrition_composition == 'VL')
                    $com = 'Vegetables and Legumes (e.g. Beans)';
                elseif ($row->product_nutrition_composition == 'DP')
                    $com = 'Dairy Products - Milk, Cheese, etc';
                elseif ($row->product_nutrition_composition == 'EGG')
                    $com = 'Eggs and Egg Substitutes';
                elseif ($row->product_nutrition_composition == 'NS')
                    $com = 'Nuts and Seeds';
                elseif ($row->product_nutrition_composition == 'FO')
                    $com = 'Fats and Oils';
                elseif ($row->product_nutrition_composition == 'HSS')
                    $com = 'Herbs, Spices, Sauces';
                elseif ($row->product_nutrition_composition == 'BEVER')
                    $com = 'Beverages';
                elseif ($row->product_nutrition_composition == 'OSS')
                    $com = 'Others, Snacks, Sweets, etc';
                // print_data($row);
                $result .= '
                <tr>
                    <td>
                        <input type="checkbox" id="' . $row->product_id . '" value="' . $row->product_id . '" onclick="check_intake(this)">
                        <input type="hidden" name="pro_id[]" id="' . $row->product_id . '"  value="' . $row->product_id . '" class="cls_data_field"  disabled>
                    </td>
                    <td>
                        ' . $row->product_name . '
                        <input type="hidden" name="name[]" id="name" class="cls_data_field" value="' . $row->product_name . '" disabled>
                    </td>
                    <td>
                        ' . $com . '
                        <input type="hidden" name="pnc[]" id="pnc" class="cls_data_field" value="' . $row->product_nutrition_composition . '" disabled>
                    </td>
                    <td>
                    ' . $row->product_serving . ' ' . $row->serving_unit . '
                        <input type="hidden" name="serving[]" id="' . $row->product_serving . '"  value="' . $row->product_serving . '" class="cls_data_field"  disabled>
                        <input type="hidden" name="sunit[]" id="' . $row->serving_unit . '"  value="' . $row->serving_unit . '" class="cls_data_field"  disabled>
                    </td>
                    <td>
                        ' . $row->product_calories . '
                        <input type="hidden" name="cal[]" id="cal" class="cls_data_field" value="' . $row->product_calories . '" disabled>
                    </td>
                    <td>
                        ' . $row->product_protein . '
                        <input type="hidden" name="prot[]" id="prot" class="cls_data_field" value="' . $row->product_protein . '" disabled>
                    </td>
                    <td>
                        ' . $row->product_carbs . '
                        <input type="hidden" name="carb[]" id="carb" class="cls_data_field" value="' . $row->product_carbs . '" disabled>
                    </td>
                    <td>
                        ' . $row->product_fat . '
                        <input type="hidden" name="fat[]" id="fat" class="cls_data_field" value="' . $row->product_fat . '" disabled>
                    </td>
                </tr>';
            }
            $result .= '</tbody>
            <tr>
                <td colspan="8" align="center">
                    <button  type="submit" class="btn btn-primary m-auto" name="addintake" id="addintake" value="addintake" onclick="return confirm("Are you Sure to save this !")" >Add Intake</button>
                </td>
            </tr>
        </table>
        <a href="#" data-toggle="modal" data-target="#add_custom_product">Add Custom Product</a>';
            echo $result;
        } else {
            echo 'No Product Found 
            <a href="#" style="float: right;" data-toggle="modal" data-target="#add_custom_product">Add Custom Product</a>';

        }
    }

    public function delrpt_intake(Request $request)
    {
        $obj = new AjaxModel();
        $del = $obj->delrpt_intake($request);
        if ($del == 0) {
            echo "D";
        } else {
            echo "ND";
        }
    }
}
