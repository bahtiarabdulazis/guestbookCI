<!-- Include jQuery and select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="<?= base_url('assets/js/popper.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<script>
    $(document).ready(function() {
        // Initialize select2
        $('#ygdituju').select2({
            placeholder: 'Pilih yang dituju',
            allowClear: true
        });

        // Load data for select2    
        $.ajax({
            url: "<?php echo base_url('TamuController/ygDituju'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data && Array.isArray(data) && data.length > 0) {
                    $('#ygdituju').empty();
                    $('#ygdituju').append('<option value="" selected disabled style="display:none;">Pilih yang Anda Tuju</option>');

                    $.each(data, function(i, pegawai) {
                        if (pegawai.id != 23 && pegawai.id != 30 && pegawai.id != 163) {
                            $('#ygdituju').append('<option value="' + pegawai.nama + '">' + pegawai.nama + '</option>');
                        }
                    });

                    // Refresh select2
                    $('#ygdituju').trigger('change');
                } else {
                    console.warn('No data received or data is not in expected format');
                }
            },
            error: function(xhr, status, error) {   
                console.error('Failed to load data:', error);
            }
        });
    });
    
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
        let inputs = document.querySelectorAll('#guestForm input, #guestForm textarea, #guestForm select');
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
        let ygdituju = document.querySelector('select[name="ygdituju"]').value;

        $.ajax({
            url: "<?php echo base_url('TamuController/simpanTamu'); ?>",
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
                
                // Redirect ke halaman QR code setelah 1 detik
                    setTimeout(function(){
                        window.location.href = "<?php echo base_url('/render/showQR'); ?>";
                    }, 1000); // 1 detik
                },
            error: function(xhr) {
                $('#alert').removeClass('alert-success').addClass('alert-danger').html(
                    'Terjadi kesalahan, data tidak dapat disimpan.').show();
            }
        });
    }
</script>
