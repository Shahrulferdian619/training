<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 class="nama">Shahrul</h1>
    <input class="test" type="text" data-input="10">
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="tbody"></tbody>
    </table>

<form class="store">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <label for="">nama</label>
    <input type="text" name="nama" class="namaa">

    <label for="">alamat</label>
    <input type="text" name="alamat" class="alamat">
    <button type="submit">Save</button>
</form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // console.log($('h1').text())

            // $('.nama').mouseover(function () { 
            //     $(this).hide()
            // });

            // $('.nama').mouseleave(function () { 
            //     $(this).show()
            // });

            $('.nama').on('click', function(){
                // $(this).fadeOut()
            })

            const data = $('input').attr('data-input');
            // console.log(data);
            $('.test').val(data);

            $.ajax({
                type: "get",
                url: "{{ route('get-json') }}",
                dataType: "json",
                success: function (response) {
                    response.forEach(nigga => {
                        let idDetail = "{{ route('get-json-id', ':id') }}"
                        let dataId = idDetail.replace(':id', nigga.id)

                        let tr = `
                            <tr>
                                <td>${nigga.nama}</td>    
                                <td>${nigga.alamat}</td>    
                                <td>
                                    <a href="${dataId}">Detail</a>
                                </td>    
                            </tr>
                        `

                        $('.tbody').append(tr)
                    });
                }
            });

            $('.store').submit(function (e) { 
                e.preventDefault();
                
                let nama = $('.namaa').val();
                let alamat = $('.alamat').val();
                let csrfToken = $('input[name="_token"]').val();
                console.log(nama, alamat);

                $.ajax({
                    type: "post",
                    url: "{{ route('store-json') }}",
                    data: {
                        nama: nama,
                        alamat: alamat,
                        _token: csrfToken
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        // Coba menggunakan window.location.replace untuk memuat ulang halaman
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });           

            $('.edit').on('click', function () {
                
            });
        });
    </script>
</body>
</html>