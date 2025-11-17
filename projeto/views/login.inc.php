<br><br><br><br><br><br>
<div class="form-container">
    <form id="frm-login" name="frm-login" action="ajax/post-login.php" method="post">

        <h2 class="form-title">Entrar</h2>
        <p class="form-subtitle">Acesse sua conta</p>

        <!-- Usuário -->
        <div class="form-group">
            <label for="login_usuario">Usuário</label>
            <input type="text"
                   id="login_usuario"
                   name="usuario"
                   placeholder="Seu nome de usuário"
                   required>
        </div>

        <!-- Senha -->
        <div class="form-group">
            <label for="login_senha">Senha</label>
            <input type="password"
                   id="login_senha"
                   name="senha"
                   placeholder="Digite sua senha"
                   required>
        </div>

        <!-- Lembrar -->
        <div class="checkbox-group">
            <input type="checkbox" id="lembrar" name="lembrar" value="1">
            <label for="lembrar">Manter conectado</label>
        </div>

        <button type="submit" class="btn-primary-custom">Entrar</button>

        <p class="login-link">
            Ainda não tem conta? <a href="cadastro">Criar agora</a>
        </p>

    </form>
</div>