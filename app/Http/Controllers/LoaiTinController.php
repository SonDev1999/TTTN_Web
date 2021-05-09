<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;
use App\Models\Comment;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);

    }
    public function getSua($id){
        $theloai= TheLoai::all();
        $loaitin=LoaiTin::find($id);    
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,[
            'Ten'=>'required|min:3|max:100',
            'TheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên',
           
            'Ten.min'=>'Tên loại tin phải có độ dài 3->100 ký tự',
            'Ten.max'=>'Tên loại tin phải có độ dài 3->100 ký tự',
            'TheLoai.required'=>'Chưa chọn thể loại',
        ]);
        $theloai= TheLoai::all();
        $loaitin=LoaiTin::find($id);
        $loaitin->idTheLoai=$request->TheLoai;
        $loaitin->Ten=$request->Ten;
       
        $loaitin->save();
        
        return redirect ('admin/loaitin/sua/'.$id)->with('thongbao','Sửa Thành Công');
    }
    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);

    }
    
    public function postThem(Request $request){
        $this->validate($request,[
            'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
            'TheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên',
            'Ten.unique'=>'Tên đã tồn tại',
            'Ten.min'=>'Tên thể loại phải có độ dài 3->100 ký tự',
            'Ten.max'=>'Tên thể loại phải có độ dài 3->100 ký tự',
            'TheLoai.required'=>'Chưa chọn thể loại',
        ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten=$request->Ten;
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect ('admin/loaitin/them')->with('thongbao','Thêm Thành Công');
    }
    public function getXoa($id){
        $loaitin= LoaiTin::find($id);
        $getTinTuc = TinTuc::where('idLoaiTin',$id)->get();
        $tintuc = TinTuc::where('idLoaiTin',$id);
        // dd($getTinTuc);
        foreach($getTinTuc as $value){
            // dd($value->id);
            Comment::where('idTinTuc',$value->id)->delete();
        }
  
    
        // $comment = Comment::where('idTinTuc',$tintuc->$id);
        // $comment->delete();
        $tintuc->delete();
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
