document.addEventListener('DOMContentLoaded', function() {
    const text = "Bagi mereka yang mencari keindahan alam yang segar dan menakjubkan, toko bunga 'El Nunez' adalah tempat yang tepat untuk pergi. Kami menawarkan berbagai macam bunga, mulai dari mawar yang indah hingga anggrek yang indah, untuk setiap selera dan kesempatan. Setiap bunga dipilih dengan teliti untuk memastikan kualitas terbaik dan dipersiapkan dengan cermat untuk membuat buket yang luar biasa. Untuk memenuhi kebutuhan dan acara Anda, staf kami yang berpengalaman siap membantu Anda dalam memilih dan merangkai bunga.";
    let index = 0;
    const aboutTextElement = document.getElementById("about-text");
    function typeWriter() {
        if (index < text.length) {
            aboutTextElement.innerHTML += text.charAt(index);
            index++;
            setTimeout(typeWriter, 50); // Waktu delay antara setiap karakter (dalam milidetik)
        }
    }
    typeWriter();
});
document.addEventListener('DOMContentLoaded', function() {
    const text = "No.contact = 085715943166<br>E-mail = tokobunga_elnunez@gmail.com<br>Instagram = @toko_bunga_elnunez<br>Facebook = Toko Bunga El Nunez<br>Twitter(x) = @tkobungaelnunez";
    let index = 0;
    const aboutTextElement = document.getElementById("contact-text");
    function typeWriter() {
        if (index < text.length) {
            if (text.charAt(index) === "<") {
                let endIndex = text.indexOf(">", index);
                aboutTextElement.innerHTML += text.substring(index, endIndex + 1);
                index = endIndex + 1;
            } else {
                aboutTextElement.innerHTML += text.charAt(index);
                index++;
            }
            setTimeout(typeWriter, 50);
        }
    }
    typeWriter();
});
