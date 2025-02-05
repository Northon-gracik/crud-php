<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Pessoas e Telefones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .btn-outline-warning {

            &:hover,
            &:active,
            &:focus {
                color: white !important;
            }
        }

        tr {
            min-height: 41px !important;
        }
        .mr-2{
            margin-right: 0.5rem !important;  
        }
    </style>
</head>

<body>
    <header class="p-3 mb-3 border-bottom bg-light">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <h2 class="text-dark">Cadastro de Pessoas e Telefones</h2>
            </div>
        </div>
    </header>
    <div class="container my-4 card p-3 shadow">
        <h3 class="showInEdicao">Editar Pessoa</h3>
        <h3 class="hideInEdicao">Adicionar Pessoa</h3>
        <div class="row">
        <div class="col-6">

            <form id="formPessoa" class="needs-validation card p-2" novalidate>
                <h5>Informações pessoais</h5>
                <hr class="m-0 mb-2">
                <div class="mb-2 row">
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>

                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-7">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" required>
                    </div>
                    <div class="col-5">
                        <label for="rg" class="form-label">RG:</label>
                        <input type="text" class="form-control" id="rg" name="rg" required>
                    </div>
                </div>  
                <h5>Endereço</h5>
                <hr class="m-0 mb-2">
                <div class="mb-2 row">
                    <div class="col-4">
                        <label for="cep" class="form-label">CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep" required>
                    </div>
                    <div class="col-8">
                        <label for="logradouro" class="form-label">Logradouro:</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-12">
                        <label for="complemento" class="form-label">Complemento:</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" required>
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-6">
                        <label for="setor" class="form-label">Setor:</label>
                        <input type="text" class="form-control" id="setor" name="setor" required>
                    </div>
                    <div class="col-6">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-12">
                        <label for="uf" class="form-label">UF:</label>
                        <select class="form-select" id="uf" name="uf" required>
                            <option value="">Selecione um estado</option>
                            <?php
                            $estados = array("AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO");
                            foreach ($estados as $estado) {
                                echo "<option value='$estado'>$estado</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="showInEdicao">
                        <button type="submit" class="btn btn-primary btn-salvar-edicao"><i class="bi bi-pencil mr-2"></i>Editar Pessoa</button>
                        <button type="button" class="btn btn-danger btn-excluir"
                            onclick="excluirPessoa(<?= $_GET['id'] ?>)"><i class="bi bi-trash mr-2"></i>Excluir
                            Pessoa</button>
                    </div>
                    <div class="hideInEdicao">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle mr-2"></i>Cadastrar
                            Pessoa</button>
                    </div>
                </div>
            </form>
        </div>

            <div class="showInEdicao col-6">
                <h3 class="">Telefones</h3>
                <table class="table table-bordered mt-2" id="tabelaTelefones">
                    <thead>
                        <tr>
                            <th>Telefone</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyTelefones">
                    </tbody>
                </table>

                <h3 class="mt-4">Adicionar Telefone</h3>
                <form id="formTelefone" class="card p-3">
                    <div class="row mb-3">
                        <input type="hidden" id="pessoaId" name="pessoa_id" value="<?= $_GET['id'] ?>">
                        <div class="col-6">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" required>

                        </div>
                        <div class="col-6">
                            <label for="descricao" class="form-label">Descrição:</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle mr-2"></i>Adicionar
                                Telefone</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr>
        <table class="table table-bordered mt-2" id="tabelaPessoas">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>CEP</th>
                    <th>TELEFONES</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tbodyPessoas">
            </tbody>
        </table>
    </div>



    <script>
        function carregarPessoas() {
            $.ajax({
                url: "server.php/pessoas",
                type: "GET",
                success: function (response) {
                    var pessoas = response;
                    var html = '';
                    pessoas.forEach(function (pessoa) {
                        html += `<tr>
                            <td>${pessoa.nome}</td>
                            <td>${pessoa.cpf}</td>
                            <td>${pessoa.rg}</td>
                            <td>${pessoa.cep}</td>
                            <td style="text-align:right;" id='telefones_${pessoa.id}'></td>
                            <td style="text-align:right;"><button class="btn btn-outline-warning" onclick="habilitarEdicao(${pessoa.id})"><i class="bi bi-pencil-fill"></i></button></td>
                        </tr>`;
                    });

                    $('#tbodyPessoas').html(html);
                    $.each(pessoas, function (index, pessoa) {
                        carregarTelefones(pessoa.id);
                    });
                }
            });
        }

        function carregarTelefones(pessoa_id) {
            $.ajax({
                url: "server.php/telefones",
                type: "GET",
                data: { pessoa_id: pessoa_id },
                success: function (response) {
                    var telefones = response;
                    var html = '';
                    telefones.forEach(function (telefone) {
                        html += `<p>${telefone.telefone} - ${telefone.descricao}</p>`;
                    });
                    $('#telefones_' + pessoa_id).html(html);
                }
            });
        }

        function excluirPessoa(id) {
            var id = $('#formPessoa').data('editing');
            if (confirm("Tem certeza que deseja excluir esta pessoa?")) {
                $.ajax({
                    url: "server.php/pessoas/?id=" + id,
                    type: "DELETE",
                    data: { id: id },
                    success: function (response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            alert('Pessoa excluída');
                            zerarDados();
                            carregarPessoas();
                        }
                    }
                });
            }
        }

        function habilitarEdicao(id) {
            $.ajax({
                url: "server.php/pessoas",
                type: "GET",
                data: { id: id },
                success: function (response) {
                    var pessoa = response[0];

                    $('.hideInEdicao').addClass('d-none');
                    $('.showInEdicao').removeClass('d-none');

                    $('#nome').val(pessoa.nome);
                    $('#cpf').val(pessoa.cpf);
                    $('#rg').val(pessoa.rg);
                    $('#cep').val(pessoa.cep);
                    $('#logradouro').val(pessoa.logradouro);
                    $('#complemento').val(pessoa.complemento);
                    $('#setor').val(pessoa.setor);
                    $('#cidade').val(pessoa.cidade);
                    $('#uf').val(pessoa.uf);
                    $('#formPessoa').data('editing', id); // Save the id of the person being edited
                    $('#pessoaId').val(id);
                    carregarTelefonesDePessoa(id);

                    $('#nome').focus();
                }
            });
        }
        function carregarTelefonesDePessoa(id) {

            $.ajax({
                url: "server.php/telefones",
                type: "GET",
                data: { pessoa_id: id },
                success: function (response) {
                    var telefones = response;
                    var html = '';
                    telefones.forEach(function (telefone) {
                        html += `<tr>
                            <td>${telefone.telefone}</td>
                            <td>${telefone.descricao}</td>
                        </tr>`;
                    });
                    if (telefones.length < 5) {
                        console.log("i");

                        for (var i = telefones.length; i < 5; i++) {
                            html += `<tr>
                                <td></td>
                                <td></td>
                            </tr>`;
                        }
                    }
                    $('#tbodyTelefones').html(html);
                }
            });
        }



        $('#formPessoa').on('submit', function (e) {
            e.preventDefault();
            var id = $('#formPessoa').data('editing');
            if (id) {
                $.ajax({
                    url: "server.php/pessoas?id=" + id,
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function () {
                        alert('Edição salva');
                        $('#formPessoa').removeData('editing'); // Remove the editing state
                        carregarPessoas();
                    }
                });
            } else {
                $.ajax({
                    url: "server.php/pessoas",
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function () {
                        alert('Pessoa cadastrada');
                        carregarPessoas();
                    }
                });
            }
            zerarDados();
            carregarPessoas();
        });

        function zerarDados() {
            $('#formPessoa').removeData('editing'); // Remove the editing state

            $('#nome').val('');
            $('#cpf').val('');
            $('#rg').val('');
            $('#cep').val('');
            $('#logradouro').val('');
            $('#complemento').val('');
            $('#setor').val('');
            $('#cidade').val('');
            $('#uf').val('');

            $('#id').val('');

            $('.showInEdicao').addClass('d-none');
            $('.hideInEdicao').removeClass('d-none');

        }

        $('#formTelefone').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "server.php/telefones",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function () {
                    alert('Telefone cadastrado');
                    carregarTelefones($('#pessoaId').val());
                    carregarTelefonesDePessoa($('#pessoaId').val());
                    $('#telefone').val('');
                    $('#descricao').val('');

                }
            });
        });

        $(document).ready(function () {
            carregarPessoas();

            $('.showInEdicao').addClass('d-none');
        });
    </script>
</body>

</html>