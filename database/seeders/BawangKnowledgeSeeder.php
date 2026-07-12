<?php

namespace Database\Seeders;

use App\Models\Rule;
use App\Support\KnowledgeSeederHelper;
use Illuminate\Database\Seeder;

class BawangKnowledgeSeeder extends Seeder
{
    public function run(): void
    {
        KnowledgeSeederHelper::seed(
            $this->gejala(),
            $this->penyakit(),
            $this->hama(),
            $this->rules(),
        );
    }

    private function gejala(): array
    {
        return [
            // PB01 Trotol (Bercak Ungu)
            ['GB01', 'Terdapat bercak melekuk pada daun'],
            ['GB02', 'Terdapat bintik lingkaran berwarna ungu pada pusatnya yang melebar semakin menipis'],
            ['GB03', 'Bagian yang terserang umumnya berbentuk cekungan'],
            ['GB04', 'Bercak dapat menyatu membentuk hawar, dikelilingi zona kekuningan'],
            ['GB05', 'Infeksi dapat menjalar ke leher umbi menyebabkan pembusukan basah'],
            // PB02 Otomatis (Antraknose)
            ['GB06', 'Ditandai dengan bercak putih pada daun'],
            ['GB07', 'Membentuk lekukan yang menyebabkan daun menjadi patah (mati bujang)'],
            ['GB08', 'Rebahnya tanaman terjadi secara mendadak (otomatis)'],
            ['GB09', 'Pada kondisi lembap, muncul massa spora (aservulus) kemerahan/jingga pada lekukan daun'],
            ['GB10', 'Umbi mengecil dan rentan busuk saat disimpan'],
            // PB03 Moler (Layu Fusarium)
            ['GB11', 'Daun bawang menguning, terpelintir (ngoler), dan selanjutnya tanaman menjadi layu'],
            ['GB12', 'Gejala dimulai dari ujung daun dan akhirnya tanaman mati'],
            ['GB13', 'Akar membusuk dan jika umbi dipotong membujur, tampak pembusukan yang berair'],
            ['GB14', 'Tanaman layu sangat mudah dicabut dari tanah'],
            ['GB15', 'Terdapat miselium jamur berwarna putih kemerahan di dasar umbi/pangkal batang'],
            // PB04 Embun Tepung (Downy Mildew)
            ['GB16', 'Timbul bercak hijau pucat di dekat ujung daun (muncul sejak tanaman mulai membentuk umbi)'],
            ['GB17', 'Pada kondisi lembap, timbul kapang/jamur berwarna putih lembayung atau ungu'],
            ['GB18', 'Daun akan segera menguning, layu, dan mati'],
            ['GB19', 'Infeksi sistemik membuat tunas/daun baru tumbuh pucat dan melengkung abnormal'],
            ['GB20', 'Umbi menjadi kerdil, lunak, dan berkerut'],
            // HB01 Ulat Bawang
            ['GB21', 'Timbulnya bercak-bercak putih transparan pada daun'],
            ['GB22', 'Larva masuk dan bersembunyi di dalam rongga daun bawang'],
            ['GB23', 'Larva memakan jaringan klorofil dari dalam daun, menyisakan kulit luar (epidermis)'],
            ['GB24', 'Daun bawang akhirnya terkulai, mengering, atau berlubang besar'],
            // HB02 Ulat Grayak
            ['GB25', 'Berbeda dengan ulat bawang, larva memakan daun dari bagian luar'],
            ['GB26', 'Larva instar awal makan secara berkelompok (grayak)'],
            ['GB27', 'Pada serangan berat, daun robek, berlubang besar, atau habis menyisakan pelepahnya'],
            // HB03 Trips Bawang
            ['GB28', 'Daun yang terserang pada permukaan bawahnya berwarna keperak-perakan'],
            ['GB29', 'Daun tampak mengeriting atau keriput'],
            ['GB30', 'Terdapat bintik-bintik kotoran berwarna hitam di sekitar area yang mengering'],
            ['GB31', 'Ujung daun berubah menjadi kecokelatan dan mati (nekrosis)'],
            ['GB32', 'Pertumbuhan terhambat, menyebabkan umbi tidak membesar optimal'],
            // HB04 Lalat Penggorok Daun
            ['GB33', 'Terdapat bintik-bintik putih pada daun akibat tusukan alat bertelur (ovipositor)'],
            ['GB34', 'Terlihat alur korokan yang berkelok-kelok berwarna putih (jejak larva memakan daun)'],
            ['GB35', 'Alur korokan dapat melebar dan menyatu menutupi permukaan daun'],
            ['GB36', 'Pada serangan berat, seluruh jaringan daun mengering seperti terbakar'],
            // HB05 Orong-orong
            ['GB37', 'Tanaman menjadi layu karena akar rusak dimakan hama'],
            ['GB38', 'Secara spesifik memakan akar, umbi, dan pangkal batang tanaman muda'],
            ['GB39', 'Terdapat lorong-lorong galian di sekitar permukaan tanah'],
            ['GB40', 'Bibit rebah atau patah mendadak di pagi hari akibat pangkalnya terpotong'],
        ];
    }

