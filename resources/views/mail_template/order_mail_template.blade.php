<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; margin: 0 auto;">
        <tr>
            <td align="center" bgcolor="#00aaff" style="padding: 20px;">
                <h1 style="color: #ffffff;">Order Confirmation</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <h2>Thank you for your order, {{ $orders->customer_name }} !</h2>
                <p>Your order has been successfully placed and is being processed.</p>
                <h3>Customer Details</h3>
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 0;"><strong>Name: </strong>{{ $orders->customer_name }}</td>
                        <td style="padding: 10px 0;"><strong>Email: </strong>{{ $orders->customer_email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0;"><strong>Phone: </strong>{{ $orders->customer_phone }}</td>
                        <td style="padding: 10px 0;"><strong>Payment Type: </strong>{{ $orders->payment_type }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0;"><strong>Order Date: </strong>{{ $orders->created_at->format('Y-m-d') }}</td>
                        <td style="padding: 10px 0;"><strong>Order Time: </strong>{{ $orders->created_at->format('H:i:s') }}</td>
                    </tr>
                </table>
                <h3>Order Details</h3>
                <table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($orderItems) && !empty($orderItems))
                            @foreach($orderItems as $key => $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->quantity }}</td>
                                    <td>&#8369;{{ $value->price }}</td>
                                    <td>&#8369;{{ $value->total }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>               
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Total Amount:</strong></td>
                        <td><strong>&#8369;{{ isset($totalPrice) ? $totalPrice : 0.00 }}</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" bgcolor="#f4f4f4" style="padding: 20px;">
                <p>If you have any questions about your order, feel free to <a href="mailto:">contact us</a>.</p>
            </td>
        </tr>
    </table>
</body>
</html>
