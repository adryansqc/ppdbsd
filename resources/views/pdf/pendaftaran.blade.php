<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 16px;
            font-weight: normal;
        }

        .header p {
            margin: 2px 0;
            font-size: 10px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background-color: #f0f0f0;
            padding: 8px;
            font-weight: bold;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .form-row {
            display: flex;
            margin-bottom: 8px;
            align-items: flex-start;
        }

        .form-label {
            width: 35%;
            font-weight: bold;
            padding-right: 10px;
        }

        .form-value {
            width: 65%;
            border-bottom: 1px dotted #999;
            min-height: 16px;
            padding-bottom: 2px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        .status-proses {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-diterima {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
        }

        .signature-box {
            width: 200px;
            height: 80px;
            border: 1px solid #999;
            margin: 10px 0;
            display: inline-block;
            text-align: center;
            vertical-align: top;
        }

        .document-list {
            list-style: none;
            padding: 0;
        }

        .document-list li {
            margin-bottom: 5px;
            padding-left: 20px;
            position: relative;
        }

        .document-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: green;
            font-weight: bold;
        }

        .document-list li.missing:before {
            content: "✗";
            color: red;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>FORMULIR PENDAFTARAN PPDB</h1>
        <h2>{{ $config['app_name'] }}</h2>
        <p>{{ $config['alamat'] }}</p>
        <p>Telp: {{ $config['phone'] }} | Email: {{ $config['email'] }}</p>
    </div>

    <!-- Status Pendaftaran -->
    <div class="section">
        <div class="form-row">
            <div class="form-label">Status Pendaftaran:</div>
            <div class="form-value">
                <span class="status-badge status-{{ $pendaftaran->status_pendaftaran }}">
                    {{ ucfirst($pendaftaran->status_pendaftaran) }}
                </span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">Tanggal Pendaftaran:</div>
            <div class="form-value">{{ $pendaftaran->created_at->format('d F Y') }}</div>
        </div>
        @if($pendaftaran->keterangan)
        <div class="form-row">
            <div class="form-label">Keterangan:</div>
            <div class="form-value">{{ $pendaftaran->keterangan }}</div>
        </div>
        @endif
    </div>

    <!-- Data Pribadi Siswa -->
    <div class="section">
        <div class="section-title">A. DATA PRIBADI SISWA</div>

        <div class="form-row">
            <div class="form-label">Nama Lengkap:</div>
            <div class="form-value">{{ $pendaftaran->nama_lengkap ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Tempat, Tanggal Lahir:</div>
            <div class="form-value">
                {{ $pendaftaran->tempat_lahir ?? '-' }},
                {{ $pendaftaran->tanggal_lahir ? \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d F Y') : '-' }}
            </div>
        </div>

        <div class="form-row">
            <div class="form-label">Jenis Kelamin:</div>
            <div class="form-value">{{ $pendaftaran->jenis_kelamin ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Agama:</div>
            <div class="form-value">{{ $pendaftaran->agama ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Alamat:</div>
            <div class="form-value">{{ $pendaftaran->alamat ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">No. Telepon:</div>
            <div class="form-value">{{ $pendaftaran->no_telepon ?? '-' }}</div>
        </div>
    </div>

    <!-- Data Orang Tua -->
    <div class="section">
        <div class="section-title">B. DATA ORANG TUA/WALI</div>

        <div class="form-row">
            <div class="form-label">Nama Ayah:</div>
            <div class="form-value">{{ $pendaftaran->nama_ayah ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Nama Ibu:</div>
            <div class="form-value">{{ $pendaftaran->nama_ibu ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Pekerjaan Ayah:</div>
            <div class="form-value">{{ $pendaftaran->pekerjaan_ayah ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Pekerjaan Ibu:</div>
            <div class="form-value">{{ $pendaftaran->pekerjaan_ibu ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Alamat Orang Tua:</div>
            <div class="form-value">{{ $pendaftaran->alamat_ortu ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">No. Telepon Orang Tua:</div>
            <div class="form-value">{{ $pendaftaran->no_telepon_ortu ?? '-' }}</div>
        </div>
    </div>

    <!-- Data Sekolah Asal -->
    <div class="section">
        <div class="section-title">C. DATA SEKOLAH ASAL</div>

        <div class="form-row">
            <div class="form-label">Asal Sekolah (TK):</div>
            <div class="form-value">{{ $pendaftaran->asal_sekolah ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Alamat Sekolah:</div>
            <div class="form-value">{{ $pendaftaran->alamat_sekolah ?? '-' }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">Tahun Lulus:</div>
            <div class="form-value">{{ $pendaftaran->tahun_lulus ?? '-' }}</div>
        </div>
    </div>

    <!-- Dokumen Persyaratan -
    <!-- Footer -->
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</p>

        <div style="margin-top: 40px;">
            <div style="display: inline-block; width: 45%; text-align: center;">
                <p>Orang Tua/Wali</p>
                <div class="signature-box">
                    <br><br><br>
                    <p style="margin: 0;">(...........................)</p>
                </div>
            </div>

            <div style="display: inline-block; width: 45%; text-align: center; margin-left: 10%;">
                <p>Petugas Pendaftaran</p>
                <div class="signature-box">
                    <br><br><br>
                    <p style="margin: 0;">(...........................)</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>