    private function penyakit(): array
    {
        $img = fn (int $n) => KnowledgeSeederHelper::targetImage('bawang-p', $n);

        return [
            [
                'kode_penyakit' => 'BAWANG-P01',
                'nama_penyakit' => 'Penyakit Trotol (Bercak Ungu)',
                'deskripsi' => 'Penyakit jamur Alternaria porri dengan bercak ungu melingkar dan hawar dikelilingi zona kekuningan pada daun bawang merah.',
                'solusi' => "Cara Kimia: Semprotkan fungisida kontak Mankozeb (contoh: Dithane) dosis 2–3 gram/liter air saat embun mengering.\n\nCara Hayati: Pemanfaatan mikroorganisme antagonis seperti Pseudomonas fluorescens, Trichoderma sp., dan Bacillus subtilis untuk menekan pertumbuhan patogen secara alami.\n\nAlternatif/Saran Praktis: Atur jarak tanam agar tidak terlalu rapat. Penyakit ini dipicu oleh sirkulasi udara yang buruk dan genangan air. Pastikan parit (drainase) lancar.",
                'gambar' => $img(1),
            ],
            [
                'kode_penyakit' => 'BAWANG-P02',
                'nama_penyakit' => 'Penyakit Otomatis (Antraknose)',
                'deskripsi' => 'Penyakit jamur Colletotrichum spp. ditandai bercak putih, lekukan daun, dan tanaman rebah mendadak.',
                'solusi' => "Cara Kimia: Semprotkan fungisida Propineb (contoh: Antracol) dosis 2 gram/liter air secara rutin, terutama jika cuaca sering mendung dan lembap.\n\nCara Hayati: Pemanfaatan mikroorganisme antagonis seperti Pseudomonas fluorescens, Trichoderma sp., dan Bacillus subtilis untuk menekan pertumbuhan patogen secara alami.\n\nAlternatif/Saran Praktis: Lakukan rotasi tanaman (jangan menanam bawang merah berturut-turut di lahan yang sama). Segera cabut tanaman yang patah mendadak (\"mati bujang\") dan jauhkan dari lahan.",
                'gambar' => $img(2),
            ],
            [
                'kode_penyakit' => 'BAWANG-P03',
                'nama_penyakit' => 'Penyakit Moler (Layu Fusarium)',
                'deskripsi' => 'Penyakit jamur Fusarium oxysporum menyebabkan daun ngoler, layu, akar busuk, dan miselium putih kemerahan di pangkal umbi.',
                'solusi' => "Cara Kimia: Karena menyerang akar dan pangkal batang, siram/kocorkan fungisida Benomil (contoh: Benlate) 2 gram/liter air ke area perakaran.\n\nCara Hayati: Pemanfaatan mikroorganisme antagonis seperti Pseudomonas fluorescens, Trichoderma sp., dan Bacillus subtilis untuk menekan pertumbuhan patogen secara alami.\n\nAlternatif/Saran Praktis: Cara terbaik adalah pencegahan alami. Sebelum menanam, campurkan pupuk kandang/kompos dengan agens pengendali hayati Trichoderma sp.",
                'gambar' => $img(3),
            ],
            [
                'kode_penyakit' => 'BAWANG-P04',
                'nama_penyakit' => 'Penyakit Embun Tepung (Downy Mildew)',
                'deskripsi' => 'Penyakit jamur Peronospora destructor dengan bercak hijau pucat dan kapang putih/ungu pada daun bawang.',
                'solusi' => "Cara Kimia: Gunakan fungisida berbahan aktif Azoksistrobin (contoh: Amistar) dosis 1 ml/liter air.\n\nCara Hayati: Pemanfaatan mikroorganisme antagonis seperti Pseudomonas fluorescens, Trichoderma sp., dan Bacillus subtilis untuk menekan pertumbuhan patogen secara alami.\n\nAlternatif/Saran Praktis: Jika malam hari turun hujan atau embun sangat tebal, bilas daun bawang merah dengan air bersih di pagi hari sebelum terik matahari untuk mencuci spora jamur yang menempel.",
                'gambar' => $img(4),
            ],
        ];
    }

