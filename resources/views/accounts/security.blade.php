<x-app>
    <x-bootstrap>

        <main class="content">

            <div class="container p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Profile</h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container p-0">

                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        @includeIf('jiny-profile::accounts.sidemenu')

                    </div>

                    <div class="col-md-8 col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">
                                    {{ __('패스워드 재설정') }}
                                </h4>
                                <p class="text-muted font-14">
                                    {{ __('비밀번로를 변경할 수 있습니다.') }}
                                </p>
                            </div>
                        </div>

                        {{-- 브라우저 세션--}}
                        <x-profile-browser_sessions>
                            <div class="text-muted font-14">
                                {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
                            </div>
                            @livewire('profile.logout-other-browser-sessions-form')
                        </x-profile-browser_sessions>

                        {{-- 2FA 인증--}}
                        <x-profile-two-factor-authentication>
                            @livewire('profile.two-factor-authentication-form')
                        </x-profile-two-factor-authentication>





                    </div>
                </div>

            </div>
        </main>
    </x-bootstrap>
</x-app>


