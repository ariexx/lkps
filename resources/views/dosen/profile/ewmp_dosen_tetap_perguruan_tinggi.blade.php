@extends('adminlte::page')

@section('title', 'EWMP Dosen Tetap Perguruan Tinggi')

@section('content_header')
    <h1>EWMP Dosen Tetap Perguruan Tinggi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{route('dosen.ewmp-dosen-tetap-perguruan-tinggi.create')}}" class="btn btn-primary">Tambah Data</a>
        </div>

        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Dosen (DT)</th>
                    <th>DTPS</th>
                    <th>Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks)</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Jumlah (sks)</th>
                    <th>Rata-rata per Semester (sks)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Pendidikan: Pembelajaran dan Pembimbingan</td>
                    <td></td>
                    <td></td>
                    <td>Penelitian</td>
                    <td>PkM</td>
                    <td>Tugas Tambahan dan/atau Penunjang</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>PS yang Diakreditasi</td>
                    <td>PS Lain di dalam PT</td>
                    <td>PS Lain di luar PT</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ahmad Zakir,ST,M.Kom</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>3</td>
                    <td>30</td>
                    <td>15</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Arie Rafika Dewi,M.Kom</td>
                    <td>V</td>
                    <td>27</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>30</td>
                    <td>15</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Boni Oktaviana Sembiring,M.Kom</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>27</td>
                    <td>13.5</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Dedy Irwan,ST,M.Kom</td>
                    <td>V</td>
                    <td>22</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>25</td>
                    <td>12.5</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Edy Rahman Syahputra,ST,M.Kom</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>3</td>
                    <td>30</td>
                    <td>15</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Edrian Hadinata,M.Kom</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>27</td>
                    <td>13.5</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Eka Rahayu,M.Kom</td>
                    <td>V</td>
                    <td>26</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>29</td>
                    <td>14.5</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Fachrul Rozi Lubis,M.Kom</td>
                    <td>V</td>
                    <td>28</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>31</td>
                    <td>15.5</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Hasdiana,M.Kom</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>27</td>
                    <td>13.5</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Husni Lubis,ST,M.Kom</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>27</td>
                    <td>13.5</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Ihsan Lubis,ST,M.Kom</td>
                    <td>V</td>
                    <td>28</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>31</td>
                    <td>15.5</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Marina Elsera,ST,M.Kom</td>
                    <td>V</td>
                    <td>23</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>26</td>
                    <td>13</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Nurjamiyah,S.Kom,M.Cs </td>
                    <td>V</td>
                    <td>22</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>25</td>
                    <td>12.5</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Septiana Dewi Andriana,M.Kom</td>
                    <td>V</td>
                    <td>28</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>31</td>
                    <td>15.5</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>Yanti Faradillah Siahaan,ST,M.Si</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>27</td>
                    <td>13.5</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>Yulia Agustina Dalimunthe,ST,M.Kom</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>27</td>
                    <td>13.5</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>Tantri Hidayati Sinaga,M.Kom</td>
                    <td>V</td>
                    <td>24</td>
                    <td>0</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>27</td>
                    <td>13.5</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>Dharmawati, S.Pd, M.Hum</td>
                    <td></td>
                    <td>8</td>
                    <td>12</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>23</td>
                    <td>11.5</td>
                </tr>
                <tr>
                    <td>19</td>
                    <td>Sarudin, M.Pd.i</td>
                    <td></td>
                    <td>8</td>
                    <td>12</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>23</td>
                    <td>11.5</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>Nenna Irsa Syahputri, S.Si, M.Si</td>
                    <td></td>
                    <td>12</td>
                    <td>14</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>29</td>
                    <td>14.5</td>
                </tr>
                <tr>
                    <td>21</td>
                    <td>Sugih Ayu Pratitis, SH, M.Hum</td>
                    <td></td>
                    <td>16</td>
                    <td>18</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>37</td>
                    <td>18.5</td>
                </tr>
                <tr>
                    <td>22</td>
                    <td>Ika Sari, S.Pd., M.Pd</td>
                    <td></td>
                    <td>8</td>
                    <td>12</td>
                    <td>0</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0</td>
                    <td>23</td>
                    <td>11.5</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Rata-rata DTPS</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>27.82</td>
                    <td>13.91</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
