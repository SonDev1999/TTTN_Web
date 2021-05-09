<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);

    }
    public function getSua($id){
        $user=User::find($id);   
        
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|min:3',       
        ],
        [
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phảo ít nhất 3 ký tự',

        ]);
        $user = User::find($id);
        $user->name=$request->name;
        if($request->changePassword =="on"){

            $this->validate($request,[
              
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password'
            ],
            [
               
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu quá ngắn',
                'password.max'=>'Mật khẩu quá dài',
                'passwordAgain.required'=>'Nhập lại mật khẩu',
                'passwordAgain.same'=>'Chưa khớp mật khẩu'
    
            ]);
        $user->password=bcrypt($request->password);
        }

        $user->save();
        return redirect ('admin/user/sua/'.$id)->with('thongbao','Sửa Thành Công');
    }
    public function getThem(){
       
        return view('admin.user.them');

    }
    
    public function postThem(Request $request){
        $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:32',
            'passwordAgain'=>'required|same:password'
        ],
        [
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phảo ít nhất 3 ký tự',
           
            'email.required'=>'Bạn chưa nhập emial',
            'email.email'=>'Sai định dạng',
            
            'email.required'=>'Email đã tồn tại',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu quá ngắn',
            'password.max'=>'Mật khẩu quá dài',
            'passwordAgain.required'=>'Nhập lại mật khẩu',
            'passwordAgain.same'=>'Chưa khớp mật khẩu'

        ]);
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->quyen=$request->quyen;
    

        $user->save();
        return redirect ('admin/user/them')->with('thongbao','Thêm Thành Công');
    }
    public function getXoa($id)
    {
      $user = User::find($id);
      $comment = Comment::where('idUser',$id); //Tìm các comment của user
      $comment->delete(); //Xóa các comment của user
      $user->delete(); //Xóa user
      return redirect('admin/user/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }




    public function getdangnhapAdmin(){
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request){
        $this->validate($request,[
            
         'email'=>'required',
            'password'=>'required|min:3|max:32',    
        ],
        [          
            'email.required'=>'Bạn chưa nhập emial',      
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu quá ngắn',
            'password.max'=>'Mật khẩu quá dài',
        ]);
        if(Auth::attempt(['email'=>$request->email,'password' =>$request->password])){
            return redirect('admin/theloai/danhsach');
        }else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }
    public function getdangxuatAdmin(){
        Auth::logout();
        return redirect ('admin/dangnhap');
    }
}
