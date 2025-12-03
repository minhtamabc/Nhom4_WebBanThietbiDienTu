<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = Cart::getContent();
        $total = Cart::getTotal();
        
        return view('cart', compact('cartItems', 'total'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {
        $product = DB::table('chitietthietbi')
            ->join('hang', 'chitietthietbi.id_hang', '=', 'hang.id_hang')
            ->join('loaisanpham', 'chitietthietbi.id_loai', '=', 'loaisanpham.id_loai_sp')
            ->where('chitietthietbi.id_chi_tiet_thiet_bi', $request->id)
            ->select(
                'chitietthietbi.*',
                'hang.ten_hang',
                'loaisanpham.ten_loai_sp'
            )
            ->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        if ($product->so_luong_ton_kho < 1) {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng!');
        }

        Cart::add([
            'id' => $product->id_chi_tiet_thiet_bi,
            'name' => $product->ten,
            'price' => $product->gia_ban,
            'quantity' => $request->quantity ?? 1,
            'attributes' => [
                'hang' => $product->ten_hang,
                'loai' => $product->ten_loai_sp,
                'ton_kho' => $product->so_luong_ton_kho
            ]
        ]);

        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ]
        ]);

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng!');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        Cart::remove($id);
        
        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        Cart::clear();
        
        return redirect()->route('cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }
}