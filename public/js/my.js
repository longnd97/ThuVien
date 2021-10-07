$(document).ready(function () {
    let origin = location.origin;
    $('#search-student-borrow').keyup(function () {
        let value = $(this).val();
        if (value) {
            $.ajax({
                url: origin + '/admin/borrows/search-student/',
                method: 'GET',
                data: {
                    keyword: value
                },
                success: function (res) {
                    let html = '';
                    res.forEach(function (item, index) {
                        html += '<button data-id="' + item.id + '" class="list-group-item list-group-item-action student-item">';
                        html += item.name;
                        html += '</button>'
                    })
                    $('#list-student-borrow-search').html(html);
                    console.log(res)
                },
                error: function (error) {
                    console.log(error)
                }
            })
        } else {
            $('#list-student-borrow-search').html('');
        }
    })

    $('body').on('click', '.student-item', function () {
        let idStudentClicked = $(this).attr('data-id');
        $.ajax({
            url: origin + '/admin/borrows/find-student/' + idStudentClicked,
            method: 'GET',
            success: function (res) {
                $('#name-student-borrow').val(res.name);
                $('#email-student-borrow').val(res.email);
                $('#phone-student-borrow').val(res.phone);
                $('#student-id').val(res.id);
                $('#list-student-borrow-search').html('');
            }
        })
    });

    $('#search-book').keyup(function () {
        let value = $(this).val();
        if (value) {
            $.ajax({
                url: origin + '/admin/borrows/search-book/',
                method: 'GET',
                data: {
                    keyword: value
                },
                success: function (res) {
                    let html = '';
                    res.forEach(function (item, index) {
                        html += '<button data-id="' + item.id + '" class="list-group-item list-group-item-action book-item">';
                        html += item.name;
                        html += '</button>'
                    })
                    $('#list-book-search').html(html);
                    console.log(res)
                },
                error: function (error) {
                    console.log(error)
                }
            })
        } else {
            $('#list-book-search').html('');
        }
    })
    $('body').on('click', '.book-item', function () {
        let idBookClicked = $(this).attr('data-id');
        $.ajax({
            url: origin + '/admin/borrows/find-book/' + idBookClicked,
            method: 'GET',
            success: function (res) {
                console.log(res.status)
                $('#choseBook').hide();
                let html = '<td>';
                html += res.name;
                html += '</td>';
                html += ' <td>';
                html += '<img width="80" src="http://127.0.0.1:8000/storage/' + res.image + '">';
                html += '</td>';
                if (res.status == 1) {
                    html += '<td class="text-success"><i class="fas fa-circle"></i> Có thể mượn';
                } else {
                    html += '<td class="text-danger"><i class="fas fa-circle"></i> Chưa thể mượn';
                }
                html += '</td>';
                $('#book-id').val(res.id);
                $('#book-item').html(html);
                $('#book-status').val(res.status);
                $('#list-book-search').html('');
            }
        });
    });
    $('#create-borrow').click(function () {
        let student_id = $('#student-id').val();
        let book_id = $('#book-id').val();
        let borrow_date = $('#borrow_date').val();
        let return_date = $('#return_date').val();
        let book_status = $('#book-status').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: origin + '/admin/borrows/create',
            method: 'POST',
            data: {
                student_id: student_id,
                book_id: book_id,
                borrow_date: borrow_date,
                return_date: return_date,
                book_status: book_status
            },
            success: function (res) {
                if (res === 'Cho mượn thành công') {
                    alert(res);
                    window.location.assign(origin + "/admin/borrows");
                } else {
                    alert(res);
                }
            },
            error: function (error) {
                console.log(error);
            }
        })
    })
    $('.confirm-return').click(function () {
        let idBorrow = $(this).attr('data-id');
        $.ajax({
            url: origin + '/admin/borrows/' + idBorrow + '/confirmReturn',
            method: 'GET',
            dataType: 'json',
            success: function (res) {
                alert(res);
                window.location.assign(origin + "/admin/borrows")
            }
        })
    })
});
