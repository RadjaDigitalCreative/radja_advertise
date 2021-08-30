<div class="sidebar" data-color="red">
    <div class="logo">
        <a href="{{url('/admin/')}}" class="simple-text logo-mini">
            <img style="border-radius: 50%;" src="{{asset('logo_depan.png')}}">
        </a>
        <a href="{{url('/admin/')}}" class="simple-text logo-normal">
            Radja Sistem
        </a>
    </div>
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            @if(auth()->user()->image == NULL)
                <img style="border-radius: 50%;" src="{{asset('/images/radja.png')}}" alt="...">
            @else
                <img style="border-radius: 50%;" src="{{ URL::to('/') }}/images/{{ auth()->user()->image }}" alt="...">
            @endif
        </a>
        <a data-toggle="collapse" href="#collapseExample" class="simple-text logo-normal collapsed">
            {{auth()->user()->name}}
        </a>
        <div class="user">
            <div class="info">
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="{{url('/admin/profile/')}}">
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/admin/profile/edit')}}">
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        @foreach($bayar as $row)
            @if($row->dibayar >= now() && auth()->user()->id == $row->user_id)
                <ul class="nav">

                    <li class="">
                        <a href="{{url('/admin/prospek/jenis_penawaran')}}">
                            <i class="now-ui-icons design_vector"></i>
                            <p>Jenis Penawaran</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('/admin/prospek/surat_penawaran')}}">
                            <i class="now-ui-icons design_vector"></i>
                            <p>Surat Penawaran</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('/admin/prospek/project')}}">
                            <i class="now-ui-icons design_vector"></i>
                            <p>Prospek Project</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('/admin/prospek/deal')}}">
                            <i class="now-ui-icons design_vector"></i>
                            <p>Prospek Deal</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('/admin/prospek/pengajuan/budget')}}">
                            <i class="now-ui-icons design_vector"></i>
                            <p>Pengajuan Budget</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('/admin/prospek/kas')}}">
                            <i class="now-ui-icons design_vector"></i>
                            <p>Kas</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('/admin/prospek/kas/total')}}">
                            <i class="now-ui-icons design_vector"></i>
                            <p>Kas Keseluruhan</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('logout')}}">
                            <i class="now-ui-icons business_bank"></i>
                            <p>logout</p>
                        </a>
                    </li>

                </ul>



    <?php
    redirect('/admin/user');
    ?>
    @endif
    @endforeach
</div>
</div>

