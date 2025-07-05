<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contato Salvo</title>
</head>
<body>
    <h1>Olá, {{ $contact->name }}!</h1>
    <p>O seu contato foi excluído com sucesso do nosso sistema.</p>
    <p>Email: {{ $contact->email }}</p>
    <p>Telefone: {{ $contact->phone }}</p>

    <p>Obrigado por entrar em contato!</p>
</body>
</html>
