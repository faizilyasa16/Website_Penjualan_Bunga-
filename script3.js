function updateTotal() {
    const qtyInputs = document.querySelectorAll('.angka-keranjang');
    let totalPrice = 0;

    qtyInputs.forEach(function(input) {
        const productId = input.getAttribute('id').split('_')[1];
        const productPrice = products.find(product => product.id == productId).price;
        const quantity = input.value;

        totalPrice += productPrice * quantity;
    });

    document.getElementById('totalPrice').innerText = totalPrice;
}


document.addEventListener('DOMContentLoaded', function() {
    updateTotal(); // Memanggil updateTotal saat halaman dimuat
    const qtyInputs = document.querySelectorAll('.angka-keranjang');
    qtyInputs.forEach(function(input) {
        input.addEventListener('change', updateTotal);
        input.addEventListener('input', updateTotal); // Tambahkan ini untuk event input
    });
});
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btnBayar').addEventListener('click', function(event) {
        const nama = document.getElementById('nama').value;
        const alamat = document.getElementById('alamat').value;
        const telepon = document.getElementById('telepon').value;
        const metodePembayaran = document.getElementById('Pembayaran').value;

        if (nama === '' || alamat === '' || telepon === '' || metodePembayaran === '') {
            alert('Mohon lengkapi informasi pembayaran terlebih dahulu.');
            event.preventDefault(); // Mencegah aksi default tombol Bayar
        } else {
            alert('Pesanan Anda sedang diproses.');
        }
    });
});
function showQrisImage() {
    var selectedOption = document.getElementById('Pembayaran').value;
    var qrisImage = document.getElementById('qrisImage');
    if (selectedOption === 'BCA' || selectedOption === 'BSI' || selectedOption === 'BNI' || selectedOption === 'BRI') {
        qrisImage.style.display = 'block';
    } else {
        qrisImage.style.display = 'none';
    }
}
function validateAndRedirect() {
    let isValid = true;
    document.querySelectorAll('.angka-keranjang').forEach(input => {
        if (input.value === '' || parseInt(input.value) <= 0) {
            isValid = false;
            alert('Mohon isi jumlah barang yang ingin dibeli.');
            return;
        }
    });

    if (!isValid) {
        return; // Menghentikan eksekusi kode selanjutnya
    }

    let totalHarga = 0;
    document.querySelectorAll('.item').forEach(item => {
        const harga = parseInt(item.querySelector('.price').innerText.replace('Rp ', ''));
        const qty = parseInt(item.querySelector('.angka-keranjang').value);
        totalHarga += harga * qty;
    });

    if (totalHarga === 0) {
        alert('Keranjang belanja Anda kosong. Mohon tambahkan produk terlebih dahulu.');
        window.location.href = 'index.php'; // Alihkan kembali ke halaman index.php
        return; // Menghentikan eksekusi kode selanjutnya
    }

    document.getElementById('checkoutForm').style.display = 'block';
}


function showPaymentInfo() {
    document.getElementById('checkoutForm').style.display = 'block';
}
