<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>relatorio-grafico-animais</title>
</head>

<body>

    <h1>Relatorio Interno CROACB</h1>

    <p>Este documento informa que, até ao presente momento em que foi disponibilizado, encontram-se cadastrados
        no sistema a seguinte quantidade de animais, distribuídos pelos seguintes tipos (cão, gato e outros) e pelos
        seguintes sexos (macho e fêmea).</p>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Machos</th>
                <th>Fêmeas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
            <tr>
                <td>{{ $row['tipo'] }}</td>
                <td>{{ $row['machos'] }}</td>
                <td>{{ $row['femeas'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        th {
            border: 1px solid #888888;
            padding: 8px;
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