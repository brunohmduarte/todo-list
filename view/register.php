
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Sistema de lista de afazeres">
        <meta name="author" content="Bruno Duarte">
        
        <title>To-Do List | Cadastre-se</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="{{base_url}}/view/assets/css/signin.css" rel="stylesheet">
        <link href="{{base_url}}/view/assets/css/register.css" rel="stylesheet">
    </head>
    <body>
        <div id="site">
            <form class="form-signin">
                <h1 class="h3 mb-4 font-weight-normal text-center">Cadastre-se</h1>
    
                <label for="name" class="sr-only">Nome</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nome" required autofocus autocomplete="off">
                
                <label for="address_email" class="sr-only">E-mail</label>
                <input type="email" id="address_email" name="address_email" class="form-control" placeholder="E-mail" required autocomplete="off">
                
                <label for="password" class="sr-only">Senha</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required autocomplete="off">
                
                <label for="confirm_password" class="sr-only">Confirmação de senha</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirmação de senha" required autocomplete="off">
                
                <div class="text-left mt-1">
                    <small class="mr-2">Eu já possuo um cadastro. <a href="login">Entrar</a></small>
                </div>

                <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Cadastrar</button>            
            </form>
        </div>

        <!-- Script -->
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6"></script>
        <script src="{{base_url}}/view/assets/js/signin.js"></script>
    </body>
</html>
