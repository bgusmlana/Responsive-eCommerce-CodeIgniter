<html>

<body>
    <div style="text-align:justify">
        Halo, <b> <?= $nama ?>.</b>
        <br>
        <br>Hari ini pada tanggal <span style='color:red'><?= $tglaktif ?></span>,
        Anda mengirimkan permintaan untuk reset Password.
    </div>

    <br> Email Login : <b style='color:red'> <?= $email ?></b>
    <br> Password Login : <b style='color:red'> <?= $randompass ?></b>
    <br>
    <br>Silahkan Login <a href='<?= base_url(' login') ?>'>disini</a>
    <br>
    <br>Salam, Admin
</body>

</html>