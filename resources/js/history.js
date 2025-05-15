document.addEventListener('DOMContentLoaded', function() {
    // Handle delete button click
    document.querySelectorAll('.btn-hapus-laporan').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const nomorLaporan = this.closest('tr').querySelector('td:nth-child(2)').textContent;
            
            Swal.fire({
                title: 'Hapus Laporan?',
                text: `Apakah Anda yakin ingin menghapus laporan nomor ${nomorLaporan}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
