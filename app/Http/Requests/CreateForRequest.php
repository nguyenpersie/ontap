<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function Laravel\Prompts\password;

class CreateForRequest extends FormRequest
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

        return [


        ];
    }

    public function messages() : array
    {
        return[

        ];
    }

    public static function userRules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:mst_users',
            'password' => 'required|min:8',
            'group_role' => 'required',
            'is_active' => 'required|in:0,1',
        ];
    }

    public static function customerRules(): array
    {
        return [
            'customer_name' => 'required',
            'email' => 'required|unique:mst_customers',
            'tel_num'=> 'required|integer',
            'address'=> 'required',
            'is_active' => 'required|in:0,1',
        ];
    }

    public static function productRules(): array
    {
        return [
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'is_sales' => 'required|in:1,2,3',
            'deccription' => 'required',
            'product_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public static function userMessages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'group_role.required' => 'Vui lòng chọn nhóm quyền',
            'is_active.required' => 'Vui lòng chọn trạng thái',
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
            'email.required|email:filter', 'Vui lòng nhập đúng định dạng email',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'is_active.required' => 'Vui lòng chọn trạng thái',
        ];
    }

    public static function productMessages(): array
    {
        return[
            'product_name.required' => 'Vui lòng nhập tên sản phẩm',
            'product_image.required' => 'Vui lòng chọn hình ảnh',
            'product_image.mimes' => 'Vui lòng chọn hình ảnh đúng định dạng (jpeg, jpg, png)',
            'product_image.max' => 'Hình ảnh phải nhỏ hơn 10MB',
            'product_price.required' => 'Vui lòng nhập giá sản phẩm',
            'product_price.numeric' => 'Vui lòng nhập giá sản phẩm là số',
            'is_sales.required' => 'Vui lòng chọn trạng thái khuyến mãi',
            'deccription' => 'Vui lòng nhập mô tả',
        ];
    }
}
