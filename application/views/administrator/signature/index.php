<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    #signature-pad {
        border: 1px solid #000;

    }
</style>
<div class="main-content container-fluid">
    <div class="page-title">
        <h4>Data Signature</h4>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <label for="" class="form-label">Nama Lurah</label>
                    <div class="form-group col-lg-4 col-md-8 col-11 d-flex gap-2" style="gap: 10px;">
                        <input type="text" id="inputNamaLurah" class="form-control" disabled
                            value="<?= $data[0]->namaLurah ?>">

                        <button id="on" onclick="enableEditNama()" class="btn btn-warning "><i
                                class="bi bi-pencil"></i></button>

                        <div class="d-none" id="editNamaLurah" style="gap : 10px">
                            <button onclick="changeNamaLurah()" class="btn btn-success"><i
                                    class="bi bi-check2"></i></button>
                            <button onclick="reset()" class="btn btn-danger"><i class="bi bi-x"></i></button>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">Tanda Tangan Lurah</label>

                    <div class="form-group col-lg-4 col-md-8 col-10  d-flex gap-2 position-relative" style="gap: 10px;">
                        <?php if (!$data[0]->pathSignature) {

                            ?>
                            <img class="img-thumbnail col-12"
                                src="<?php echo base_url('assets/images/tandatangandefault.png'); ?>" alt="Tanda Tangan">
                            <?php
                        } else {
                            ?>
                            <img class="img-thumbnail col-12" src="<?php echo base_url($data[0]->pathSignature); ?>"
                                alt="Tanda Tangan">
                            <?php

                        }

                        ?>

                        <button data-toggle="modal" data-target="#editTandaTangan"
                            class="btn btn-warning position-absolute inline-block" style="right: 0; bottom: 0;"><i
                                class="bi bi-pencil"></i></button>
                        <!-- <div class="d-none" id="editNamaLurah" style="gap : 10px">
                            <button onclick="changeNamaLurah()" class="btn btn-success"><i
                                    class="bi bi-check2"></i></button>
                            <button onclick="reset()" class="btn btn-danger"><i class="bi bi-x"></i></button>
                        </div> -->
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">Stempel Desa</label>

                    <div class="form-group col-lg-4 col-md-8 col-10 d-flex gap-2 position-relative" style="gap: 10px;">
                        <?php if (!$data[0]->pathStempel) {

                            ?>
                            <img class="img-thumbnail col-12"
                                src="<?php echo base_url('assets/images/stempeldefault.png'); ?>" alt="Tanda Tangan">
                            <?php
                        } else {
                            ?>
                            <img class="img-thumbnail col-12" src="<?php echo base_url($data[0]->pathStempel); ?>"
                                alt="Stempel">
                            <?php

                        }

                        ?>

                        <button data-toggle="modal" data-target="#editStempel"
                            class="btn btn-warning position-absolute inline-block" style="right: 0; bottom: 0;"><i
                                class="bi bi-pencil"></i></button>
                        <!-- <div class="d-none" id="editNamaLurah" style="gap : 10px">
                            <button onclick="changeNamaLurah()" class="btn btn-success"><i
                                    class="bi bi-check2"></i></button>
                            <button onclick="reset()" class="btn btn-danger"><i class="bi bi-x"></i></button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- modal edit tanda tangan -->
    <div class="modal fade" id="editTandaTangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Tanda Tangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto">
                            <canvas id="signature-pad"></canvas>

                            <button id='clear' class="btn btn-info my-2">Clear</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class='btn btn-success' id="save">Simpan</button>
                    <button class='btn btn-danger' data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal edit stempel -->
    <div class="modal fade" id="editStempel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Stempel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12  mx-auto d-flex" style="gap:10px">
                            <div>

                                <p for="">Stempel Lama</p>
                                <?php if (!$data[0]->pathStempel) {

                                    ?>
                                    <img class="img-thumbnail"
                                        src="<?php echo base_url('assets/images/stempeldefault.png'); ?>"
                                        alt="Tanda Tangan">
                                    <?php
                                } else {
                                    ?>
                                    <img width="200" height="200" class="img-thumbnail"
                                        src="<?php echo base_url($data[0]->pathStempel); ?>" alt="Stempel">
                                    <?php

                                }

                                ?>
                            </div>
                            <div>
                                <p>Stempel Baru</p>
                                <img src="" id="newStamp" alt='Stempel Baru' class='img-thumbnail' width="200"
                                    height="200">

                            </div>
                        </div>
                        <div class="form-group my-2">
                            <input id="uploadStempel" type="file" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class='btn btn-success' id="saveStempel">Simpan</button>
                    <button class='btn btn-danger' data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>./assets/jQuery/jQuery.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
    function reset() {
        $('#inputNamaLurah').attr('disabled', true);
        $('#on').removeClass('d-none');
        $("#editNamaLurah").addClass('d-none')
        $("#editNamaLurah").removeClass('d-flex')
    }
    function enableEditNama() {
        $('#inputNamaLurah').attr('disabled', false);
        $('#on').addClass('d-none');
        $("#editNamaLurah").removeClass('d-none')
        $("#editNamaLurah").addClass('d-flex')
    }
    function changeNamaLurah() {
        var namaLurah = $('#inputNamaLurah').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>signature/updateLurahName",
            data: {
                namaLurah: namaLurah
            },
            success: function (data) {
                // alert(data);
                if (data.status == 'success') {
                    Toastify({
                        text: data.message,
                        duration: 2000, // Durasi dalam milidetik
                        close: true, // Menampilkan tombol close
                        gravity: "top", // "top" atau "bottom"
                        position: 'right', // "left", "center" atau "right"
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Warna latar belakang
                        stopOnFocus: true, // Menghentikan timer saat hover
                    }).showToast();
                    reset();
                }

                // console.log(data);

            },
            error: function (err) {
                console.log(err);
            }
        });
    }
