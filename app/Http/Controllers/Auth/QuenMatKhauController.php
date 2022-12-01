<?php 
  
namespace App\Http\Controllers\Auth; 
  
use App\Http\Controllers\Controller;
use App\Http\Requests\QuenMatKhauRequest;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
  
class QuenMatKhauController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.quen-mat-khau');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(QuenMatKhauRequest $request)
      {
          $token = Str::random(60);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('sendmail.form-email', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Lấy Lại Mật Khẩu');
          });
  
          return back()->with('message', 'Chúng tôi đã gửi tới email của bạn hãy truy cập và đặt lại mật khẩu của bạn!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('auth.doi-mat-khau', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(QuenMatKhauRequest $request)
      {
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Mã Token không hợp lệ!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect()->route('client_dang_nhap')->with('message', 'Mật khẩu của bạn đã được thay đổi!');
      }
}