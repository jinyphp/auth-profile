<?php
namespace Jiny\Profile\Http\Controllers\Account;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * ID에 대한 아바타 이미지를 반환 합니다.
 */
class AccountAvataID extends Controller
{
    public function index(Request $request)
    {
        $path = storage_path('app').DIRECTORY_SEPARATOR;

        $user_id = $this->getUserId($request);
        if($user_id) {

            $profile = $this->getProfile($user_id);
            if($profile) {

                $extension = $this->getExt($profile->image);
                $content_Type = $this->extType($extension);

                if(file_exists($path.$profile->image)) {
                    $body = file_get_contents($path.$profile->image);
                    return response($body)
                        ->header('Content-type',$content_Type);
                }
            }
        }


        // 프로파일 미설정
        // 정보가 없는 경우 기본값 출력
        return $this->blankImage();

    }

    private function getProfile($user_id)
    {
        $tablename = "account_avata";
        return DB::table($tablename)
            ->where('user_id',$user_id)
            ->first();
    }

    private function getExt($file)
    {
        return substr($file, strrpos($file, '.')+1);
    }

    private function extType($extension)
    {
        if($extension == "gif") {
            return "image/gif";
        } else if($extension == "jpg") {
            return "image/jpeg";
        } else if($extension == "png") {
            return "image/png";
        } else if($extension == "svg") {
            return "image/svg+xml";
        }

    }

    private function blankImage()
    {
        $packageReourcePath =__DIR__."/../../../../resources/images";
        $packageReourcePath .= "/blank-profile.png";

        if(file_exists($packageReourcePath)) {
            $body = file_get_contents($packageReourcePath);

            $extension = $this->getExt($packageReourcePath);
            $content_Type = $this->extType($extension);

            return response($body)
                ->header('Content-type',$content_Type);
        }

        return "프로파일 정보가 없습니다.";
    }

    private function getUserId($request)
    {
        if(isset($request->id)) {
            // 사용자 지정 id
            return $request->id;
        } else {
            // 현재 로그인된 id
            return Auth::user()->id;
        }

        return false;
    }

}
