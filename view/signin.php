<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Sistema de lista de afazeres">
        <meta name="author" content="Bruno Duarte">
        
        <title>To-Do List | Entrar</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{base_url}}/view/assets/css/signin.css" rel="stylesheet">
    </head>
    <body>
        <div id="site">
            <form class="form-signin" id="frmSingIn" name="frmSingIn" method="post" v-on:submit.prevent>
                <h1 class="h3 mb-4 font-weight-normal text-center">Login</h1>
    
                <label for="address_email" class="sr-only">E-mail</label>
                <input type="email" id="address_email" name="address_email" value="bruno@gmail.com" class="form-control" placeholder="E-mail" required autofocus autocomplete="off">
                
                <label for="password" class="sr-only">Senha</label>
                <input type="password" id="password" name="password" value="123" class="form-control" placeholder="Senha" required autocomplete="off">
                
                <div class="text-left">
                    <small class="mr-2">Você é novo por aqui? <a href="register">Cadastre-se</a></small>
                </div>

                <button type="submit" class="btn btn-lg btn-primary btn-block font-weight-bold mt-4 shadow" v-on:click="userAuthentication($event)">
                    <i class="fa fa-paper-plane mr-1" aria-hidden="true"></i> Entrar
                </button>            
            </form>
        </div>

        <!-- Script -->
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6"></script>
        <script>
            const url_base = "http://localhost/teste/to-do-list/"

            let app = new Vue({
                el: "#site",
                data: {},
                methods: {
                    userAuthentication(event) {

                        let form = new FormData(event.target.form)
                        let authenticate = fetch("authenticate", { method: 'POST', body: form})

                        setTimeout(() => {
                            authenticate
                                .then(response => response.json())
                                .then(data => {
                                    if (typeof data.error !== 'undefined') {
                                        alert(data.error)
                                        return;
                                    }
                                    window.location.href = `${url_base}admin/`
                                })
                                .catch(err => console.error(err))
                        }, 500);
                    }
                }
            })
        </script>
    </body>
</html>
