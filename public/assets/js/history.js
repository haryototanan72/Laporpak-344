// Script untuk halaman history laporan

// Inisialisasi SweetAlert2
document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi hapus laporan
    document.querySelectorAll('.btn-hapus-laporan').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data laporan akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
