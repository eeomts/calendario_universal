
<br><br><br><br>
<div class="form-container">

    <form id="frm-cadastro" action="ajax/save-cadastro" method="POST" >

        <div class="">
            <h1 class = "form-title">Criar Conta</h1><br>
            <p>Preencha os dados abaixo para continuar</p><br>

        </div>

        <div class="name-group">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text"
                       id="nome"
                       name="nome"
                       placeholder="Seu nome"
                       required
                       onkeyup="mascara(this, mnome);">
            </div>

            <div class="form-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text"
                       id="sobrenome"
                       name="sobrenome"
                       placeholder="Seu sobrenome"
                       required
                       onkeyup="mascara(this, mnome);">
            </div>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email"
                   id="email"
                   name="email"
                   placeholder="seuemail@exemplo.com"
                   required>
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text"
                   id="cpf"
                   name="cpf"
                   placeholder="000.000.000-00"
                   required
                   onkeyup="mascara(this, mcpf);">
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password"
                   id="senha"
                   name="senha"
                   placeholder="Crie uma senha"
                   required>

            <div class="password-strength" id="strengthBar">
                <div class="password-strength-bar"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="confirmPassword">Confirmar Senha</label>
            <input type="password"
                   id="confirmPassword"
                   name="confirmPassword"
                   placeholder="Repita a senha"
                   required>
        </div>

        <div class="checkbox-group">
            <input class="form-check-input" type="checkbox" id="terms" name="terms">
            <label class="form-check-label" for="terms">
                Eu aceito os <a href="#">termos de uso</a> e a <a href="#">política de privacidade</a>
            </label>
        </div>

        <button type="submit" class="btn-primary-custom">Cadastrar</button>

    </form>
</div>

<br><br><br>