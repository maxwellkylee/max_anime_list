$(document).ready(function () {
    loadAnimeList();
    let animeData = [];
    let sortColumn = "";
    let sortDirection = "asc";

    function openModal() {
        $('#modal-overlay').fadeIn();
        $('#anime-modal').fadeIn();
    }

    function closeModal() {
        $('#modal-overlay').fadeOut();
        $('#anime-modal').fadeOut();
        $('#anime-form')[0].reset();
        $('#ani_ID').val('');
    }

    function showSuccessModal(message) {
        $('#success-modal p').text(message);
        $('#success-modal').fadeIn();
        setTimeout(() => {
            $('#success-modal').fadeOut();
        }, 2000);
    }

    $('#add-anime').click(function () {
        openModal();
    });

    $('.close-modal, #modal-overlay').click(function () {
        closeModal();
    });

    $(document).on('click', '.edit-btn', function () {
        const ani_ID = $(this).data('id');
        $.ajax({
            url: './connection.php',
            method: 'GET',
            success: function (data) {
                animeData = JSON.parse(data);
                const anime = animeData.find(a => a.ani_ID == ani_ID);

                if (anime) {
                    $('#ani_ID').val(anime.ani_ID);
                    $('#jap_name').val(anime.jap_name);
                    $('#eng_name').val(anime.eng_name);
                    $('#season').val(anime.season);
                    $('#eps').val(anime.eps);
                    $('#stat').val(anime.stat);
                    $('#watched').val(anime.watched);

                    openModal();
                }
            }
        });
    });

    $('#anime-form').submit(function (e) {
        e.preventDefault();

        const formData = {
            action: $('#ani_ID').val() ? 'edit' : 'add',
            ani_ID: $('#ani_ID').val(),
            jap_name: $('#jap_name').val(),
            eng_name: $('#eng_name').val(),
            season: $('#season').val(),
            eps: $('#eps').val(),
            stat: $('#stat').val(),
            watched: $('#watched').val()
        };

        $.ajax({
            url: './connection.php',
            method: 'POST',
            data: formData,
            success: function () {
                showSuccessModal('Anime saved successfully!');
                closeModal();
                loadAnimeList();
            }
        });
    });

    $('#search-input').on('input', function () {
        const searchTerm = $(this).val().toLowerCase();
        filterAnimeList(searchTerm);
    });

    function filterAnimeList(searchTerm) {
        $('.listahan').each(function () {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(searchTerm));
        });
    }

    function loadAnimeList() {
        $.ajax({
            url: './connection.php',
            method: 'GET',
            success: function (data) {
                animeData = JSON.parse(data);
                renderAnimeList();
            }
        });
    }

    function renderAnimeList() {
        const tbody = $('#anime-list');
        tbody.empty();

        animeData.forEach(anime => {
            tbody.append(`
                <tr class="listahan">
                    <td class="aniname">${anime.jap_name}</td>
                    <td class="aniname">${anime.eng_name}</td>
                    <td>${anime.season}</td>
                    <td>${anime.eps}</td>
                    <td>${anime.stat}</td>
                    <td>${anime.watched}</td>
                    <td class="pindutanSaScr">
                        <button class="edit-btn" data-id="${anime.ani_ID}">Edit</button>
                        <button class="delete-btn" data-id="${anime.ani_ID}">Delete</button>
                    </td>
                </tr>
            `);
        });

        $('.delete-btn').click(function () {
            const ani_ID = $(this).data('id');
            $.ajax({
                url: './connection.php',
                method: 'POST',
                data: { action: 'delete', ani_ID },
                success: function () {
                    showSuccessModal('Anime deleted successfully!');
                    loadAnimeList();
                }
            });
        });
    }

    $('.sortable').click(function () {
        const column = $(this).data('column');

        if (sortColumn === column) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortColumn = column;
            sortDirection = 'asc';
        }

        animeData.sort((a, b) => {
            const valA = a[column].toString().toLowerCase();
            const valB = b[column].toString().toLowerCase();

            if (valA < valB) return sortDirection === 'asc' ? -1 : 1;
            if (valA > valB) return sortDirection === 'asc' ? 1 : -1;
            return 0;
        });

        $('.sortable').removeClass('ascending descending');
        $(this).addClass(sortDirection === 'asc' ? 'ascending' : 'descending');

        renderAnimeList();
    });
});
