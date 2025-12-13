<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    function index(){
        return view('admin.index');
    }
    function login(){
        return view('admin.login');
    }

    function handleLogin(){
        if(isset($_POST["username"]) && isset($_POST["password"])){
            if($_POST["username"] != "" || $_POST["password"] != ""){

                $username = strip_tags(trim($_POST["username"]));
                $password = strip_tags(trim($_POST["password"]));

                if(preg_match("/^[a-zA-Z0-9\.]{6,}$/",$username) && (strlen($password) > 5)){
                    $admin = DB::table('userhethong')
                                ->select('id_he_thong','username','password','fullname')
                                ->where('username','=',$username)
                                ->get();
                    if(count($admin) != 0){
                        if(Hash::check($password,$admin[0]->password)){
                            session(["admin_id" => $admin[0]->id_he_thong]);
                            session(["admin_name" => $admin[0]->fullname]);
                            return  redirect('/trang-chu')->with('success', 'Đăng nhập thành công !');
                        }
                    }
                }
            }  
        }
        return redirect('/trang-chu/login')->with('error', 'Có lỗi xảy ra khi đăng nhập: ');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/trang-chu/login')->with('success', 'Đăng xuất thành công!');
    }

    function productManagement(){
        return view('admin.sanpham.sanpham');
    }

    
    function orderManagement($trangThai=1){
        $data = [];
        // danh sách order
        $orders = DB::table('donhang')
                    ->join('khachhang','khachhang.id_khach_hang','donhang.id_khach_hang')
                    ->select('id_don_hang','fullname','tong_tien','loai_thanh_toan','trang_thai_don_hang','ngay_giao')
                    ->where('trang_thai_don_hang','=',$trangThai)
                    ->get();
        if($trangThai == 2)
            $data["confirm"] = $orders;
        else if($trangThai == 3)
            $data["delivery"] = $orders;
        else if($trangThai == 5)
            $data["finish"] = $orders;
        else
            $data["orders"] = $orders;
        return view('admin.donhang.donhang')->with('data',$data);
    }

    function orderConfirm(){
        if(isset($_POST["idDonHang"])){
            $idDonHang = $_POST["idDonHang"];
            $data = [];
            // danh sách order đã duyệt
            $orders = DB::table('donhang')
                        ->join('khachhang','khachhang.id_khach_hang','donhang.id_khach_hang')
                        ->select('id_don_hang','fullname','tong_tien','loai_thanh_toan','dia_chi','sdt')
                        ->where('trang_thai_don_hang','=',1)
                        ->where('donhang.id_don_hang','=',$idDonHang)
                        ->get();

            $details = DB::table('chitietdonhang')
                        ->join('chitietthietbi','chitietthietbi.id_chi_tiet_thiet_bi','chitietdonhang.id_chi_tiet_thiet_bi')
                        ->select('ten','gia_ban','so_luong','tong_tien','src_anh')
                        ->where('chitietdonhang.id_don_hang','=',$idDonHang)
                        ->get();

            $data["order"] = $orders;
            $data["detail"] = $details;
            $data["vanchuyen"] = false;
            return view('admin.donhang.xacnhan')->with('data',$data);
        }
        return view('admin.donhang.xacnhan')->with('data',[]);
    }

    function confirmStep2(Request $request){
        $idDonHang = $request->input('idDonHang');
        if($idDonHang){
            $data = DB::table('donhang')
                        ->where('id_don_hang','=',$idDonHang)
                        ->update([
                            'trang_thai_don_hang' => 2
                        ]);
            if($data > 0)  
                return redirect()->route('admin.order',2)->with('success','Đã chuyển đơn hàng sang trạng thái đã duyệt !');
        }
        return redirect()->route('admin.order',1)->with('error','Không cập nhật được, vui lòng thử lại sau !');
     }

    function detailOrder(){
        if(isset($_POST["idDonHang"])){
            $idDonHang = $_POST["idDonHang"];
            $data = [];
            // danh sách order đã duyệt
            $orders = DB::table('donhang')
                        ->join('khachhang','khachhang.id_khach_hang','donhang.id_khach_hang')
                        ->select('id_don_hang','fullname','tong_tien','loai_thanh_toan','dia_chi','sdt')
                        ->where('trang_thai_don_hang','=',2)
                        ->where('donhang.id_don_hang','=',$idDonHang)
                        ->get();

            $details = DB::table('chitietdonhang')
                        ->join('chitietthietbi','chitietthietbi.id_chi_tiet_thiet_bi','chitietdonhang.id_chi_tiet_thiet_bi')
                        ->select('ten','gia_ban','so_luong','tong_tien','src_anh')
                        ->where('chitietdonhang.id_don_hang','=',$idDonHang)
                        ->get();

            $data["order"] = $orders;
            $data["detail"] = $details;
            $data["vanchuyen"] = true;
            return view('admin.donhang.xacnhan')->with('data',$data);
        }
        return view('admin.donhang.xacnhan')->with('data',[]);
    }

    function delivery(Request $request){
        $idDonHang = $request->input('idDonHang');
        if($idDonHang){
            $data = DB::table('donhang')
                        ->where('id_don_hang','=',$idDonHang)
                        ->update([
                            'trang_thai_don_hang' => 3
                        ]);
            if($data > 0)  
                return redirect()->route('admin.order',3)->with('success','Đã chuyển đơn hàng sang trạng thái vận chuyển !');
        }
        return redirect()->route('admin.order',2)->with('error','Không cập nhật được, vui lòng thử lại sau !');
     }

     function confirmFinish(){
        if(isset($_POST["idDonHang"])){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $idDonHang = $_POST["idDonHang"];
            // danh sách order đã duyệt
            $data = DB::table('donhang')
                        ->where('id_don_hang','=',$idDonHang)
                        ->update([
                            'trang_thai_don_hang' => 5,
                            'ngay_giao' => date("Y-m-d H:i:s")
                        ]);
            if($data > 0)
                return redirect()->route('admin.order',5)->with('success','Đơn hàng đã hoàn thành !');
        }
        return redirect()->route('admin.order',3)->with('error','Không cập nhật được, vui lòng thử lại sau !');
     }

     function detail($idDonHang){;
        $data = [];
        // danh sách order đã duyệt
        $orders = DB::table('donhang')
                    ->join('khachhang','khachhang.id_khach_hang','donhang.id_khach_hang')
                    ->select('id_don_hang','fullname','tong_tien','loai_thanh_toan','dia_chi','sdt','ngay_giao')
                    ->where('trang_thai_don_hang','=',5)
                    ->where('donhang.id_don_hang','=',$idDonHang)
                    ->get();

        $details = DB::table('chitietdonhang')
                    ->join('chitietthietbi','chitietthietbi.id_chi_tiet_thiet_bi','chitietdonhang.id_chi_tiet_thiet_bi')
                    ->select('ten','gia_ban','so_luong','tong_tien','src_anh')
                    ->where('chitietdonhang.id_don_hang','=',$idDonHang)
                    ->get();
        if(count($orders) < 1 )
            return  redirect()->route('admin.order',5)->with('error','Không thẻ xem chi tiết, vui lòng thử lại sau !');
        $data["order"] = $orders;
        $data["detail"] = $details;
        $data["vanchuyen"] = 2;
        return view('admin.donhang.xacnhan')->with('data',$data);
     }
}
