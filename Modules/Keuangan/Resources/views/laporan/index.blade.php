@extends('adminlte::page')
@section('title', 'Laporan Bulanan')

@section('content_header')
    <h1>Laporan Bulanan</h1>
@stop

@push('css')
    <link rel="stylesheet" href="path/to/your/custom.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pencarian</h3>
                </div>
                <!-- search-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Unit</label>
                                <select class="form-control select2" id="unit-select">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Program</label>
                                <select class="form-control select2" id="perencanaan-select">
                                    <option selected="selected">Pilih Program</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Kegiatan</label>
                                <select class="form-control select2" id="subperencanaan-select">
                                    <option selected="selected">Pilih Program</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select class="form-control select2" id="year-select">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6 m-3">
                                <button type="button" class="btn btn-success">
                                    <i class="fas fa-file-excel"></i> Cetak Excel
                                </button>
                                <button type="button" class="btn btn-success">
                                    <i class="fas fa-file-pdf"></i> Cetak Pdf
                                </button>
                            </div>
                        </div>

                        <!-- chart-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="d-flex flex-column"><span><i class="fas fa-chart-line"></i> Grafik Realisasi
                                            Keuangan</span></p>
                                    <div class="position-relative mb-4">
                                        <canvas id="realisasi-keuangan" height="100px"></canvas>
                                    </div>
                                </div>
                            </div>

                            {{-- tabel rekapitulasi --}}
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="btn-group" role="group" aria-label="Table toggles">
                                        <button type="button" class="btn btn-primary" id="btn-table-1">Rekapitulasi
                                            Keuangan</button>
                                        <button type="button" class="btn btn-outline-primary" id="btn-table-2">Rekapitulasi
                                            Kendala</button>
                                    </div>

                                    <div id="table-1" class="table-responsive">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <table class="table table-hover">
                                                    <thead class="bg-primary text-white">
                                                        <tr>
                                                            <th>Bulan</th>
                                                            <th>Target</th>
                                                            <th>Realisasi</th>
                                                            <th>%Serapan Akumulatif</th>
                                                            <th>%Serapan Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>cek</td>
                                                            <td>cek</td>
                                                            <td>cek</td>
                                                            <td>cek</td>
                                                            <td>cek</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="table-2" class="table-responsive" style="display: none;">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <table class="table table-hover">
                                                    <thead class="bg-primary text-white">
                                                        <tr>
                                                            <th>Bulan</th>
                                                            <th>Unit</th>
                                                            <th>Kendala</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>cek</td>
                                                            <td>cek</td>
                                                            <td>cek</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function updateChart(year, unit, program, kegiatan) {
            var url = '/api/data?year=' + year;

            if (unit !== '') {
                url += '&unit=' + unit;
            }

            if (program !== '') {
                url += '&program=' + program;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var ctx = document.getElementById('realisasi-keuangan').getContext('2d');
                    if (window.myChart) {
                        window.myChart.destroy();
                    }
                    window.myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                                'September', 'Oktober', 'November', 'Desember'
                            ],
                            datasets: [{
                                label: 'Target Keuangan',
                                data: data.target,
                                backgroundColor: 'rgba(251, 135, 0, 1',
                                borderColor: 'rgba(251, 135, 0, 1',
                                fill: true,
                                borderWidth: 0,
                                tension: 0.5,
                                order: 2
                            }, {
                                label: 'Realisasi Keuangan',
                                data: data.realisasi,
                                backgroundColor: 'rgba(0, 128, 0, 1)',
                                borderColor: 'rgba(0, 128, 0, 1)',
                                fill: true,
                                borderWidth: 0,
                                tension: 0.5,
                                order: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            let value = tooltipItem.raw;
                                            return `${tooltipItem.label}: Rp ${value.toLocaleString('id-ID')}`;
                                        }
                                    }
                                },
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 15,
                                        padding: 20
                                    }
                                },
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching financial data:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            var yearSelect = document.getElementById('year-select');
            var unitSelect = document.getElementById('unit-select');
            var programSelect = document.getElementById('perencanaan-select');
            var kegiatanSelect = document.getElementById('subperencanaan-select');
            var currentYear = new Date().getFullYear();

            // Populate the yearSelect dropdown with options
            for (var i = currentYear; i >= currentYear - 4; i--) {
                var option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }

            function fetchUnits() {
                fetch('/api/data?year=' + currentYear)
                    .then(response => response.json())
                    .then(data => {
                        unitSelect.innerHTML = '';
                        var allOption = document.createElement('option');
                        allOption.value = '';
                        allOption.textContent = 'Semua Unit';
                        unitSelect.appendChild(allOption);

                        data.units.forEach(unit => {
                            var option = document.createElement('option');
                            option.value = unit.id;
                            option.textContent = unit.nama;
                            unitSelect.appendChild(option);
                        });

                        unitSelect.value = data.units[0].id;

                        unitSelect.dispatchEvent(new Event('change'));
                    })
                    .catch(error => console.error('Error fetching units:', error));
            }

            function fetchPrograms(unitId) {
                fetch(`/api/program?unit=${unitId}`)
                    .then(response => response.json())
                    .then(data => {
                        programSelect.innerHTML = '';
                        var allOption = document.createElement('option');
                        allOption.value = '';
                        allOption.textContent = 'Semua Program';
                        programSelect.appendChild(allOption);

                        data.programs.forEach(program => {
                            var option = document.createElement('option');
                            option.value = program.id;
                            option.textContent = program.nama;
                            programSelect.appendChild(option);
                        });

                        programSelect.disabled = false;
                        fetchKegiatan(programSelect.value);
                    })
                    .catch(error => console.error('Error fetching programs:', error));
            }

            function fetchKegiatan(programId) {
                fetch(`/api/kegiatan?program=${programId}`)
                    .then(response => response.json())
                    .then(data => {
                        kegiatanSelect.innerHTML = '';
                        var allOption = document.createElement('option');
                        allOption.value = '';
                        allOption.textContent = 'Semua Kegiatan';
                        kegiatanSelect.appendChild(allOption);

                        data.kegiatan.forEach(kegiatan => {
                            var option = document.createElement('option');
                            option.value = kegiatan.id;
                            option.textContent = kegiatan.kegiatan;
                            kegiatanSelect.appendChild(option);
                        });

                        kegiatanSelect.disabled = false;
                        updateChart(yearSelect.value, unitSelect.value, programSelect.value, kegiatanSelect
                            .value);
                    })
                    .catch(error => console.error('Error fetching kegiatan:', error));
            }

            fetchUnits();

            yearSelect.addEventListener('change', function() {
                updateChart(this.value, unitSelect.value, programSelect.value, kegiatanSelect.value);
            });

            unitSelect.addEventListener('change', function() {
                var selectedUnit = this.value;
                fetchPrograms(selectedUnit);
            });

            programSelect.addEventListener('change', function() {
                var selectProgram = this.value;
                fetchKegiatan(this.value);
            });

            kegiatanSelect.addEventListener('change', function() {
                updateChart(yearSelect.value, unitSelect.value, programSelect.value, this.value);
            });
        });
    </script>

    {{-- tabel bulanan --}}
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const table1 = document.getElementById('table-1');
            const table2 = document.getElementById('table-2');
            const btnTable1 = document.getElementById('btn-table-1');
            const btnTable2 = document.getElementById('btn-table-2');

            btnTable1.addEventListener('click', () => {
                table1.style.display = 'block';
                table2.style.display = 'none';
                btnTable1.classList.add('btn-primary');
                btnTable1.classList.remove('btn-outline-primary');
                btnTable2.classList.add('btn-outline-primary');
                btnTable2.classList.remove('btn-primary');
            });

            btnTable2.addEventListener('click', () => {
                table1.style.display = 'none';
                table2.style.display = 'block';
                btnTable1.classList.add('btn-outline-primary');
                btnTable1.classList.remove('btn-primary');
                btnTable2.classList.add('btn-primary');
                btnTable2.classList.remove('btn-outline-primary');
            });
        });
    </script>

    {{-- AJAX untuk mendapatkan perencanaan berdasarkan unit --}}
    {{-- <script>
        $('#unit-select').change(function() {
            var unitId = $(this).val();
            $('#perencanaan-select').prop('disabled', true).html('<option selected="selected">Memuat...</option>');
            $('#subperencanaan-select').prop('disabled', true).html(
                '<option selected="selected">Pilih Kegiatan</option>');

            if (unitId) {
                $.ajax({
                    type: 'GET',
                    url: '/api/getPerencanaanByUnit/' + unitId,
                    success: function(data) {
                        var options = '<option selected="selected">Pilih Program</option>';
                        data.forEach(function(perencanaan) {
                            options += '<option value="' + perencanaan.id + '">' + perencanaan
                                .nama + '</option>';
                        });
                        $('#perencanaan-select').html(options).prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + ' - ' + error);
                        $('#perencanaan-select').html(
                            '<option selected="selected">Error memuat data</option>');
                    }
                });
            } else {
                $('#perencanaan-select').html('<option selected="selected">Pilih Program</option>').prop('disabled',
                    true);
            }
        });

        $('#perencanaan-select').change(function() {
            var perencanaanId = $(this).val();
            $('#subperencanaan-select').prop('disabled', true).html(
                '<option selected="selected">Memuat...</option>');

            if (perencanaanId) {
                $.ajax({
                    type: 'GET',
                    url: '/api/getSubPerencanaanByPerencanaan/' + perencanaanId,
                    success: function(data) {
                        var options = '<option selected="selected">Pilih Kegiatan</option>';
                        data.forEach(function(subperencanaan) {
                            options += '<option value="' + subperencanaan.id + '">' +
                                subperencanaan.kegiatan + '</option>';
                        });
                        $('#subperencanaan-select').html(options).prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + ' - ' + error);
                        $('#subperencanaan-select').html(
                            '<option selected="selected">Error memuat data</option>');
                    }
                });
            } else {
                $('#subperencanaan-select').html('<option selected="selected">Pilih Kegiatan</option>').prop(
                    'disabled', true);
            }
        });
    </script> --}}
@endpush
