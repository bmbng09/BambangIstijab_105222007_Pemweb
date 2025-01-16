<script>l
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
                fetch('/event/delete', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id })
                }).then(response => {
                    if (response.ok) {
                        alert('Jadwal berhasil dihapus!');
                        location.reload();
                    }
                });
            }
        });
    });

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            fetch(`/event/get-selected-data?id=${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Data tidak ditemukan!');
                    }
                    return response.json();
                })
                .then(data => {
                    const modal = new bootstrap.Modal(document.getElementById('editModal'));
                    document.getElementById('edit-id').value = data.id;
                    document.getElementById('edit-name').value = data.name;
                    document.getElementById('edit-start').value = data.start;
                    document.getElementById('edit-end').value = data.end;
                    modal.show();
                })
                .catch(error => {
                    console.error(error);
                    alert('Gagal mengambil data jadwal!');
                });
        });
    });

    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const id = document.getElementById('edit-id').value;
        const name = document.getElementById('edit-name').value;
        const start = document.getElementById('edit-start').value;
        const end = document.getElementById('edit-end').value;

        fetch('/event/update', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                name: name,
                start: start,
                end: end
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal memperbarui jadwal!');
                }
                return response.json();
            })
            .then(data => {
                alert(data.message || 'Jadwal berhasil diperbarui!');
                location.reload();
            })
            .catch(error => {
                console.error(error);
                alert('Terjadi kesalahan saat memperbarui jadwal!');
            });
    });
</script>
