<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\TinTuc;
use App\Models\LoaiTin;
use App\Models\Comment;
class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);

    }
    public function getSua($id){
        $theloai=TheLoai::find($id);    
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        
        
        
        /* $theloai = TheLoai::find($id); */
        $theloai = TheLoai::where('id',$id)->first();
        $theloai->Ten=$request->Ten;
        $theloai->save();
        return redirect ('admin/theloai/sua/'.$id)->with('thongbao','Sửa Thành Công');
    }
    public function getThem(){
        return view('admin.theloai.them');

    }
    
    public function postThem(Request $request){
        $this->validate($request,[
            'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên',
            'Ten.unique'=>'Tên đã tồn tại',
            'Ten.min'=>'Tên thể loại phải có độ dài 3->100 ký tự',
            'Ten.max'=>'Tên thể loại phải có độ dài 3->100 ký tự',
        ]);
        $theloai = new TheLoai;
        $theloai->Ten=$request->Ten;
        $theloai->save();
        return redirect ('admin/theloai/them')->with('thongbao','Thêm Thành Công');
    }
    public function getXoa($id){
        $theloai= TheLoai::find($id);
        $getLoaiTin = LoaiTin::where('idTheLoai',$id)->get();
        $loaitin = LoaiTin::where('idTheLoai',$id);
        foreach($getLoaiTin as $value) {
            $getTinTuc = TinTuc::where('idLoaiTin', $value->id)->get();
           
            foreach($getTinTuc as $value) {
                // dd($getTinTuc);
                Comment::where('idTinTuc', $value->id)->delete();
                TinTuc::find($value->id)->delete();
            }

           
        }

        $loaitin->delete();
        
       
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
