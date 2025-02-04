// Ini adalah file JS yang berisi script untuk halaman auth 
        {/* // Toggle fields khusus mahasiswa */}
        document.querySelector('select[name="role"]').addEventListener('change', function() {
            const mahasiswaFields = document.querySelector('.mahasiswa-fields');
            if (this.value === 'mahasiswa') {
                mahasiswaFields.style.display = 'block';
            } else {
                mahasiswaFields.style.display = 'none';
            }
        });
  