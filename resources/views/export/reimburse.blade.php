<h1>Data Reimburse</h1>
<table>
    <thead>
    <tr>
        <th>No. Klaim</th>
        <th>Nama Pasien</th>
        <th>Gol. Darah</th>
        <th>Jenis Kelamin</th>
        <th>Harga Tindakan</th>
        <th>Tindakan</th>
        <th>Harga Obat</th>
        <th>Obat</th>
        <th>Harga Lab</th>
        <th>Lab</th>
        <th>Status Klaim</th>
        <th>Dilayani Oleh</th>
    </tr>
    </thead>
    <tbody>
    @foreach($collect as $item)
        <tr>
            <td>{{ $item->no_klaim }}</td>
            <td>{{ $item->nama_lengkap }}</td>
            <td>{{ $item->golongan_darah }}</td>
            <td>{{ $item->jenis_kelamin }}</td>
            <td>{{ $item->harga_tindakan }}</td>
            <td>{{ $item->tindakan }}</td>
            <td>{{ $item->harga_obat }}</td>
            <td>{{ $item->obat }}</td>
            <td>{{ $item->harga_lab }}</td>
            <td>{{ $item->lab }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->dilayani_oleh }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
