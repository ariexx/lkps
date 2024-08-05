<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosenIndustriPraktisiRequest;
use App\Http\Requests\StoreDosenTidakTetapRequest;
use App\Models\DosenIndustriPraktisi;
use App\Models\DosenPembimbing;
use App\Models\DosenTetapPerguruanTinggi;
use App\Models\DosenTidakTetap;
use App\Models\EWMP;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class ProfileDosenController extends Controller
{
    public function __construct(
        public DosenTidakTetap $dosenTidakTetap,
        public DosenIndustriPraktisi $dosenIndustriPraktisi,
        public DosenTetapPerguruanTinggi $dosenTetapPerguruanTinggi,
        public DosenPembimbing $dosenPembimbingTugasAkhir,
        public EWMP $ewmp,
        public $alreadyInserted = false
    )
    {
        //check if user already inserted data in dosen_tidak_tetap, dosen_industri_praktisi, and dosen_tetap_perguruan_tinggi
        $this->alreadyInserted = $this->dosenTidakTetap->where('user_id', user()->id)->exists()
            || $this->dosenIndustriPraktisi->where('user_id', user()->id)->exists()
            || $this->dosenTetapPerguruanTinggi->where('user_id', user()->id)->exists()
            || $this->dosenPembimbingTugasAkhir->where('user_id', user()->id)->exists();
    }

    public function showDosenTidakTetap()
    {
        $dosenTidakTetap = $this->dosenTidakTetap->getAll();
        return view('dosen.profile.dosen_tidak_tetap', compact('dosenTidakTetap'));
    }

    public function storeDosenTidakTetap(StoreDosenTidakTetapRequest $request)
    {
        if ($this->alreadyInserted) {
            return redirect()->route('dosen.dosen-tidak-tetap')->with('error', 'Anda sudah mengisi data dosen');
        }

        try {
            $request['user_id'] = user()->id;
            $this->dosenTidakTetap->create($request->validated());
            return redirect()->route('dosen.dosen-tidak-tetap')->with('success', 'Data dosen tidak tetap berhasil ditambahkan');
        } catch (\Exception $e) {
             return redirect()->route('dosen.dosen-tidak-tetap.create')->with('error', 'Data dosen tidak tetap gagal ditambahkan');
        }
    }

    public function showDosenIndustriPraktisi()
    {
        $dosenIndustriPraktisi = $this->dosenIndustriPraktisi->whereUserId(user()->id)->get();
        return view('dosen.profile.dosen_industri_praktisi', compact('dosenIndustriPraktisi'));
    }

    public function storeDosenIndustriPraktisi(Request $request)
    {
        if ($this->alreadyInserted) {
            return redirect()->route('dosen.dosen-industri-praktisi')->with('error', 'Anda sudah mengisi data dosen');
        }

        try {
            $request['user_id'] = user()->id;
            $this->dosenIndustriPraktisi->create($request->all());
            return redirect()->route('dosen.dosen-industri-praktisi')->with('success', 'Data dosen industri praktisi berhasil ditambahkan');
        } catch (\Exception $e) {
             return redirect()->route('dosen.dosen-industri-praktisi.create')->with('error', 'Data dosen industri praktisi gagal ditambahkan');
        }
    }

    public function showDosenTetapPerguruanTinggi()
    {
        $dosenTetapPerguruanTinggi = $this->dosenTetapPerguruanTinggi->whereUserId(user()->id)->get();
        return view('dosen.profile.dosen_tetap_perguruan_tinggi', compact('dosenTetapPerguruanTinggi'));
    }

    public function storeDosenTetapPerguruanTinggi(Request $request)
    {
        if ($this->alreadyInserted) {
            return redirect()->route('dosen.dosen-tetap-perguruan-tinggi')->with('error', 'Anda sudah mengisi data dosen');
        }

        try {
            $request['user_id'] = user()->id;
            $this->dosenTetapPerguruanTinggi->create($request->all());
            return redirect()->route('dosen.dosen-tetap-perguruan-tinggi')->with('success', 'Data dosen tetap perguruan tinggi berhasil ditambahkan');
        } catch (\Exception $e) {
             return redirect()->route('dosen.dosen-tetap-perguruan-tinggi.create')->with('error', 'Data dosen tetap perguruan tinggi gagal ditambahkan #1');
        } catch (NotFoundExceptionInterface $e) {
            return redirect()->route('dosen.dosen-tetap-perguruan-tinggi.create')->with('error', 'Data dosen tetap perguruan tinggi gagal ditambahkan #2');
        } catch (ContainerExceptionInterface $e) {
            return redirect()->route('dosen.dosen-tetap-perguruan-tinggi.create')->with('error', 'Data dosen tetap perguruan tinggi gagal ditambahkan #3');
        }
    }

    public function editDosenTetapPerguruanTinggi($id)
    {
        $dosenTetapPerguruanTinggi = $this->dosenTetapPerguruanTinggi->find($id);
        return view('dosen.profile.edit_dosen_tetap_perguruan_tinggi', compact('dosenTetapPerguruanTinggi'));
    }

    public function updateDosenTetapPerguruanTinggi(Request $request, $id)
    {
        try {
            $this->dosenTetapPerguruanTinggi->find($id)->update($request->all());
            return redirect()->route('dosen.dosen-tetap-perguruan-tinggi')->with('success', 'Data dosen tetap perguruan tinggi berhasil diubah');
        } catch (\Exception $e) {
             return redirect()->route('dosen.dosen-tetap-perguruan-tinggi.edit', $id)->with('error', 'Data dosen tetap perguruan tinggi gagal diubah');
        }
    }

    public function showDosenPembimbingUtamaTugasAkhir()
    {
        $dosenPembimbingUtamaTugasAkhir = $this->dosenPembimbingTugasAkhir->whereUserId(user()->id)->get();
        $rataRataTS = $this->dosenPembimbingTugasAkhir->rataRataTS();
        $rataRataTSLain = $this->dosenPembimbingTugasAkhir->rataRataTSLain();
        $rata = $this->dosenPembimbingTugasAkhir->rataRataSemua();
        return view('dosen.profile.dosen_pembimbing_utama_tugas_akhir', compact('dosenPembimbingUtamaTugasAkhir', 'rataRataTS', 'rataRataTSLain', 'rata'));
    }

    public function storeDosenPembimbingUtamaTugasAkhir(Request $request)
    {
        try {
            $request['user_id'] = user()->id;
            $this->dosenPembimbingTugasAkhir->create($request->all());
            return redirect()->route('dosen.dosen-pembimbing-utama-tugas-akhir')->with('success', 'Data dosen pembimbing utama tugas akhir berhasil ditambahkan');
        } catch (\Exception $e) {
             return redirect()->route('dosen.dosen-pembimbing-utama-tugas-akhir.create')->with('error', $e);
        }
    }

    public function editDosenPembimbingUtamaTugasAkhir($id)
    {
        $dosenPembimbing = $this->dosenPembimbingTugasAkhir->find($id);
        return view('dosen.profile.edit_dosen_pembimbing_utama_tugas_akhir', compact('dosenPembimbing'));
    }

    public function updateDosenPembimbingUtamaTugasAkhir(Request $request, $id)
    {
        try {
            $this->dosenPembimbingTugasAkhir->find($id)->update($request->all());
            return redirect()->route('dosen.dosen-pembimbing-utama-tugas-akhir')->with('success', 'Data dosen pembimbing utama tugas akhir berhasil diubah');
        } catch (\Exception $e) {
             return redirect()->route('dosen.dosen-pembimbing-utama-tugas-akhir.edit', $id)->with('error', 'Data dosen pembimbing utama tugas akhir gagal diubah');
        }
    }

    public function showEWMPDosenTetapPerguruanTinggi()
    {
        $ewmp = $this->ewmp->getAll();
        $rataRataJumlah = $this->ewmp->rataRataJumlah();
        $rataRataSKS = $this->ewmp->rataRataSKS();
        return view('dosen.profile.ewmp_dosen_tetap_perguruan_tinggi', compact('ewmp', 'rataRataJumlah', 'rataRataSKS'));
    }

    public function storeEWMPDosenTetapPerguruanTinggi(Request $request)
    {
        try {
            if(is_null($request->dtps)) {
                $request['dtps'] = 0;
            }
            $this->ewmp->create($request->all());
            return redirect()->route('dosen.ewmp-dosen-tetap-perguruan-tinggi')->with('success', 'Data ewmp dosen tetap perguruan tinggi berhasil ditambahkan');
        } catch (\Exception $e) {
             return redirect()->route('dosen.ewmp-dosen-tetap-perguruan-tinggi.create')->with('error', $e);
        }
    }

    public function editEWMPDosenTetapPerguruanTinggi($id)
    {
        $ewmp = $this->ewmp->find($id);
        return view('dosen.profile.edit_ewmp_dosen_tetap_perguruan_tinggi', compact('ewmp'));
    }

    public function updateEWMPDosenTetapPerguruanTinggi(Request $request, $id)
    {
        try {
            $this->ewmp->find($id)->update($request->all());
            return redirect()->route('dosen.ewmp-dosen-tetap-perguruan-tinggi')->with('success', 'Data ewmp dosen tetap perguruan tinggi berhasil diubah');
        } catch (\Exception $e) {
             return redirect()->route('dosen.ewmp-dosen-tetap-perguruan-tinggi.edit', $id)->with('error', 'Data ewmp dosen tetap perguruan tinggi gagal diubah');
        }
    }
}
