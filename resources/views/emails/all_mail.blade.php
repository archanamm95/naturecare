<html lang="en"><head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title> {{$company_name}} - </title>

    </head>

    <body>

         <table width="600" bgcolor="#f9f9f9" style="font-family: MyriadPro-Regular, 'Myriad Pro Regular', MyriadPro, 'Myriad Pro', Helvetica, Arial, sans-serif;">    <tbody><tr>

        <td align="center" style="padding: 5px 15px 0px 15px;" class="section-padding">

            <table border="0" cellpadding="0" align="center" cellspacing="0" class="responsive-table">

            <tbody><tr><td align="left" valign="top" style="padding:10px;font:9px/15px Arial;text-align:justify;color:#a6a6a6">You are receiving this mail as a registered member of  cloudmlmsoftware  Please add <a href="mailto:info@cloudmlmsoftware.com" style="text-decoration:underline;color:#a6a6a6" target="_blank">{{$email->from_email}}</a> to your address book to ensure delivery into your inbox.</td></tr>

            </tbody></table>

        </td>

    </tr>

</tbody></table>

        <table width="600" bgcolor="#f9f9f9" style="font-family: MyriadPro-Regular, 'Myriad Pro Regular', MyriadPro, 'Myriad Pro', Helvetica, Arial, sans-serif;">

            <thead>

                <tr>

                <td style="padding:22px 30px 18px 30px; border-bottom:2px solid #1e2064"><img src="{{ url('files/images/icons/logo.png') }}" height="60" alt="cloudmlmsoftware"></td>    


                </tr>

            </thead>

            <tbody>

                <tr>

    <p>{{$content}}</p>
     


Cheerfully yours, <br>
The cloudmlmsoftware Coach

</p>

                    </td>

                </tr>

                <tr>

                
                </tr>
            </tbody>

            <tfoot bgcolor="#c1c1c1">

                <tr>

                    <td style="padding:20px 30px"><p style="font-size:12px; color:#000000;">Copyright © {{Date('Y')}} {{$company_name}}. All Rights Reserved</p></td>

                </tr>

            </tfoot>

        </table>

</body>
  </html>