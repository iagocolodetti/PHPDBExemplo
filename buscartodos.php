<!DOCTYPE html>
<!--    iagocolodetti   -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP DB Exemplo - Buscar Todos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container-fluid center">
            <div class="row justify-content-center">
                <div class="form-group text-center">
                    <h4>Buscar Todos</h4>
                </div>
            </div>
            <?php
                error_reporting(E_ERROR | E_PARSE); // Para não mostrar erros/avisos do próprio PHP
                
                require_once 'Contato.php';
                require_once 'ContatoDAOImpl.php';
                
                $cdao = new ContatoDAOImpl();
                $contatos = $cdao->buscarTodos();
                print("<div class=\"row justify-content-center\"><div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">
                        <h5><a href=\"index.html\" class=\"badge badge-pill badge-secondary text-center\">Voltar</a></h5><br>");
                if ($contatos != null) {
                    print("<div class=\"table-responsive\"><table class=\"table table-bordered table-sm\"><thead><tr><th>NOME</th><th>TELEFONE</th><th>EMAIL</th></tr></thead><tbody>");
                    foreach ($contatos as $contato) {
                        printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $contato->getNome(), $contato->getTelefone(), $contato->getEmail());
                    }
                    print("</tbody></table></div>");
                } elseif ($contatos == null) {
                    print("<div class=\"alert alert-secondary\" role=\"alert\">Não existem contatos no banco de dados.</div>");
                } elseif ($contatos == "erroCON") {
                    print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível adicionar o contato. Erro de Conexão.</div>");
                } elseif ($contatos == "erroSQL") {
                    print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível adicionar o contato. Erro de SQL.</div>");
                }
                print("</div></div>");
            ?>
        </div>
    </body>
</html>
