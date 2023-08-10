<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Contact Us</title>
</head>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" bgcolor="#007BFF" style="padding: 40px 0;">
                            <h1 style="color: white;">Contact Us</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <p><strong>Name:</strong> {{$data['name']}}</p>
                            <p><strong>Email:</strong> {{$data['email']}}</p>
                            <p><strong>Message:</strong> {{$data['message']}}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
