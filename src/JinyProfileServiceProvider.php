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
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../databases/migrations');

        // 설정파일 복사
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/auth/profile.php'),
        ]);


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

            // 아바타의 이미지를 변경합니다.
            Livewire::component('avata-image', \Jiny\Profile\Http\Livewire\AvataImage::class);
            Livewire::component('avata-update', \Jiny\Profile\Http\Livewire\AvataUpdate::class);

            // 패스워드 변경
            Livewire::component('profile-password', \Jiny\Profile\Http\Livewire\ProfilePassword::class);
            Livewire::component('profile-account', \Jiny\Profile\Http\Livewire\ProfileAccount::class);
            Livewire::component('profile-address', \Jiny\Profile\Http\Livewire\ProfileAddress::class);
            Livewire::component('profile-phone', \Jiny\Profile\Http\Livewire\ProfilePhone::class);
            Livewire::component('profile-email', \Jiny\Profile\Http\Livewire\ProfileEmail::class);
            Livewire::component('profile-social', \Jiny\Profile\Http\Livewire\ProfileSocial::class);

            Livewire::component('profile-browser-sessions',
                \Jiny\Profile\Http\Livewire\LogoutOtherBrowserSessionsForm::class);

            Livewire::component('profile.two-factor-authentication-form',
                \Jiny\Profile\Http\Livewire\TwoFactorAuthenticationForm::class);


            // 회원탈퇴
            Livewire::component('auth-out', \Jiny\Profile\Http\Livewire\AuthOut::class);

        });

    }

}
