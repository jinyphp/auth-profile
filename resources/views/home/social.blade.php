<x-www-app>
    <x-www-layout>
        <x-www-main>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile Settings</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- 왼쪽 메뉴 -->
                <div class="col-md-4 col-xl-3">
                    @includeIf('jiny-profile::home.sidemenu')
                </div>

                <div class="col-md-8 col-xl-9">
                    <!-- contents -->



                    <!--  -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">
                                소셜미디어
                            </h4>
                            <p class="text-muted font-14">
                                개인별 소설미디어 링크를 입력합니다.
                            </p>
                            @livewire('profile-social')
                        </div>
                    </div>
                    <!-- -->


                </div>

            </div> <!-- end of row -->

        </x-www-main>
    </x-www-layout>
</x-www-app>
