<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdf</title>
</head>

<body>
    <h1>Relatorio Interno CROACB</h1>

    <p>No presente momento em que este documento foi disponibilizado, encontram-se cadastrados os seguintes animais, com as respetivas informações atribuídas.
Segue abaixo a listagem dos mesmos</p>
    
    @foreach ($animals as $animal)

  <table>
    <tr>
        <td>ID</td>
        <td>{{ $animal->id }}</td>
    </tr>
    <tr>
        <td>Nome</td>
        <td>{{ $animal->nome }}</td>
    </tr>
    <tr>
        <td>Categoria</td>
        <td>{{ $animal->category_id }}</td>
    </tr>
    <tr>
        <td>Sexo</td>
        <td>{{ $animal->sexo }}</td>
    </tr>
    <tr>
        <td>Coloração</td>
        <td>{{ $animal->coloracao }}</td>
    </tr>
    <tr>
        <td>Idade</td>
        <td>{{ $animal->idade }}</td>
    </tr>
    <tr>
        <td>Porte</td>
        <td>{{ $animal->porte }}</td>
    </tr>
    <tr>
        <td>História</td>
        <td>{{ $animal->storytelling }}</td>
    </tr>
    <tr>
        <td>Observações</td>
        <td>{{ $animal->observacoes }}</td>
    </tr>
    <tr>
        <td>Comportamento</td>
        <td>{{ $animal->comportamento }}</td>
    </tr>
    <tr>
        <td>Data de Entrada</td>
        <td>{{ $animal->data_entrada }}</td>
    </tr>
    <tr>
        <td>Disponível</td>
        <td>{{ $animal->disponivel ? 'Sim' : 'Não' }}</td>
    </tr>
    <tr>
        <td>Microchip</td>
        <td>{{ $animal->microchip ? 'Sim' : 'Não' }}</td>
    </tr>
    <tr>
        <td>Data de Adoção</td>
        <td>{{ $animal->data_adocao }}</td>
    </tr>
    <tr>
        <td>Criado em</td>
        <td>{{ $animal->created_at }}</td>
    </tr>
    <tr>
        <td>Atualizado em</td>
        <td>{{ $animal->updated_at }}</td>
    </tr>
</table></br><br>
    @endforeach

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
    }

    td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    tr td:first-child {
        font-weight: bold;
        background-color: #f5f5f5;
        width: 200px;
    }
</style>

</body>

</html>