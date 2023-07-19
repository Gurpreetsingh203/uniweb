<!doctype html>
<html lang="en-US">>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="description" content="New account email template. Bootstrap 4 Admin HTML Theme is a material design and bootstrap 4 based responsive dashboard template by propeller created mainly for admin and backend applications.">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }

        .content-wrapper {
            background-image: url('{{ asset("admin/images/bg-login.webp") }}') !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed !important;
            background-size: 100% 100% !important;
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="background-image: url('{{ asset('admin/images/bg-login.webp') }}') !important;background-repeat: no-repeat !important;background-attachment: fixed !important;background-size: 100% 100% !important; margin: 0px; background-color: #f2f8f9;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="" style="@import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500); font-family: 'Roboto', sans-serif , Arial, Helvetica, sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f8f9; max-width:670px; margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <a href="#" title="{{ env('APP_NAME') }}"><img width="" src="{{ asset('admin/images/logo.svg') }}" title="{{ env('APP_NAME') }}" alt="{{ env('APP_NAME') }}"></a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:40px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px; background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 1px 3px 0 rgba(0, 0, 0, 0.12);-moz-box-shadow:0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 1px 3px 0 rgba(0, 0, 0, 0.12);box-shadow:0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 1px 3px 0 rgba(0, 0, 0, 0.12)">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 15px;">
                                        <h1 style="color:#3075BA; font-weight:400; margin:0;font-size:32px;">Get started</h1>
                                        <p style="font-size:15px; color:#171f23de; margin:8px 0 0; line-height:24px;">Your account has been created on the {{ env('APP_NAME') }}. <br>Below are your system generated credentials, <br><strong>please change the password immediately after login</strong>.</p>
                                        <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:rgba(23,31,35,.87); font-size:18px;line-height:20px; margin:0; font-weight: 500;">
                                            <strong style="display: block;font-size: 13px; margin: 0 0 4px; color:rgba(23,31,35,.64); font-weight:normal;">Email </strong>{{ $details['email'] }}
                                            <strong style="display: block; font-size: 13px; margin: 24px 0 4px 0; font-weight:normal; color:rgba(23,31,35,.64);">Password</strong>{{ $details['password'] }}
                                        </p>

                                        <a href="{{ route('admin.login') }}" style="background:#3075BA;text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 12px;display:inline-block;border-radius:3px;">Login to your Account</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:#455056bd; line-height:18px; margin:0 0 0;">We've sent this to you as part of our Welcome to <strong>{{ env('APP_NAME') }}</strong>.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>