</script>
<script>
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    document.getElementById('save').addEventListener('click', function () {
        if (signaturePad.isEmpty()) {
            alert("Silakan gambar tanda tangan terlebih dahulu.");
        } else {
            var dataURL = signaturePad.toDataURL();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('signature/signaturesave'); ?>",
                data: { image: dataURL },
                success: function (response) {
                    console.log(JSON.parse(response));
                    const respon = JSON.parse(response);
                    if (respon.status == 'success') {
                        Toastify({
                            text: 'Tanda Tangan Diperbarui',
                            duration: 2000, // Durasi dalam milidetik
                            close: true, // Menampilkan tombol close
                            gravity: "top", // "top" atau "bottom"
                            position: 'right', // "left", "center" atau "right"
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Warna latar belakang
                            stopOnFocus: true, // Menghentikan timer saat hover
                        }).showToast();
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        Toastify({
                            text: respon.message,
                            duration: 2000, // Durasi dalam milidetik
                            close: true, // Menampilkan tombol close
                            gravity: "top", // "top" atau "bottom"
                            position: 'right', // "left", "center" atau "right"
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Warna latar belakang
                            stopOnFocus: true, // Menghentikan timer saat hover
                        }).showToast();
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }

                    // alert("Tanda tangan berhasil disimpan!");
                },
                error: function (err) {
                    console.log(err)
                    alert("Terjadi kesalahan saat menyimpan tanda tangan.");
                }
            });
        }
    });
    document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear(); // Jika menggunakan Signature Pad
        // atau
        context.clearRect(0, 0, canvas.width, canvas.height); // Jika menggunakan kanvas
    });
</script>
<script>
    let base64Image = '';
    // let stempelBaru = $("#stempelBaru").
    document.getElementById('uploadStempel').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                base64Image = e.target.result; // Simpan string base64
                const base64String = e.target.result; // Ini adalah string base64
                const newStampImage = document.getElementById('newStamp');
                newStampImage.src = base64String; // Set src ke gambar baru
                newStampImage.style.display = 'block'; // Tampilkan gambar
            };
            reader.readAsDataURL(file); // Membaca file sebagai URL data
        }
    });
    document.getElementById('saveStempel').addEventListener('click', function () {
        if (base64Image) {
            // Mengirim data ke server menggunakan jQuery AJAX
            $.ajax({
                url: "<?php echo base_url('signature/stempelsave'); ?>",
                type: 'POST',

                data: { image: base64Image },
                success: function (response) {
                    // alert('Gambar berhasil disimpan!');
                    console.log(response);
                    const respon = JSON.parse(response);
                    if (respon.status == 'success') {
                        Toastify({
                            text: 'Stempel Diperbarui',
                            duration: 2000, // Durasi dalam milidetik
                            close: true, // Menampilkan tombol close
                            gravity: "top", // "top" atau "bottom"
                            position: 'right', // "left", "center" atau "right"
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Warna latar belakang
                            stopOnFocus: true, // Menghentikan timer saat hover
                        }).showToast();
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        Toastify({
                            text: respon.message,
                            duration: 2000, // Durasi dalam milidetik
                            close: true, // Menampilkan tombol close
                            gravity: "top", // "top" atau "bottom"
                            position: 'right', // "left", "center" atau "right"
                            backgroundColor: "linear-gradient(to right, #DA1818, #D32B2B)", /* Menggunakan HEX */
                            stopOnFocus: true, // Menghentikan timer saat hover
                        }).showToast();

                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Terjadi kesalahan saat menyimpan gambar: ' + errorThrown);
                }
            });
        } else {
            alert('Silakan unggah gambar terlebih dahulu.');
        }

    });
</script>