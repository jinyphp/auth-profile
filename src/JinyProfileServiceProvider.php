<?php
namespace Jiny\Profile;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
//use Laravel\Fortify\Fortify;

use Illuminate\Routing\Router;

class JinyProfileServiceProvider extends ServiceProvider
{
    private $package = "jiny-profile";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../databases/migrations');

        // 설정파일 복사
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/auth/profile.php'),
        ]);


        // 컴포넌트
        // 사용자 아바타 이미지 출력
        Blade::component(\Jiny\Profile\View\UserAvata::class, 'user-avata');



        // account layout
        Blade::component($this->package.'::layouts.'.'master', 'account-layout');
        Blade::component($this->package.'::partials.'.'sidebar', 'account-sidebar');

        // 사용자 프로파일 컴포넌트
        Blade::component($this->package.'::components.'.'profile.form_picture', 'profile-form-picture');
        Blade::component($this->package.'::components.'.'profile.form_infomation', 'profile-form-infomation');
        Blade::component($this->package.'::components.'.'profile.form_address', 'profile-form-address');


        Blade::component($this->package.'::components.'.'browser_sessions', 'profile-browser_sessions');
        Blade::component($this->package.'::components.'.'two-factor-authentication', 'profile-two-factor-authentication');
        Blade::component($this->package.'::components.'.'confirms-password', 'confirms-password');
    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {


            ## 로그인 상태표시
            Livewire::component('profile-status',
                \Jiny\Profile\Http\Livewire\ProfileStatus::class);



            

            Livewire::component('profile-account',
                \Jiny\Profile\Http\Livewire\ProfileAccount::class);




        });

    }

}
