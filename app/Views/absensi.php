<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 300px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        textarea, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
  

</head>
<body>



    <div class="card">
    <?php
if (session()->getFlashdata('pesan')) {
    echo '<div class="card">';
    echo session()->getFlashdata('pesan') ;
    echo '</div>';
}
?>
<br>
        <form action="<?= base_url('Absensi/rekap'); ?>" method="post" >
            <div class="form-group">
                <label>Nama</label>
                <textarea name="nama" rows="1" placeholder="Silahkan Isi dengan nama anda" required></textarea>
            </div>
            <div class="form-group">
                <label>Nomor Pekerja</label>
                <textarea name="no_peg" rows="1" placeholder="Silahkan Isi dengan NIP atau NO KTP" required></textarea>
            </div>
            <div class="form-group">
                <label>jabatan</label>
                <textarea name="jabatan" rows="1" placeholder="Silahkan Isi dengan jabatan anda" required></textarea>
            </div>
            <div class="form-group">
                <label for="absensi">Absensi :</label>
                <select name="absensi"  class="form-control" required>
                    <option value="Hadir"> Hadir</option>
                    <option value="Izin">Izin</option>
                </select>
            </div>
            <div class="form-group">
                <label>Sesi ke- :</label>
                  <select name="rapat" class="form-control" required>
                  <option value="">--Pilih--</option>
                    <?php foreach ($rapat as $value):?>
                      <option value="<?= $value->id_rapat ?>"><?= $value->rapat?></option>
                      <?php endforeach ?>
                  </select>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
