<!DOCTYPE html>
<html>
<body>

<div style="background:#ecf2fc;padding:20px">
    <div style="margin:0 auto;padding:20px;background:white; color: #999999;">
        <div style="min-height:31px">

            <div style="float:left">
                {{--<img width="150" height="29" src=" " class="CToWUd">--}}
                @if(file_exists('./uploads/buzzrefer_logo.png'))
                    <img src="{{ asset('uploads/buzzrefer_logo.png') }}" height="30" />
                @else
                    <h2> {{ Helpers::get_option('company_name') }}</h2>
                @endif
            </div>

            <h2 style="float:right"> {{ ucfirst($shop->name) }} </h2>

        </div>
        <div style="clear:both"></div>

        <div>
            <hr style="border-color: #EEEEEE; border-style: solid;">
            <div>Hi,<br>

                <br />

                {!! $description !!}

                <hr style="border-color: #EEEEEE; border-style: solid;">

                <div style="text-align:center;">
                    <a href="{{ route('join_referral_shop', $shop->slug) }}" style="background-color:#EB7035;border:1px solid #EB7035;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;" >Join with us &rarr;</a>
                </div>

                <br>
                Questions? Just reply to this e-mail.
                <p>Best Regards from {{ ucfirst($shop->name) }},</p>

                <p>buzreffer</p>

                <hr style="border-color: #EEEEEE; border-style: solid;">
            </div>
            <div>
                <table width="100%" style="margin:0px auto 0 auto">
                    <tbody>
                    <tr>
                        <td style="text-align:center;padding-top:14px">
                            <h1 style="text-align:center">Great support</h1>

                            <p style="white-space:nowrap;line-height:140%;padding-left:7px">
                                Questions? Buzreffer.com<br>
                                <a target="_blank" href="mailto:support@buzreffer.com">support@buzreffer.com</a>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html> 