<!DOCTYPE html>
<!--    iagocolodetti   -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP DB Exemplo - Buscar por Nome</title>
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
                    <h4>Buscar por Nome</h4>
                </div>
            </div>
            <?php
                error_reporting(E_ERROR | E_PARSE); // Para não mostrar erros/avisos do próprio PHP
                
                require_once 'Contato.php';
                require_once 'ContatoDAOImpl.php';
                
                $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
                
                print("<form action=\"buscarnome.php\" method=\"POST\">");
                printf("<div class=\"row justify-content-center\">
                            <div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">
                                <h5><a href=\"index.html\" class=\"badge badge-pill badge-secondary text-center\">Voltar</a></h5><br>
                                <div class=\"form-group text-center\">
                                    <label for=\"nome\">Nome</label>
                                    <input type=\"text\" class=\"form-control text-center\" name=\"nome\" id=\"nome\" value=\"%s\" required/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <input type=\"submit\" class=\"btn btn-primary text-center\" value=\"Buscar\"/>
                                </div>
                            </div>
                        </div>", $nome);
                print("</form>");
                
                if ($nome != "") {
                    $cdao = new ContatoDAOImpl();
                    $contatos = $cdao->buscarPorNome($nome);
                    print("<div class=\"row justify-content-center\"><div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">");
                    if ($contatos != null) {
                        print("<div class=\"table-responsive\"><table class=\"table table-bordered table-sm\"><thead><tr><th>NOME</th><th>TELEFONE</th><th>EMAIL</th></tr></thead><tbody>");
                        foreach ($contatos as $contato) {
                            printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $contato->getNome(), $contato->getTelefone(), $contato->getEmail());
                        }
                        print("</tbody></table></div>");
                    } elseif ($contatos == null) {
                        printf("<div class=\"alert alert-secondary\" role=\"alert\">Não existem contatos com nome '%s' no banco de dados.</div>", $nome);
                    } elseif ($contatos == "erroCON") {
                        print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível buscar os contatos. Erro de Conexão.</div>");
                    } elseif ($contatos == "erroSQL") {
                        print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível buscar os contatos. Erro de SQL.</div>");
                    }
                    print("</div></div>");
                }
            ?>
        </div>
    </body>
</html>
