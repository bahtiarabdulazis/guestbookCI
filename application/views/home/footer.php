<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/popper.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<script>
    // Fungsi untuk menampilkan modal
    function showModal() {
        // Memeriksa apakah semua formulir telah diisi
        if (isFormValid()) {
            $('#modal1').show();
            showSlides(slideIndex);
        } else {
            alert('Harap isi semua formulir sebelum melanjutkan!');
        }
    }

    function isFormValid() {
        // Memeriksa setiap input untuk memastikan tidak kosong
        let inputs = document.querySelectorAll('#guestForm input');
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].value.trim() === '') {
                return false; // Jika ada input yang kosong, mengembalikan false
            }
        }
        return true; // Mengembalikan true jika semua input telah diisi
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        $('#modal1').hide();
    }

    // Logika slideshow
    let slideIndex = 1;

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        const slides = document.getElementsByClassName("mySlides");

        if (n > slides.length) {
            slideIndex = slides.length;
        }

        if (n < 1) {
            slideIndex = 1;
        }

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex - 1].style.display = "block";

        // Disable next button on last slide
        if (slideIndex === slides.length) {
            document.getElementsByClassName("next")[0].style.display = "none";
        } else {
            document.getElementsByClassName("next")[0].style.display = "inline";
        }

        // Disable prev button on first slide
        if (slideIndex === 1) {
            document.getElementsByClassName("prev")[0].style.display = "none";
        } else {
            document.getElementsByClassName("prev")[0].style.display = "inline";
        }
    }
</script>

<script>
    function toggleSaveButton() {
        const checkbox = document.getElementById("checkbox");
        const saveButton = document.getElementById("save");

        if (checkbox.checked) {
            saveButton.style.display = "block";
        } else {
            saveButton.style.display = "none";
        }
    }

    function saveData() {
        const checkbox = document.getElementById("checkbox");
        if (!checkbox.checked) {
            alert("Mohon centang kotak persetujuan sebelum menyimpan.");
            return;
        }

        // Jika checkbox dicentang, lanjutkan dengan menyimpan data
        let nama = document.querySelector('input[name="nama"]').value;
        let aslpt = document.querySelector('input[name="aslpt"]').value;
        let makkun = document.querySelector('textarea[name="makkun"]').value;
        let ygdituju = document.querySelector('input[name="ygdituju"]').value;

        $.ajax({
            url: "<?php echo base_url('TamuController/SimpanTamu'); ?>",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                nama: nama,
                aslpt: aslpt,
                makkun: makkun,
                ygdituju: ygdituju
            },
            success: function(response) {
                $('#alert').removeClass('alert-danger').addClass('alert-success').html(
                    'Data berhasil disimpan!').show();
                
                // Redirect ke halaman QR code setelah 2 detik
                setTimeout(function(){
                    window.location.href = "<?php echo base_url('/render'); ?>";
                }, 2000); // 2 detik
            },
            error: function(xhr) {
                $('#alert').removeClass('alert-success').addClass('alert-danger').html(
                    'Terjadi kesalahan, data tidak dapat disimpan.').show();
            }
        });
    }
</script>

</body>