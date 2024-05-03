<?php

namespace App\Controllers;

use App\Models\PaskahModel;
use DateTime;

class Home extends BaseController
{
    protected $PaskahModel;
    protected $jumlahlist = 10;
    public function __construct()
    {
        $this->PaskahModel = new PaskahModel();
    }
    public function index(): string
    {
        $data = [
            'judul' => 'Paskah'
        ];
        return view('Home/index', $data);
    }
    public function pendaftaran(): string
    {
        if (!is_null($this->request->getVar('hp'))) {
            $date = new DateTime();
            $date = $date->format('Y-m-d H:i:s');
            if (empty($this->request->getVar('anak'))) {
                $anak = 0;
            } else {
                $anak = $this->request->getVar('anak');
            }
            if (empty($this->request->getVar('dewasa'))) {
                $dewasa = 0;
            } else {
                $dewasa = $this->request->getVar('dewasa');
            }
            $anggota = $this->request->getVar('nama') . "\r\n" . $this->request->getVar('anggota');
            $datatambah = [
                'nama' => $this->request->getVar('nama'),
                'hp' => $this->request->getVar('hp'),
                'anggota' => $anggota,
                'transportasi' => $this->request->getVar('transportasi'),
                'dewasa' => $dewasa,
                'anak' => $anak,
                'updated_at' => $date
            ];
            if ($this->PaskahModel->insert($datatambah)) {
                session()->setFlashdata('pesan', 'Pendaftaran nama  ' . $this->request->getVar('nama') . ' Berhasil.');
            } else {
                session()->setFlashdata('pesan', 'Pendaftaran nama ' . $this->request->getVar('nama') . ' Gagal.');
            }
        }
        $data = [
            'judul' => 'Paskah'
        ];
        return view('Home/pendaftaran', $data);
    }
    public function panitia(): string
    {
        if (empty($this->PaskahModel->statusSummary(user()->username))) {
            $summary['pic'] = false;
            $summary['total'] = false;
        } else {
            $summary = $this->PaskahModel->statusSummary(user()->username)[0];
            if ($this->PaskahModel->setorPIC(user()->username)) {
                $summary['total'] = $summary['total'] - $this->PaskahModel->setorPIC(user()->username)[0]['total'];
            }
        }
        $page = 1;
        // d($this->PaskahModel->data_report());
        $data = [
            'judul' => 'Panitia',
            'jemaat' => $this->PaskahModel->searchpanitia("", $this->jumlahlist, 0)['tabel'],
            'pagination' => $this->pagination($page, $this->PaskahModel->searchpanitia("", $this->jumlahlist, 0)['lastpage']),
            'last' => $this->PaskahModel->searchpanitia("", $this->jumlahlist, 0)['lastpage'],
            'jumlah' => $this->PaskahModel->searchpanitia("", $this->jumlahlist, 0)['jumlah'],
            'page' => $page,
            'summary' => $summary,
        ];
        return view('Home/panitia', $data);
    }

    public function cekData()
    {
        $page = 1;
        $data = [
            'judul' => 'Pendaftaran',
            'jemaat' => $this->PaskahModel->searchhp("", $this->jumlahlist, 0)['tabel'],
            'pagination' => $this->pagination($page, $this->PaskahModel->searchhp("", $this->jumlahlist, 0)['lastpage']),
            'last' => $this->PaskahModel->searchhp("", $this->jumlahlist, 0)['lastpage'],
            'jumlah' => $this->PaskahModel->searchhp("", $this->jumlahlist, 0)['jumlah'],
            'page' => $page,
        ];
        return view('Home/cekumum', $data);
    }

    public function cekSetoran()
    {
        $rekap = $this->PaskahModel->rekapBayar();
        $bendahara = ['pic' => 'bendahara', 'total' => $this->PaskahModel->totalbendahara()];
        array_push($rekap, $bendahara);
        $page = 1;
        $data = [
            'judul' => 'Setoran',
            'setoran' => $this->PaskahModel->searchSetoran("", $this->jumlahlist, 0, 1)['tabel'],
            'pagination' => $this->pagination($page, $this->PaskahModel->searchSetoran("", $this->jumlahlist, 0, 1)['lastpage']),
            'last' => $this->PaskahModel->searchSetoran("", $this->jumlahlist, 0, 1)['lastpage'],
            'page' => $page,
            'rekap' => $rekap,
        ];
        return view('Home/ceksetoran', $data);
    }

    public function searchData()
    {
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        if ($page == 1) {
            $index = 0;
        } else {
            $index = ($page - 1) * $this->jumlahlist;
        }
        $jemaat = $this->PaskahModel->searchhp($keyword, $this->jumlahlist, $index)['tabel'];
        $last = $this->PaskahModel->searchhp($keyword, $this->jumlahlist, $index)['lastpage'];
        $jumlah = $this->PaskahModel->searchhp($keyword, $this->jumlahlist, $index)['jumlah'];
        $pagination = $this->pagination($page, $last);
        $data = [
            'jemaat' => $jemaat,
            'pagination' => $pagination,
            'last' => $last,
            'jumlah' => $jumlah,
            'page' => $page,
        ];
        echo view('Home/tabel/cekData', $data);
    }

