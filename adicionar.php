<!DOCTYPE html>
<!--    iagocolodetti   -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP DB Exemplo - Adicionar</title>
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
                    <h4>Adicionar</h4>
                </div>
            </div>
            <?php
                error_reporting(E_ERROR | E_PARSE); // Para não mostrar erros/avisos do próprio PHP

                require_once 'Contato.php';
                require_once 'ContatoDAO.php';

                $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
                $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : "";
                $email = isset($_POST["email"]) ? $_POST["email"] : "";

                if ($nome != "" && $telefone != "" && $email != "") {
                    $c = new Contato(null, $nome, $telefone, $email);
                    $cdao = new ContatoDAO();
                    $adicionar = $cdao->adicionar($c);
                    print("<div class=\"row justify-content-center\"><div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">");
                    if (!$adicionar) {
                        print("<div class=\"alert alert-success\" role=\"alert\">Contato adicionado.</div>");
                        $nome = "";
                        $telefone = "";
                        $email = "";
                    } elseif ($adicionar == "erroCONN") {
                        print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível adicionar o contato. Erro de Conexão.</div>");
                    } elseif ($adicionar == "erroSQL") {
                        print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível adicionar o contato. Erro de SQL.</div>");
                    }
                    print("</div></div><br>");
                }
                
                print("<form action=\"adicionar.php\" method=\"POST\">");
                printf("<div class=\"row justify-content-center\">
                            <div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">
                                <h5><a href=\"index.html\" class=\"badge badge-pill badge-secondary text-center\">Voltar</a></h5><br>
                                <div class=\"form-group text-center\">
                                    <label for=\"nome\">Nome</label>
                                    <input type=\"text\" class=\"form-control text-center\" name=\"nome\" id=\"nome\" value=\"%s\" required/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <label for=\"telefone\">Telefone</label>
                                    <input type=\"text\" class=\"form-control text-center\" name=\"telefone\" id=\"telefone\" value=\"%s\" required/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <label for=\"email\">Email</label>
                                    <input type=\"email\" class=\"form-control text-center\" name=\"email\" id=\"email\" value=\"%s\" required/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <input type=\"submit\" class=\"btn btn-primary text-center\" value=\"Adicionar\"/>
                                </div>
                            </div>
                        </div>", $nome, $telefone, $email);
                print("</form>");
            ?>
        </div>
    </body>
</html>
