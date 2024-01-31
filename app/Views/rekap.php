<div class="row">
      <div class="col-md-12">
          <div class="box box-danger box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Rekap Absensi</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-primary btn-x btn-flat" onclick="exportExcel()">
    <i class="fa fa-fax"></i> Export to Excel
</button>

                <button id="add" type="button" class="btn btn-primary btn-xm btn-flat" data-toggle="modal" data-target="#add">
                    <i href="<?= base_url('Absensi')?>" class="fa fa-plus"></i>Add</button>
             </div>
              <script>
        document.getElementById("add").addEventListener("click", function() {
            window.location.href = "<?= base_url('absensi')?>"; // Ganti dengan URL tujuan yang sesuai
        });
    </script>
</div>
<!-- /.box-tools -->
</div>
<form action="<?= base_url('Rekap/prosesTampilanHasil') ?>" method="post" autocomplete="off">
<div class="form-group">
<label for="rapat">Pilih Sesi ke :</label>
    <select name="rapat" id="rapat" onchange="onChangeSelect()" >
        <?php foreach ($rapat as $t): ?>
            <option value="<?= $t->id_rapat ?>"><?= $t->rapat ?></option>
        <?php endforeach; ?>
    </select>
<label for="tanggal">Pilih Tanggal:</label>
    <input type="date" class="form-control" name="tanggal" id="tanggal" onchange="onChangeSelect()">
    <button type="submit">Tampilkan Hasil</button>
    </div>
    </form>
    <style>
    .form-group {
    display: flex;
    align-items: center; /* Center items vertically */
}

/* Optional: Add some spacing between elements */
.form-group label,
.form-group select,
.form-group input,
.form-group button {
    margin-right: 10px;
}

</style>
<!-- ... Bagian HTML lainnya ... -->

<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        // Setel nilai awal dari session
        var selectedValue = <?= json_encode(['rapat' => session()->get('selected_rapat'), 'tanggal' => session()->get('selected_tanggal')]) ?>;

        if (selectedValue) {
            document.getElementById('rapat').value = selectedValue.rapat;
            document.getElementById('tanggal').value = selectedValue.tanggal;
        }

        // Fungsi yang dipanggil ketika nilai diubah
        window.onChangeSelect = function () {
            // Simpan nilai yang dipilih ke dalam session
            selectedValue = {
                id_rapat: document.getElementById('rapat').value,
                tanggal: document.getElementById('tanggal').value
            };
        };
    });
    function exportExcel() {
        var selectedTanggal = document.getElementById("tanggal").value;
        var selectedRapat = document.getElementById("rapat").value; // tambahkan ini jika diperlukan

        window.location.href = "<?= base_url('Rekap/exportExcel/') ?>" + selectedTanggal + "/" + selectedRapat;
    }
</script>

<table class="table table-bordered">
    <thead>
        <tr>
        <th width="50px">No</th>
            <th width="150px">Nama</th>
            <th width="150px">Nomor Pekerja</th>
            <th width="150px">Jabatan</th>    
            <th width="150px">Absen</th>
            <!-- tambahkan kolom-kolom lainnya sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($absen as $data): ?>
            <tr>
            <td><?= $no++; ?></td>
                <td><?= $data->nama ?></td>
                <td><?= $data->no_peg ?></td>
                <td><?= $data->jabatan ?></td>
                <td><?= $data->absensi ?></td>
                <!-- tambahkan kolom-kolom lainnya sesuai kebutuhan -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- <script>
    var selectedDate = document.getElementById('tanggal').value; // Simpan tanggal yang dipilih
    var selectedRapat = document.getElementById('rapat').value; // Simpan nilai rapat yang dipilih

    function onChangeSelect() {
        selectedDate = document.getElementById('tanggal').value; // Update nilai tanggal
        selectedRapat = document.getElementById('rapat').value; // Update nilai rapat
    }
    </script>
<script>
   function exportExcel() {
    var selectedTanggal = document.getElementById("tanggal").value;
    var selectedRapat = document.getElementById("rapat").value; // tambahkan ini jika diperlukan

    window.location.href = "<?= base_url('Rekap/exportExcel/') ?>" + selectedTanggal + "/" + selectedRapat;
}

    // Fungsi yang dipanggil ketika nilai diubah
    function onChangeSelect() {
        // ... (sesuaikan dengan kebutuhan)
    }
</script> -->