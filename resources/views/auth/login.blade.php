<!DOCTYPE html>
<html>
<head>
    <title>Login - Ethiopian Restaurant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #dc2626, #991b1b);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        h1 {
            text-align: center;
            color: #dc2626;
            margin-bottom: 30px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover {
            background: #991b1b;
        }
        .error {
            background: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
        .demo {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>🇪🇹 Ethiopian Restaurant</h1>
        <p style="text-align: center; color: #666; margin-bottom: 20px;">Staff Login Only</p>
        
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        
        <form method="POST" action="/login">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required autofocus>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit">Sign In</button>
        </form>
        
        <div class="demo">
            <strong>Demo Accounts:</strong><br>
            👑 Admin: admin@admin.com / password<br>
            💰 Cashier: cashier@restaurant.com / cashier123
        </div>
        
        <div class="demo" style="margin-top: 10px;">
            <p style="font-size: 11px;">📍 POS access: <a href="/pos" style="color: #dc2626;">Click here for public POS</a></p>
        </div>
    </div>
</body>
</html>