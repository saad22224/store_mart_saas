<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #000;
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .header p {
            margin-top: 10px;
            opacity: 0.8;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .order-info {
            background: #fdfdfd;
            border: 1px solid #eeeeee;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .order-info h3 {
            margin-top: 0;
            color: #000;
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .detail-label {
            color: #777;
            font-weight: 500;
        }
        .detail-value {
            color: #333;
            font-weight: 600;
        }
        .message-box {
            font-size: 16px;
            color: #444;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            background-color: #000;
            color: #ffffff !important;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 700;
            display: inline-block;
            transition: transform 0.2s;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
        .social-links {
            margin-bottom: 15px;
        }
        .social-links a {
            margin: 0 10px;
            text-decoration: none;
            color: #555;
            font-weight: bold;
        }
        .matjarhub-branding {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmed</h1>
            <p>Thank you for shopping with {{ $order_data['vendorname'] }}</p>
        </div>
        <div class="content">
            <div class="message-box">
                Hi <strong>{{ $order_data['customername'] }}</strong>,<br><br>
                We're excited to let you know that your order has been successfully placed. Our team is now working to prepare it for you!
            </div>

            <div class="order-info">
                <h3>Order Summary</h3>
                <div class="detail-row">
                    <span class="detail-label">Order Number:</span>
                    <span class="detail-value">#{{ $order_data['ordernumber'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date:</span>
                    <span class="detail-value">{{ $order_data['date'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Time:</span>
                    <span class="detail-value">{{ $order_data['time'] }}</span>
                </div>
                <div class="detail-row" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee;">
                    <span class="detail-label" style="font-size: 16px; color: #000;">Total Amount:</span>
                    <span class="detail-value" style="font-size: 18px; color: #000;">{{ $order_data['grandtotal'] }}</span>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ $order_data['track_order_url'] }}" class="btn">Track Your Order</a>
            </div>

            <div class="matjarhub-branding" style="text-align: center; margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px;">
                <p style="margin-bottom: 5px; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Powered by</p>
                <span style="font-size: 20px; font-weight: 800; color: #000; letter-spacing: -0.5px;">matjar<span style="color: #555;">hub</span></span>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ $order_data['vendorname'] }}. All rights reserved.<br>
            If you have any questions, feel free to contact us.
        </div>
    </div>
</body>
</html>