    private function hama(): array
    {
        $img = fn (int $n) => KnowledgeSeederHelper::targetImage('bawang-h', $n);

        return [
            [
                'kode_hama' => 'BAWANG-H01',
                'nama_hama' => 'Ulat Bawang',
                'deskripsi' => 'Hama ulat Spodoptera exigua yang larva-nya memakan jaringan daun dari dalam rongga daun bawang.',
                'solusi' => "Cara Kimia: Aplikasikan pestisida baiknya pada sore atau malam hari pada saat ulat keluar dari dalam rongga daun. Pestisida yang dapat digunakan diantaranya yang berbahan aktif emamektin benzoat, broflanilida, klorantraniliprol, spinetoram, diaplikasikan sesuai dengan dosis yang tertera pada label.\n\nCara Hayati: Sebelum ambang batas pengendalian dapat menggunakan agens hayati seperti Bacillus thuringiensis dan Beauveria bassiana.\n\nAlternatif/Saran Praktis: Potong ujung daun bawang yang terlihat memiliki kelompok telur putih, lalu musnahkan. Pasang perangkap lampu (lampu minyak/bohlam) di malam hari di atas ember berisi air sabun untuk menangkap ngengat (kupu-kupu) dewasa.",
                'gambar' => $img(1),
            ],
            [
                'kode_hama' => 'BAWANG-H02',
                'nama_hama' => 'Ulat Grayak',
                'deskripsi' => 'Hama ulat Spodoptera litura yang memakan daun bawang dari bagian luar secara berkelompok.',
                'solusi' => "Cara Kimia: Aplikasikan pestisida pada pagi atau sore hari. Pestisida yang dapat digunakan antara lain pestisida berbahan aktif Emamektin benzoate, Klorfluazuron, Klorpirifos, Flubendiamid dan Siantraniliprol, diaplikasikan sesuai dengan dosis yang tertera pada label.\n\nCara Hayati: Sebelum ambang batas pengendalian dapat menggunakan agens hayati seperti Bacillus thuringiensis dan Beauveria bassiana. Semprotkan secara merata ke seluruh permukaan daun.\n\nAlternatif/Saran Praktis: Ulat ini suka bersembunyi di siang hari. Bersihkan gulma di sekitar bedengan karena gulma sering menjadi tempat persembunyian ulat grayak.",
                'gambar' => $img(2),
            ],
            [
                'kode_hama' => 'BAWANG-H03',
                'nama_hama' => 'Thrips Bawang',
                'deskripsi' => 'Hama Thrips tabaci pengisap daun bawang, menyebabkan daun keperak-perakan dan pertumbuhan terhambat.',
                'solusi' => "Cara Kimia: Aplikasikan pestisida pada pagi atau sore hari. Pestisida yang dapat digunakan antara lain pestisida berbahan aktif Abamektin, Imidakloprid, Spirotetramat, Klofenapir, Dinotefuran, dan Fipronil, diaplikasikan sesuai dengan dosis yang tertera pada label.\n\nCara Hayati: Sebelum ambang batas pengendalian dapat menggunakan agens hayati seperti Metarhizium anisopliae dan Beauveria bassiana.\n\nAlternatif/Saran Praktis: Hama trips menyerang hebat saat musim kemarau. Jaga kelembapan tanah dengan penyiraman rutin. Pasang perangkap warna kuning lengket (yellow sticky trap) di beberapa titik bedengan untuk menangkap trips terbang.",
                'gambar' => $img(3),
            ],
            [
                'kode_hama' => 'BAWANG-H04',
                'nama_hama' => 'Lalat Penggorok Daun (Grandong)',
                'deskripsi' => 'Hama Liriomyza chinensis yang larva-nya menggorek daun bawang membentuk alur putih berkelok.',
                'solusi' => "Cara Kimia: Aplikasikan pestisida pada pagi atau sore hari. Pestisida yang dapat digunakan antara lain pestisida berbahan aktif Siromazin, abamektin, emamektin benzoat, atau siromazin diaplikasikan sesuai dengan dosis yang tertera pada label.\n\nCara Hayati: Sebelum ambang batas pengendalian dapat menggunakan agens hayati seperti Trichoderma sp. dan Beauveria bassiana.\n\nAlternatif/Saran Praktis: Jika melihat daun dengan alur putih berbelok-belok (korokan), segera cabut dan bakar daun tersebut sebelum larva berubah menjadi lalat dewasa dan menyebar.",
                'gambar' => $img(4),
            ],
            [
                'kode_hama' => 'BAWANG-H05',
                'nama_hama' => 'Orong-orong',
                'deskripsi' => 'Hama Gryllotalpa sp. yang memakan akar, umbi, dan pangkal batang tanaman bawang muda.',
                'solusi' => "Cara Kimia: Taburkan butiran Karbofuran 3% (contoh: Furadan 3GR) ke tanah di sekitar pangkal tanaman sebanyak 15–20 kg/hektar.\n\nAlternatif/Saran Praktis: Genangi lahan atau bedengan secara merata sesaat sebelum penanaman. Orong-orong tidak tahan air dan akan naik ke permukaan, sehingga mudah diambil atau dimakan oleh predator seperti burung.",
                'gambar' => $img(5),
            ],
        ];
    }

