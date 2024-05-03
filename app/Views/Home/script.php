<script>
    function clear_form_panitia() {
        $('#modalnama').val('');
        $('#hp').val('');
        $('#anggota').val('');
        $('#dewasa').val('');
        $('#anak').val('');
        $('#bayar').val('');
    }

    function method_url(baseurl, controler, method) {
        var base_url = baseurl + controler + '/' + method;
        return base_url;
    }

    $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            var keyword = $(this).val(),
                baseurl = $('#baseurl').val(),
                page = 1;
            $.ajax({
                url: method_url(baseurl, 'Home', 'searchData'),
                data: {
                    keyword: keyword,
                    page: page,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    console.log('ok');
                    $('.tabelDataPendaftaran').html(data);
                }
            });
        });

        $('#keywordpanitia').on('keyup', function() {
            var keyword = $(this).val(),
                baseurl = $('#baseurl').val(),
                page = 1;
            $.ajax({
                url: method_url(baseurl, 'Home', 'searchDataPanitia'),
                data: {
                    keyword: keyword,
                    page: page,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.tabelDataPendaftaran').html(data);
                }
            });
        });

        $('#keywordsetoran').on('keyup', function() {
            var keyword = $(this).val(),
                baseurl = $('#baseurl').val(),
                page = 1;
            $.ajax({
                url: method_url(baseurl, 'Home', 'searchDataSetoran'),
                data: {
                    keyword: keyword,
                    page: page,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.tabelDataSetoran').html(data);
                }
            });
        });

        $('.modalpanitia').on('click', function() {
            const id = $(this).data('id'),
                baseurl = $('#baseurl').val();
            clear_form_panitia();
            $('#modalnama').prop('disabled', true);
            $('#hp').prop('disabled', true);
            if ($('#siapa').val() == 1 && $(this).data('pic') == 1) {
                $('#updatepanitia').prop('hidden', false);
            } else {
                $('#updatepanitia').prop('hidden', true);
            }
            $.ajax({
                url: method_url(baseurl, 'Home', 'getdata'),
                data: {
                    id: id,
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#modalnama').val(data.nama);
                    $('#hp').val(data.hp);
                    $('#anggota').val(data.anggota);
                    $('#transportasi').val(data.transportasi);
                    $('#dewasa').val(data.dewasa);
                    $('#anak').val(data.anak);
                    $('#bayar').val(data.bayar);
                    $('#id').val(data.id);
                    if (data.pic === null) {
                        $('#pic').html('Belum Dibayar');
                    } else {
                        $('#pic').html('Penerima : ' + data.pic);
                    }
                }
            });
        });

        $('.diterima').on('click', function() {
            $('#id').val($(this).data('id'))
        });

        $('.dihapus').on('click', function() {
            $('#idhapus').val($(this).data('id'))
        });

        $('.updatedata').on('click', function() {
            var id = $('#id').val(),
                nama = $('#modalnama').val(),
                anggota = $('#anggota').val(),
                transportasi = $('#transportasi').val(),
                dewasa = $('#dewasa').val(),
                anak = $('#anak').val(),
                bayar = $('#bayar').val(),
                keyword = $('#keywordpanitia').val(),
                page = 1,
                baseurl = $('#baseurl').val();
            $.ajax({
                url: method_url(baseurl, 'Home', 'updatedata'),
                data: {
                    id: id,
                    nama: nama,
                    anggota: anggota,
                    transportasi: transportasi,
                    dewasa: dewasa,
                    anak: anak,
                    bayar: bayar,
                    keyword: keyword,
                    page: page,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.tabelDataPendaftaran').html(data);
                }
            });
        });

        $('.setor').on('click', function() {
            var jumlah = $('#jumlahSetor').val(),
                baseurl = $('#baseurl').val();
            $.ajax({
                url: method_url(baseurl, 'Home', 'setor'),
                data: {
                    jumlah: jumlah,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.tabelDataPendaftaran').html(data);
                }
            });
        });

        $('.terima').on('click', function() {
            var id = $('#id').val(),
                baseurl = $('#baseurl').val();
            $.ajax({
                url: method_url(baseurl, 'Home', 'updatesetor'),
                data: {
                    id: id,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.tabelDataSetoran').html(data);
                }
            });
        });

        $('.hapus').on('click', function() {
            var id = $('#idhapus').val(),
                baseurl = $('#baseurl').val();
            $.ajax({
                url: method_url(baseurl, 'Home', 'deletejemaat'),
                data: {
                    id: id,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.tabelDataPendaftaran').html(data);
                }
            });
        });

        $(".linkD").on('click', function() {
            var page = $(this).data('page'),
                baseurl = $('#baseurl').val(),
                keyword = $('#keyword').val();
            $.ajax({
                url: method_url(baseurl, 'Home', 'searchData'),
                data: {
                    keyword: keyword,
                    page: page,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.tabelDataPendaftaran').html(data);
                }
            });
        });

        $(".linkP").on('click', function() {
            var page = $(this).data('page'),
                baseurl = $('#baseurl').val(),
                keyword = $('#keywordpanitia').val();
            $.ajax({
                url: method_url(baseurl, 'Home', 'searchDataPanitia'),
                data: {
                    keyword: keyword,
                    page: page,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.tabelDataPendaftaran').html(data);
                }
            });
        });
    });
</script>