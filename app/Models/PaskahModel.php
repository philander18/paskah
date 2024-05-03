<?php

namespace App\Models;

use CodeIgniter\Model;

class PaskahModel extends Model
{
    protected $table = 'jemaat';
    protected $allowedFields = ['nama', 'hp', 'anggota', 'transportasi', 'dewasa', 'anak', 'bayar', 'pic', 'status', 'updated_at'];

    public function searchhp($keyword, $jumlahlist, $index)
    {
        $where = "nama like '%" . $keyword . "%'";
        $all = $this->db->table('jemaat')->select('id, nama, hp, bayar')->where($where)->orderBy('nama', 'ASC')->get()->getResultArray();
        $jumlahdata = count($all);
        $lastpage = ceil($jumlahdata / $jumlahlist);
        $tabel = array_splice($all, $index);
        array_splice($tabel, $jumlahlist);
        $data['lastpage'] = $lastpage;
        $data['tabel'] = $tabel;
        $data['jumlah'] = $jumlahdata;
        return $data;
    }
    public function searchpanitia($keyword, $jumlahlist, $index)
    {
        $where = "hp like '%" . $keyword . "%' or nama like '%" . $keyword . "%'";
        $all = $this->db->table('jemaat')->select('id, nama, hp, bayar, pic')->where($where)->orderBy('nama', 'ASC')->get()->getResultArray();
        $jumlahdata = count($all);
        $lastpage = ceil($jumlahdata / $jumlahlist);
        $tabel = array_splice($all, $index);
        array_splice($tabel, $jumlahlist);
        $data['lastpage'] = $lastpage;
        $data['tabel'] = $tabel;
        $data['jumlah'] = $jumlahdata;
        return $data;
    }

    public function searchSetoran($keyword, $jumlahlist, $index, $semua)
    {
        if ($semua) {
            $where = "pic like '%" . $keyword . "%'";
        } else {
            $where = "pic like '%" . $keyword . "%' and status = 0";
        }
        $all = $this->db->table('bendahara')->where($where)->orderBy('status ASC, updated_at DESC')->get()->getResultArray();
        $jumlahdata = count($all);
        $lastpage = ceil($jumlahdata / $jumlahlist);
        $tabel = array_splice($all, $index);
        array_splice($tabel, $jumlahlist);
        $data['lastpage'] = $lastpage;
        $data['tabel'] = $tabel;
        return $data;
    }

    function getDatabyid($id)
    {
        $query = $this->db->table('jemaat')->where('id', $id)->get();
        return $query->getResult();
    }

    function updatejemaat($data, $id)
    {
        return $this->db->table('jemaat')->where('id', $id)->update($data);
    }

    function updatesetor($data, $id)
    {
        return $this->db->table('bendahara')->where('id', $id)->update($data);
    }

    function insertBendahara($data)
    {
        return $this->db->table('bendahara')->insert($data);
    }
    public function statusSummary($pic)
    {
        return $this->db->table('jemaat')->select('pic, sum(bayar) as total')->where('pic', $pic)->groupBy('pic')->orderBy('total', 'desc')->get()->getResultArray();
    }
    public function setorPIC($pic)
    {
        $where = "pic = '" . $pic . "' and status = 1";
        return $this->db->table('bendahara')->select('pic, sum(jumlah) as total')->where($where)->groupBy('pic')->orderBy('total', 'desc')->get()->getResultArray();
    }
    public function rekapBayar()
    {
        return $this->db->table("(select pic, sum(bayar) as total from u624506210_paskah.jemaat group by pic) as tabel1")->select('tabel1.pic as pic, tabel1.total as total, tabel2.total as kirim')->join("(select pic, sum(jumlah) as total from u624506210_paskah.bendahara where status = 1 group by pic) as tabel2", "tabel1.pic = tabel2.pic", 'left')->where('tabel1.pic is not null')->get()->getResultArray();
    }

    public function totalbendahara()
    {
        return $this->db->table("bendahara")->select('sum(jumlah) as total')->where('status = 1')->get()->getResultArray()[0]['total'];
    }

    public function reportsetoran()
    {
        return $this->db->table("bendahara")->select("pic, jumlah, if(status = 1, 'diterima', 'belum diterima') as status, updated_at")->get()->getResultArray();
    }
    public function data_report()
    {
        $data['dewasa'] = $this->db->table('jemaat')->select("sum(dewasa) as JDewasa")->get()->getResultArray()[0]['JDewasa'];
        $data['dewasa_bayar'] = $this->db->table('jemaat')->select("sum(dewasa) as JDewasa")->where("bayar is not null and bayar <> 0")->get()->getResultArray()[0]['JDewasa'];
        $data['anak'] = $this->db->table('jemaat')->select("sum(anak) as JAnak")->get()->getResultArray()[0]['JAnak'];
        $data['bayar'] = $this->db->table('jemaat')->select("sum(bayar) as JBayar")->get()->getResultArray()[0]['JBayar'];
        $data['transportasi_dewasa'] = $this->db->table('jemaat')->select("sum(dewasa) as panitia")->where("transportasi = 'panitia'")->get()->getResultArray()[0]['panitia'];
        $data['transportasi_anak'] = $this->db->table('jemaat')->select("sum(anak) as panitia")->where("transportasi = 'panitia'")->get()->getResultArray()[0]['panitia'];
        foreach ($this->db->table('jemaat')->select("anggota, transportasi")->orderBy('transportasi', 'ASC')->get()->getResultArray() as $anggota) :
            foreach (preg_split("/\r\n|\n|\r/", $anggota["anggota"]) as $list) : {
                    if ($list <> "") {
                        if (strpos($list, '(SM)')) {
                            $SM[] = ['nama' => $list, 'transportasi' => $anggota['transportasi']];
                        } else {
                            $dewasa[] = ['nama' => $list, 'transportasi' => $anggota['transportasi']];
                        }
                    }
                }
            endforeach;
        endforeach;
        $data['SM'] = $SM;
        $data['dewasa_transportasi'] = $dewasa;
        return $data;
    }
}