    private function rules(): array
    {
        return [
            ['jenis' => Rule::JENIS_PENYAKIT, 'target_code' => 'BAWANG-P01', 'gejala' => [['GB01', 0.4], ['GB02', 0.8], ['GB03', 0.4], ['GB04', 0.7], ['GB05', 0.6]]],
            ['jenis' => Rule::JENIS_PENYAKIT, 'target_code' => 'BAWANG-P02', 'gejala' => [['GB06', 0.6], ['GB07', 0.8], ['GB08', 0.7], ['GB09', 0.7], ['GB10', 0.5]]],
            ['jenis' => Rule::JENIS_PENYAKIT, 'target_code' => 'BAWANG-P03', 'gejala' => [['GB11', 0.8], ['GB12', 0.5], ['GB13', 0.7], ['GB14', 0.5], ['GB15', 0.8]]],
            ['jenis' => Rule::JENIS_PENYAKIT, 'target_code' => 'BAWANG-P04', 'gejala' => [['GB16', 0.8], ['GB17', 0.6], ['GB18', 0.6], ['GB19', 0.4], ['GB20', 0.3]]],
            ['jenis' => Rule::JENIS_HAMA, 'target_code' => 'BAWANG-H01', 'gejala' => [['GB21', 0.7], ['GB22', 1.0], ['GB23', 0.8], ['GB24', 0.5]]],
            ['jenis' => Rule::JENIS_HAMA, 'target_code' => 'BAWANG-H02', 'gejala' => [['GB21', 0.4], ['GB25', 0.9], ['GB26', 0.5], ['GB27', 0.6]]],
            ['jenis' => Rule::JENIS_HAMA, 'target_code' => 'BAWANG-H03', 'gejala' => [['GB28', 0.8], ['GB29', 0.7], ['GB30', 0.6], ['GB31', 0.6], ['GB32', 0.4]]],
            ['jenis' => Rule::JENIS_HAMA, 'target_code' => 'BAWANG-H04', 'gejala' => [['GB33', 0.7], ['GB34', 0.9], ['GB35', 0.8], ['GB36', 0.6]]],
            ['jenis' => Rule::JENIS_HAMA, 'target_code' => 'BAWANG-H05', 'gejala' => [['GB37', 0.7], ['GB38', 0.8], ['GB39', 0.8], ['GB40', 0.6]]],
        ];
    }
}
