<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use Illuminate\Support\Str;
use App\Models\Comment;
class TinTucController extends Controller
{
    //
    public function getDanhSach(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);

    }
    public function getSua($id){
        $tintuc=TinTuc::find($id);   
        $theloai=TheLoai::all();
        $loatin=LoaiTin::all(); 
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loatin]);
    }
    public function postSua(Request $request,$id){
        
        
        $tintuc=TinTuc::find($id);
      
        
        $tintuc->TieuDe=$request->TieuDe;
        $tintuc->idLoaiTin=$request->LoaiTin;
        $tintuc->MoTa=$request->MoTa;
        $tintuc->NoiDung=$request->NoiDung;
        $tintuc->SoLuotXem=0;
        $tintuc->NoiBat=$request->NoiBat;

        if($request->hasFile('Hinh'))
    	{
    		$img_file = $request->file('Hinh');
    		
    		$img_file_extension = $img_file->getClientOriginalExtension();

    		if($img_file_extension != 'png' && $img_file_extension != 'jpg' && $img_file_extension != 'jpeg')
    		{
    			return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Định dạng hình ảnh không hợp lệ (chỉ hỗ trợ các định dạng: png, jpg, jpeg)!');
    		}

    		$img_file_name = $img_file->getClientOriginalName();

    		$random_file_name = Str::random(4).'_'.$img_file_name;
    		while(file_exists('tintuc/'.$random_file_name))
    		{
    			$random_file_name = Str::random(4).'_'.$img_file_name;
    		}
    		echo $random_file_name;

    		$img_file->move('tintuc',$random_file_name);

    		// unlink('tintuc/'.$tintuc->Hinh); // Xóa hình cũ
    		$tintuc->Hinh = $random_file_name; // Lưu lại hình mới
    	}
            // if($request->hasFile('Hinh')){
            //     $file = $request->file('Hinh');
            //     $name = $file->getClientOriginalName();
            //     $Hinh = Str::random(4)."_".$name;
            //     while(file_exists("tintuc/".$Hinh)){
                   
            //         $Hinh = Str::random(4)."_".$name;
            //     }
            //     $file ->move("tintuc",$Hinh);
             
            //     unlink("tintuc/".$tintuc->Hinh);   $tintuc->Hinh = $Hinh;
            // }
          

        $tintuc->save();
        return redirect ('admin/tintuc/sua/'.$id)->with('thongbao','Sửa Thành Công');
    }
    public function getThem(){
        $theloai=TheLoai::all();
        $loatin=LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loatin]);

    }
    
    public function postThem(Request $request){
        $this->validate($request,[
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'MoTa'=>'required',
            'NoiDung'=>'required'
        ],
        [
            'LoaiTin.required'=>'Bạn chưa nhập loại tin',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
           
            'TieuDe.min'=>'Tên tiêu đề phải có độ dài 3->100 ký tự',
            'TieuDe.max'=>'Tên tiêu đề phải có độ dài 3->100 ký tự',
            'TieuDe.unique'=>'Tên đã tồn tại',
            'MoTa.required'=>'Bạn chưa nhập mô tả',
            'NoiDung.required'=>'Bạn chưa nhập nội dung'

        ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe=$request->TieuDe;
        $tintuc->idLoaiTin=$request->LoaiTin;
        $tintuc->MoTa=$request->MoTa;
        if($request->hasFile('Hinh')) // Kiểm tra xem người dùng có upload hình hay không
    	{
    		$img_file = $request->file('Hinh'); // Nhận file hình ảnh người dùng upload lên server
    		
    		$img_file_extension = $img_file->getClientOriginalExtension(); // Lấy đuôi của file hình ảnh

    		if($img_file_extension != 'png' && $img_file_extension != 'jpg' && $img_file_extension != 'jpeg')
    		{
    			return redirect('admin/tintuc/them')->with('thongbao','Định dạng hình ảnh không hợp lệ (chỉ hỗ trợ các định dạng: png, jpg, jpeg)!');
    		}

    		$img_file_name = $img_file->getClientOriginalName(); // Lấy tên của file hình ảnh

    		$random_file_name = Str::random(4).'_'.$img_file_name; // Random tên file để tránh trường hợp trùng với tên hình ảnh khác trong CSDL
    		while(file_exists('tintuc/'.$random_file_name)) // Trường hợp trên gán với 4 ký tự random nhưng vẫn có thể xảy ra trường hợp bị trùng, nên bỏ vào vòng lặp while để kiểm tra với tên tất cả các file hình trong CSDL, nếu bị trùng thì sẽ random 1 tên khác đến khi nào ko trùng nữa thì thoát vòng lặp
    		{
    			$random_file_name =Str::random(4).'_'.$img_file_name;
    		}
    		echo $random_file_name;

    		$img_file->move('tintuc',$random_file_name); // file hình được upload sẽ chuyển vào thư mục có đường dẫn như trên
    		$tintuc->Hinh = $random_file_name;
    	}
    	else
    		$tintuc->Hinh = ''; // Nếu người dùng không upload hình thì sẽ gán đường dẫn là rỗng
        $tintuc->NoiDung=$request->NoiDung;
        $tintuc->SoLuotXem=0;
        $tintuc->NoiBat=$request->NoiBat;
        
            // if($request->hasFile('Hinh')){
            //     $file = $request->file('Hinh');
            //     $name = $file->getClientOriginalName();
            //     $Hinh = Str::random(4)."_".$name;
            //     while(file_exists("tintuc/".$Hinh)){
            //         $Hinh = Str::random(4)."_".$name;
            //     }
            //     $file->move("tintuc",$Hinh);
            //     $tintuc->Hinh = $Hinh;
            // }
            // else{
            //     $tintuc->Hinh="";
            // }

        $tintuc->save();
        return redirect ('admin/tintuc/them')->with('thongbao','Thêm Thành Công');
    }
    public function getXoa($id){
        $tintuc= TinTuc::find($id);
        $comment = Comment::where('idTinTuc',$id);
        $comment->delete();
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
