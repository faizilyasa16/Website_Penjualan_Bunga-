// Update total price function
function updateTotal() {
    const qtyInputs = document.getElementsByClassName('angka-keranjang');
    let totalHarga = 0;
    for (let i = 0; i < qtyInputs.length; i++) {
        const input = qtyInputs[i];
        const idProduk = input.getAttribute('id').split('_')[1];
        const product = products.find(product => product.id == idProduk);
        const hargaProduk = product.price;
        const kuantitas = input.value;

        totalHarga += hargaProduk * kuantitas;
    }

    document.getElementById('totalPrice').innerText = totalHarga;
}
// Payment button click event listener
document.getElementById('btnBayar').addEventListener('click',function()  {
    const nama = document.getElementById('nama').value;
    const alamat = document.getElementById('alamat').value;
    const telepon = document.getElementById('telepon').value;
    const metodePembayaran = document.getElementById('Pembayaran').value;

    if (nama === '' || alamat === '' || telepon === '' || metodePembayaran === '') {
        alert('Mohon lengkapi informasi pembayaran terlebih dahulu.');
    } else {
        alert('Pesanan Anda sedang diproses.');
    }
});
// Show/hide QRIS image based on selected payment method
document.getElementById('Pembayaran').addEventListener('change', function() {
    const opsiYangDiPilih = this.value;
    const qrisImage = document.getElementById('qrisImage');
    qrisImage.style.display = (opsiYangDiPilih === 'BCA' || opsiYangDiPilih === 'BSI' || opsiYangDiPilih === 'BNI' || opsiYangDiPilih === 'BRI') ? 'block' : 'none';
});

// Validate and navigate function
function validasiDanArahkan() {
    const qtyInputs = document.getElementsByClassName('angka-keranjang');
    let totalHarga = 0;
    for (let i = 0; i < qtyInputs.length; i++) {
        const input = qtyInputs[i];
        if (input.value === '' || parseInt(input.value) <= 0) {
            alert('Mohon isi jumlah barang yang ingin dibeli.');
            document.getElementById('checkoutForm').style.display = 'none';
            return;
        }
        else {
            document.getElementById('checkoutForm').style.display = 'block';
        }
    }

    if (totalHarga == 0) {
        alert('Keranjang belanja Anda kosong. Mohon tambahkan produk terlebih dahulu.');
        window.location.href = 'index.php';
        return;
    }

}
