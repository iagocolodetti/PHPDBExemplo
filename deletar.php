<!DOCTYPE html>
<!--    iagocolodetti   -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP DB Exemplo - Deletar</title>
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
                    <h4>Deletar</h4>
                </div>
            </div>
            <?php
                error_reporting(E_ERROR | E_PARSE); // Para não mostrar erros/avisos do próprio PHP

                require_once 'Contato.php';
                require_once 'ContatoDAO.php';

                $id = isset($_POST["id"]) ? $_POST["id"] : "";

                $cdao = new ContatoDAO();
                
                if ($id != "") {
                    $deletar = $cdao->deletar($id);
                    print("<div class=\"row justify-content-center\"><div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">");
                    if (!$deletar) {
                        printf("<div class=\"alert alert-success\" role=\"alert\">Contato de ID '%s' deletado.</div>", $id);
                        $id = "";
                    } elseif ($deletar == "erroDEL") {
                        printf("<div class=\"alert alert-secondary\" role=\"alert\">Não existe contato com ID '%s'.</div>", $id);
                    } elseif ($deletar == "erroCONN") {
                        print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível deletar o contato. Erro de Conexão.</div>");
                    } elseif ($deletar == "erroSQL") {
                        print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível deletar o contato. Erro de SQL.</div>");
                    }
                    print("</div></div><br>");
                }
                
                print("<form action=\"deletar.php\" method=\"POST\">");
                printf("<div class=\"row justify-content-center\">
                            <div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">
                                <h5><a href=\"index.html\" class=\"badge badge-pill badge-secondary text-center\">Voltar</a></h5><br>
                                <div class=\"form-group text-center\">
                                    <label for=\"id\">ID</label>
                                    <input type=\"number\" min=\"0\" class=\"form-control text-center\" name=\"id\" id=\"id\" value=\"%s\" required/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <input type=\"submit\" class=\"btn btn-primary text-center\" value=\"Deletar\"/>
                                </div>
                            </div>
                        </div>", $id);
                print("</form>");
                
                $contatos = $cdao->buscarTodos();
                print("<div class=\"row justify-content-center\"><div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">");
                if ($contatos != null) {
                    print("<div class=\"table-responsive\"><table class=\"table table-bordered table-sm\"><thead><tr><th>ID</th><th>NOME</th><th>TELEFONE</th><th>EMAIL</th></tr></thead><tbody>");
                    foreach ($contatos as $contato) {
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $contato->getID(), $contato->getNome(), $contato->getTelefone(), $contato->getEmail());
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