    public function searchDataPanitia()
    {
        if (empty($this->PaskahModel->statusSummary(user()->username))) {
            $summary['pic'] = false;
            $summary['total'] = false;
        } else {
            $summary = $this->PaskahModel->statusSummary(user()->username)[0];
            if ($this->PaskahModel->setorPIC(user()->username)) {
                $summary['total'] = $summary['total'] - $this->PaskahModel->setorPIC(user()->username)[0]['total'];
            }
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        if ($page == 1) {
            $index = 0;
        } else {
            $index = ($page - 1) * $this->jumlahlist;
        }
        $jemaat = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['tabel'];
        $last = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['lastpage'];
        $jumlah = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['jumlah'];
        $pagination = $this->pagination($page, $last);
        $data = [
            'jemaat' => $jemaat,
            'pagination' => $pagination,
            'last' => $last,
            'jumlah' => $jumlah,
            'page' => $page,
            'summary' => $summary,
        ];
        echo view('Home/tabel/panitia', $data);
    }

    public function searchDataSetoran()
    {
        $rekap = $this->PaskahModel->rekapBayar();
        $bendahara = ['pic' => 'bendahara', 'total' => $this->PaskahModel->totalbendahara()];
        array_push($rekap, $bendahara);
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $data = [
            'setoran' => $this->PaskahModel->searchSetoran($keyword, $this->jumlahlist, 0, 1)['tabel'],
            'pagination' => $this->pagination($page, $this->PaskahModel->searchSetoran($keyword, $this->jumlahlist, 0, 1)['lastpage']),
            'last' => $this->PaskahModel->searchSetoran($keyword, $this->jumlahlist, 0, 1)['lastpage'],
            'page' => $page,
            'rekap' => $rekap,
        ];
        return view('Home/tabel/ceksetoran', $data);
    }

    public function pagination($page, $lastpage)
    {
        $pagination = [
            'first' => false,
            'previous' => false,
            'next' => false,
            'last' => false
        ];
        if ($lastpage == 1) {
            $pagination['number'] = [1];
        } elseif ($lastpage == 2) {
            $pagination['number'] = [1, 2];
        } elseif ($lastpage == 3) {
            $pagination['number'] = [1, 2, 3];
        } elseif ($lastpage == 4) {
            $pagination['number'] = [1, 2, 3, 4];
        } elseif ($lastpage == 5) {
            $pagination['number'] = [1, 2, 3, 4, 5];
        } else {
            if ($page >= 1 and $page <= 3) {
                $pagination['next'] = true;
                $pagination['last'] = true;
                $pagination['number'] = [1, 2, 3];
            } elseif ($page >= $lastpage - 2 and $page <= $lastpage) {
                $pagination['first'] = true;
                $pagination['previous'] = true;
                $pagination['number'] = [$lastpage - 2, $lastpage - 1, $lastpage];
            } else {
                $pagination['first'] = true;
                $pagination['previous'] = true;
                $pagination['next'] = true;
                $pagination['last'] = true;
                $pagination['number'] = [$page - 1, $page, $page + 1];
            }
        };
        $pagination['page'] = $page;
        return $pagination;
    }
    public function getdata()
    {
        echo json_encode($this->PaskahModel->getDatabyid($_POST['id'])[0]);
    }

    public function updatedata()
    {
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $id = $_POST['id'];
        $dataupdate = [
            'anggota' => $_POST['anggota'],
            'transportasi' => $_POST['transportasi'],
            'dewasa' => $_POST['dewasa'],
            'anak' => $_POST['anak'],
            'bayar' => $_POST['bayar'],
            'pic' => user()->username,
            'updated_at' => $date
        ];
        if ($this->PaskahModel->updatejemaat($dataupdate, $id)) {
            session()->setFlashdata('pesan', 'Update nama  ' . $_POST['nama'] . ' Berhasil.');
        } else {
            session()->setFlashdata('pesan', 'Update nama ' . $_POST['nama'] . ' Gagal.');
        }
        // $this->searchDataPanitia();
        if (empty($this->PaskahModel->statusSummary(user()->username))) {
            $summary['pic'] = false;
            $summary['total'] = false;
        } else {
            $summary = $this->PaskahModel->statusSummary(user()->username)[0];
            if ($this->PaskahModel->setorPIC(user()->username)) {
                $summary['total'] = $summary['total'] - $this->PaskahModel->setorPIC(user()->username)[0]['total'];
            }
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        if ($page == 1) {
            $index = 0;
        } else {
            $index = ($page - 1) * $this->jumlahlist;
        }
        $jemaat = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['tabel'];
        $last = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['lastpage'];
        $jumlah = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['jumlah'];
        $pagination = $this->pagination($page, $last);
        $data = [
            'jemaat' => $jemaat,
            'pagination' => $pagination,
            'last' => $last,
            'jumlah' => $jumlah,
            'page' => $page,
            'summary' => $summary
        ];
        echo view('Home/tabel/panitia', $data);
    }

    public function updatesetor()
    {
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $id = $_POST['id'];
        $dataupdate = [
            'status' => 1,
            'updated_at' => $date
        ];
        if ($this->PaskahModel->updatesetor($dataupdate, $id)) {
            session()->setFlashdata('pesan', 'Uang sudah diterima');
        } else {
            session()->setFlashdata('pesan', 'Uang gagal diterima');
        }
        $rekap = $this->PaskahModel->rekapBayar();
        $bendahara = ['pic' => 'bendahara', 'total' => $this->PaskahModel->totalbendahara()];
        array_push($rekap, $bendahara);
        $page = 1;
        $keyword = "";
        $data = [
            'setoran' => $this->PaskahModel->searchSetoran($keyword, $this->jumlahlist, 0, 1)['tabel'],
            'pagination' => $this->pagination($page, $this->PaskahModel->searchSetoran($keyword, $this->jumlahlist, 0, 1)['lastpage']),
            'last' => $this->PaskahModel->searchSetoran($keyword, $this->jumlahlist, 0, 1)['lastpage'],
            'page' => $page,
            'rekap' => $rekap,
        ];
        return view('Home/tabel/ceksetoran', $data);
    }

    public function setor()
    {
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $data = [
            'pic' => user()->username,
            'jumlah' => $_POST['jumlah'],
            'status' => false,
            'updated_at' => $date
        ];
        if ($this->PaskahModel->insertBendahara($data)) {
            session()->setFlashdata('pesan', 'setoran Berhasil.');
        } else {
            session()->setFlashdata('pesan', 'setoran Gagal.');
        }
        if (empty($this->PaskahModel->statusSummary(user()->username))) {
            $summary['pic'] = false;
            $summary['total'] = false;
        } else {
            $summary = $this->PaskahModel->statusSummary(user()->username)[0];
            if ($this->PaskahModel->setorPIC(user()->username)) {
                $summary['total'] = $summary['total'] - $this->PaskahModel->setorPIC(user()->username)[0]['total'];
            }
        }
        $page = 1;
        $keyword = '';
        if ($page == 1) {
            $index = 0;
        } else {
            $index = ($page - 1) * $this->jumlahlist;
        }
        $jemaat = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['tabel'];
        $last = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['lastpage'];
        $jumlah = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['jumlah'];
        $pagination = $this->pagination($page, $last);
        $data = [
            'jemaat' => $jemaat,
            'pagination' => $pagination,
            'last' => $last,
            'jumlah' => $jumlah,
            'page' => $page,
            'summary' => $summary
        ];
        echo view('Home/tabel/panitia', $data);
    }
    public function report()
    {
        $filename = 'Data_Pendaftaran_' . date('dmy') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        $file = fopen('php://output', 'w');
        $header = array("Nama", "No HP", "Anggota", "Transportasi", "Jumlah Dewasa", "Jumlah Anak", "Total Bayar", "Penerima", "Tanggal Update");
        fputcsv($file, $header);
        foreach ($this->PaskahModel->select('nama, hp, anggota, transportasi, dewasa, anak, bayar, pic, updated_at')->findAll() as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    public function reportnama()
    {
        $filename = 'Data_Pendaftaran_' . date('dmy') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        $file = fopen('php://output', 'w');
        $header = array("Nama", "No HP", "Anggota", "Transportasi", "Jumlah Dewasa", "Jumlah Anak", "Total Bayar", "Penerima", "Tanggal Update");
        fputcsv($file, $header);
        foreach ($this->PaskahModel->select('nama, hp, anggota, transportasi, dewasa, anak, bayar, pic, updated_at')->findAll() as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    public function reportsetoran()
    {
        $filename = 'Data_Setoran_' . date('dmy') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        $file = fopen('php://output', 'w');
        $header = array("Nama", "jumlah", "Status", "Tanggal");
        fputcsv($file, $header);
        foreach ($this->PaskahModel->reportsetoran() as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    public function deletejemaat()
    {
        $this->PaskahModel->delete(['id' => $_POST['id']]);
        if (empty($this->PaskahModel->statusSummary(user()->username))) {
            $summary['pic'] = false;
            $summary['total'] = false;
        } else {
            $summary = $this->PaskahModel->statusSummary(user()->username)[0];
            if ($this->PaskahModel->setorPIC(user()->username)) {
                $summary['total'] = $summary['total'] - $this->PaskahModel->setorPIC(user()->username)[0]['total'];
            }
        }
        $page = 1;
        $keyword = '';
        if ($page == 1) {
            $index = 0;
        } else {
            $index = ($page - 1) * $this->jumlahlist;
        }
        $jemaat = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['tabel'];
        $last = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['lastpage'];
        $jumlah = $this->PaskahModel->searchpanitia($keyword, $this->jumlahlist, $index)['jumlah'];
        $pagination = $this->pagination($page, $last);
        $data = [
            'jemaat' => $jemaat,
            'pagination' => $pagination,
            'last' => $last,
            'jumlah' => $jumlah,
            'page' => $page,
            'summary' => $summary
        ];
        echo view('Home/tabel/panitia', $data);
    }
}
