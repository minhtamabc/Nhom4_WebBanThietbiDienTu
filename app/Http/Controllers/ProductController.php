<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
      // Trang danh sách sản phẩm
      public function products()
      {
        $data = [];
        $products = DB::table('chitietthietbi')
                    ->select(
                        'ten','gia_ban','src_anh'
                    )
                    ->get();
        $branch = DB::table('hang')
                ->select('ten_hang')
                ->get();
        $bestSeller = DB::table('thietbibanchay')
                    ->join('chitietthietbi','thietbibanchay.id_chi_tiet_thiet_bi','chitietthietbi.id_chi_tiet_thiet_bi')
                    ->select('chitietthietbi.ten','chitietthietbi.gia_ban','chitietthietbi.src_anh')
                    ->get();

        $data["products"] = $products;
        $data["branch"] = $branch; 
        $data["bestSeller"] = $bestSeller;
        return view('home')->with('data',$data);
      }
}
