<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function Laravel\Prompts\password;

class UpdateForRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return[

        ];
    }

    public function messages() : array
    {
        return [

        ];
    }

    public static function userRules() : array
    {
        return [
            'name' => 'required',
            'group_role'=>'required|in: 1,2,3',
            'is_active'=>'required|in:0,1',
        ];
    }

    public static function customerRules(): array
    {
        return [
            'customer_name' => 'required',
            'tel_num'=> 'required|integer',
            'address'=> 'required',
            'is_active' => 'required|in:0,1',
        ];
    }

    public static function productRules(): array
    {
        return [
            'product_name' => 'required',
            'product_image' => 'mimes:jpeg,jpg,png|max:10000',
            'product_price' => 'required|numeric',
            'is_sales' => 'required|in:1,2,3',
            'deccription' => 'required',
        ];
    }

    public static function userMessages() : array
    {
        return[
            'name.required' =>'Vui lòng nhập tên',
            'group_role.required' => 'Vui lòng chọn nhóm quyền',
            'is_active.required' => 'Vui lòng chọn trạng thái'
        ];
    }

    public static function customerMessages(): array
    {
        return [
            'customer_name.required' => 'Vui lòng nhập tên khách hàng',
            'tel_num.required' => 'Vui lòng nhập số điện thoại',
            'tel_num.numeric' => 'Vui lòng nhập số điện thoại đúng định dạng',
            'tel_num.integer' => 'Vui lòng nhập số điện thoại là số nguyên',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'is_active.required' => 'Vui lòng chọn trạng thái',
        ];
    }

    public static function productMessages(): array
    {
        return [
            'product_name.required' => 'Vui lòng nhập tên sản phẩm',
            'product_image.mimes' => 'Vui lòng chọn đúng định dạng hình ảnh (jpeg, jpg, png)',
            'product_image.max' => 'Kích thước hình ảnh không quá 10MB',
            'product_price.required' => 'Vui lòng nhập giá sản phẩm',
            'product_price.numeric' => 'Vui lòng nhập giá sản phẩm là số',
            'is_sales.required' => 'Vui lòng chọn trạng thái',
            'deccription' => 'Vui lòng nhập mô tả',
        ];
    }


}
