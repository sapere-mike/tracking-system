@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php $id = Auth::id(); ?>

<script>

    var id = "<?php echo "$id" ?>";
    console.log(id);

    var os="Unknown OS";
        if (navigator.appVersion.indexOf("Win")!=-1) os="Windows";
        if (navigator.appVersion.indexOf("Mac")!=-1) os="MacOS";
        if (navigator.appVersion.indexOf("X11")!=-1) os="UNIX";
        if (navigator.appVersion.indexOf("Linux")!=-1) os="Linux";

    console.log(os);

    var browser = navigator.appCodeName;
    console.log(browser);

    var device = 'Desktop';
        if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(navigator.userAgent)) 
            device = "Tablet";
        if (/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(navigator.userAgent))
            device = "Mobile";
    console.log(device);
    
    var userinfo = function () {
        var tmp = null;
        $.ajax({
            'async': false,
            'global': false,
            'dataType': 'json',
            'url': "https://ipinfo.io",
            'success': function (data) {
                tmp = data;
            }
        });
        return tmp;
    }();

    var geolocation = userinfo.country;
    var ip = userinfo.ip;

    console.log(ip);
    console.log(geolocation);

    var storedIP = '';

    $(document).ready(function(){
        
       $.ajax({
            type: 'GET',
            url: '/get-info',
            dataType: 'json',
            async: false,
            success: function (data) {
                storedIP = data.tracker[0]
            }
        });

        console.log(storedIP.ip);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
       
        if(storedIP.ip != ip || storedIP.ip == ip || storedIP == '') 
        {
            Cookies.set("USER_ID", id);
            Cookies.set("IP", ip);

            if(stored.ip == ip || storedIP == '')
            {
                $.ajax({
                    url:"",
                    type:"POST",
                    data: {
                        id:id,
                        ip:ip,
                        os:os,
                        browser:browser,
                        device:device,
                        geolocation:geolocation
                    }
                });
            }
        }
        else {

            $.ajax({
                url:"",
                type:"POST",
                data: {
                    id:id,
                    ip:ip,
                    os:os,
                    browser:browser,
                    device:device,
                    geolocation:geolocation
                }
            });
        }
        
    });
   
</script>

@endsection
