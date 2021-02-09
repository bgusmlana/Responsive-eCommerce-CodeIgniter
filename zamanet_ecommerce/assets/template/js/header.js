function nospaces(t) {
    if (t.value.match(/\s/g)) {
        alert('Maaf, Username Tidak Boleh Menggunakan Spasi,..');
        t.value = t.value.replace(/\s/g, '');
    }
}

function toDuit(number) {
    var number = number.toString(),
        duit = number.split('.')[0],
        duit = duit.split('').reverse().join('')
            .replace(/(\d{3}(?!$))/g, '$1.')
            .split('').reverse().join('');
    return 'Rp ' + duit;
}