<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Tema Minimalista</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            border: 1px solid #e5e7eb;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo h1 {
            color: #1f2937;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .logo p {
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            color: #1f2937;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #003D7C;
            box-shadow: 0 0 0 3px rgba(0, 61, 124, 0.1);
        }

        input::placeholder {
            color: #9ca3af;
        }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #f3f4f6;
            border-radius: 2px;
            overflow: hidden;
            display: none;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak {
            width: 33%;
            background: #ef4444;
        }

        .strength-medium {
            width: 66%;
            background: #f59e0b;
        }

        .strength-strong {
            width: 100%;
            background: #10b981;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #003D7C;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn:hover {
            background: #002a54;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 61, 124, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #9ca3af;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 15px;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            color: #374151;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 500;
        }

        .social-btn:hover {
            border-color: #003D7C;
            background: #f8fafc;
        }

        .login-link {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .login-link a {
            color: #003D7C;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #002a54;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin-top: 3px;
            accent-color: #003D7C;
        }

        .checkbox-group label {
            margin: 0;
            cursor: pointer;
            font-size: 13px;
            line-height: 1.5;
            color: #6b7280;
        }

        .checkbox-group label a {
            color: #003D7C;
            text-decoration: none;
        }

        .checkbox-group label a:hover {
            color: #002a54;
        }

        .name-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <h1>Criar Conta</h1>
        <p>Preencha os dados para se cadastrar</p>
    </div>
    <form id="frm-cadastro" method="POST" action="ajax/save-cadastro.php">
        <div class="name-group">
            <div class="form-group">
                <label for="firstName">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome">
            </div>

            <div class="form-group">
                <label for="lastName">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome">
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="user@ufu.br">
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Sua senha">
        </div>

        <div class="form-group">
            <label for="confirmPassword">Confirmar Senha</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Digite a senha novamente">
        </div>


        <div class="checkbox-group">
            <input type="checkbox" id="terms">
            <label for="terms">Eu aceito os <a href="#">termos de uso</a> e a <a href="#">política de
                    privacidade</a></label>
        </div>

        <button class="btn" type="submit" onclick="return validarSenha()">Cadastrar</button>
        <p id="erroSenha" style="color:red; margin-top:10px;"></p>
    </form>
    <div class="login-link">
        Já tem uma conta? <a href="login.inc.php">Faça login</a>
    </div>

</div>

</body>
</html>