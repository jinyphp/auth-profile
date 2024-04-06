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
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // 설정파일 복사
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/profile/setting.php'),
        ]);


        // account layout
        Blade::component($this->package.'::layouts.'.'master', 'account-layout');
        Blade::component($this->package.'::partials.'.'sidebar', 'account-sidebar');

        // 사용자 프로파일 컴포넌트
        Blade::component($this->package.'::components.'.'profile.form_picture', 'profile-form-picture');
        Blade::component($this->package.'::components.'.'profile.form_infomation', 'profile-form-infomation');
        Blade::component($this->package.'::components.'.'profile.form_address', 'profile-form-address');


    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {


            Livewire::component('account-avata', \Jiny\Profile\Http\Livewire\AvataLivewire::class);
            Livewire::component('account-profile', \Jiny\Profile\Http\Livewire\AccountProfile::class);
            Livewire::component('account-address', \Jiny\Profile\Http\Livewire\AccountAddress::class);
            Livewire::component('account-email', \Jiny\Profile\Http\Livewire\AccountEmail::class);

            Livewire::component('account-social', \Jiny\Profile\Http\Livewire\AccountSocial::class);

        });

    }

}
