<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة تواصل جديدة</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #0D8D6B 0%, #15AC82 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .info-row {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #0D8D6B;
            margin-bottom: 5px;
            display: block;
        }
        .value {
            color: #333;
            font-size: 16px;
        }
        .message-box {
            background-color: #f9f9f9;
            border-right: 4px solid #0D8D6B;
            padding: 15px;
            margin-top: 10px;
            border-radius: 4px;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>رسالة تواصل جديدة</h1>
            <p>من صفحة Landing Page 2</p>
        </div>
        
        <div class="content">
            <div class="info-row">
                <span class="label">الاسم الكامل:</span>
                <span class="value"><?php echo e($data['name']); ?></span>
            </div>
            
            <div class="info-row">
                <span class="label">البريد الإلكتروني:</span>
                <span class="value"><?php echo e($data['email']); ?></span>
            </div>
            
            <div class="info-row">
                <span class="label">نوع الاستفسار:</span>
                <span class="value"><?php echo e($data['inquiry_type']); ?></span>
            </div>
            
            <div class="info-row">
                <span class="label">الرسالة:</span>
                <div class="message-box">
                    <?php echo e($data['message']); ?>

                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>تم إرسال هذه الرسالة من نموذج التواصل في Matjar Hub</p>
            <p><?php echo e(date('Y-m-d H:i:s')); ?></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/emails/landing2_contact.blade.php ENDPATH**/ ?>