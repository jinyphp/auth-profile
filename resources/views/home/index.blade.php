<x-app>
    <x-bootstrap>
        <main class="content">

            <div class="container p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                                    <li class="breadcrumb-item active">Calendar</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Profile Settings</h4>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container p-0">

                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        @includeIf('jiny-profile::home.sidemenu')

                    </div>

                    <div class="col-md-8 col-xl-9">
                        <!-- 로그인 회원정보 -->
                        @includeIf('jiny-profile::home.status')

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

                        <!--  -->
                        <x-profile-form-picture>

                        </x-profile-form-picture>


                        <x-profile-form-infomation>

                        </x-profile-form-infomation>

                        <x-profile-form-address>

                        </x-profile-form-address>




                        {{-- 회원 삭제 --}}
                        {{-- <x-profile-delete-user>
                            <div class="max-w-xl text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                            </div>
                            @livewire('profile.delete-user-form')
                        </x-profile-delete-user> --}}

                        {{-- <x-profile-update-infomation>
                            @livewire('profile.update-profile-information-form')
                        </x-profile-update-infomation> --}}

                        {{-- <x-profile-update-password>
                            @livewire('profile.update-password-form')
                        </x-profile-update-password> --}}


                    </div>
                </div>

            </div>
        </main>
    </x-bootstrap>
</x-app>


