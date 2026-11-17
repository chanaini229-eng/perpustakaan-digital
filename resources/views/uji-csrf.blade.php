<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengujian CSRF</title>
</head>
<body>
    <h2>Pengujian Perlindungan CSRF</h2>

    <h3>Form dengan Token CSRF</h3>
    <form action="/uji-csrf" method="POST">
        @csrf
        <button type="submit">Kirim dengan Token</button>
    </form>

    <h3>Form tanpa Token CSRF</h3>
<form action="/uji-csrf" method="POST">
    <button type="submit">Kirim tanpa Token</button>
</form>



</body>
</html>
