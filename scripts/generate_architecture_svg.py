import os

def generate_svg():
    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080" width="1920" height="1080" style="background-color: #FDF8FA; font-family: 'Plus Jakarta Sans', sans-serif;">
  <defs>
    <!-- Google Fonts Import -->
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap');
      
      .main-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        fill: #5C0632;
        font-size: 38px;
        letter-spacing: 1px;
      }
      .sub-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        fill: #A82255;
        font-size: 22px;
      }
      .method-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
        fill: #5E404E;
        font-size: 18px;
      }
      .card-header-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 15px;
        fill: #FFFFFF;
        letter-spacing: 0.5px;
      }
      .card-title-sub {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 13px;
        fill: #E05A8D;
      }
      .list-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 14px;
        fill: #5C0632;
      }
      .list-desc {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 400;
        font-size: 12px;
        fill: #5E404E;
      }
      .bullet-text {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
        font-size: 13px;
        fill: #3A202D;
      }
      .arrow-text {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 11px;
        fill: #800843;
      }
      .formula-text {
        font-family: 'Courier New', Courier, monospace;
        font-weight: 700;
        font-size: 12px;
        fill: #800843;
      }
      .footer-text {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
        font-size: 13.5px;
        fill: #FFFFFF;
      }
      
      /* Hover effects for interactive feel in SVG */
      .card-box {
        transition: transform 0.3s ease, filter 0.3s ease;
      }
      .card-box:hover {
        transform: translateY(-5px);
        filter: drop-shadow(0 10px 15px rgba(122, 28, 74, 0.15));
      }
    </style>

    <!-- Filters for Shadows -->
    <filter id="cardShadow" x="-10%" y="-10%" width="120%" height="120%">
      <feDropShadow dx="0" dy="4" stdDeviation="6" flood-color="#7A1C4A" flood-opacity="0.06"/>
    </filter>
    <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
      <feGaussianBlur stdDeviation="4" result="blur"/>
      <feComposite in="SourceGraphic" in2="blur" operator="over"/>
    </filter>

    <!-- Gradients -->
    <linearGradient id="onionHeaderGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#800843"/>
      <stop offset="50%" stop-color="#A82255"/>
      <stop offset="100%" stop-color="#E05A8D"/>
    </linearGradient>
    <linearGradient id="headerGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#800843"/>
      <stop offset="100%" stop-color="#5C0632"/>
    </linearGradient>
    <linearGradient id="cardHeaderGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#800843"/>
      <stop offset="100%" stop-color="#A82255"/>
    </linearGradient>
    <linearGradient id="cardHeaderGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#A82255"/>
      <stop offset="100%" stop-color="#E05A8D"/>
    </linearGradient>
    <linearGradient id="orangeGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#FF5722"/>
      <stop offset="100%" stop-color="#E64A19"/>
    </linearGradient>
    <linearGradient id="blueGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#2196F3"/>
      <stop offset="100%" stop-color="#1976D2"/>
    </linearGradient>
    <linearGradient id="purpleGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#7B1FA2"/>
      <stop offset="100%" stop-color="#4A148C"/>
    </linearGradient>
    <linearGradient id="greenGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#4CAF50"/>
      <stop offset="100%" stop-color="#388E3C"/>
    </linearGradient>

    <!-- Arrow Markers -->
    <marker id="arrowRight" viewBox="0 0 10 10" refX="6" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
      <path d="M 0 1.5 L 7 5 L 0 8.5 z" fill="#800843"/>
    </marker>
    <marker id="arrowLeft" viewBox="0 0 10 10" refX="1" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
      <path d="M 7 1.5 L 0 5 L 7 8.5 z" fill="#800843"/>
    </marker>
    <marker id="arrowBoth" viewBox="0 0 10 10" refX="5" refY="5" markerWidth="6" markerHeight="6" orient="auto">
      <path d="M 0 1.5 L 7 5 L 0 8.5 z" fill="#800843"/>
    </marker>
  </defs>

  <!-- BACKGROUND DECORATIONS -->
  <rect width="1920" height="1080" fill="#FDF8FA"/>
  <circle cx="100" cy="100" r="150" fill="#FCEBF3" opacity="0.4"/>
  <circle cx="1820" cy="980" r="250" fill="#FCEBF3" opacity="0.3"/>
  <path d="M-100,500 Q300,600 700,450 T1920,500 L1920,1080 L-100,1080 Z" fill="#F9EFF4" opacity="0.3"/>
  
  <!-- SYSTEM HEADER -->
  <g transform="translate(960, 65)" text-anchor="middle">
    <!-- Shallot Logo Vector -->
    <g transform="translate(0, -45)" scale="0.9">
      <!-- Outer shallot layers -->
      <path d="M-20,20 C-40,-5 -30,-30 0,-50 C30,-30 40,-5 20,20 C10,30 -10,30 -20,20 Z" fill="#A82255" />
      <path d="M-10,15 C-25,-3 -20,-20 0,-40 C20,-20 25,-3 10,15 C5,20 -5,20 -10,15 Z" fill="#C23B72" />
      <path d="M-5,10 C-12,0 -10,-10 0,-25 C10,-10 12,0 5,10 C2.5,13 -2.5,13 -5,10 Z" fill="#E05A8D" />
      <!-- Shallot roots -->
      <path d="M-8,25 L-12,35 M-3,26 L-5,38 M2,26 L3,39 M8,25 L10,34" stroke="#DCA2BA" stroke-width="2" stroke-linecap="round"/>
      <!-- Shallot green leaves -->
      <path d="M-3,-50 Q-15,-70 -30,-80 Q-20,-65 -5,-52" fill="#4CAF50"/>
      <path d="M3,-50 Q15,-75 35,-85 Q20,-68 5,-52" fill="#388E3C"/>
      <path d="M0,-50 L0,-78 Q-5,-65 0,-50" fill="#81C784"/>
    </g>
    
    <text class="main-title" y="30">ARSITEKTUR SISTEM SIPATAN</text>
    <text class="sub-title" y="62">Sistem Pakar Diagnosis Penyakit dan Hama Tanaman Bawang Merah</text>
    <text class="method-title" y="88">(Backward Chaining + Certainty Factor)</text>
  </g>

  <!-- ==================== MAIN ROW (1) ==================== -->

  <!-- CARD 1: PENGGUNA SISTEM -->
  <g class="card-box" transform="translate(40, 160)" filter="url(#cardShadow)">
    <rect width="310" height="500" rx="14" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 14 A 14 14 0 0 1 14 0 L 296 0 A 14 14 0 0 1 310 14 L 310 45 L 0 45 Z" fill="url(#cardHeaderGrad)"/>
    <text class="card-header-title" x="155" y="27" text-anchor="middle">PENGGUNA SISTEM</text>
    
    <!-- User 1: Petani -->
    <g transform="translate(20, 65)">
      <!-- Farmer Avatar -->
      <circle cx="35" cy="35" r="28" fill="#F9EBF2" stroke="#E4AEC5" stroke-width="1.5"/>
      <!-- Straw hat -->
      <path d="M12,28 C15,18 55,18 58,28" fill="#D7CCC8" stroke="#8D6E63" stroke-width="1"/>
      <path d="M5,28 C15,28 55,28 65,28 C70,33 0,33 5,28" fill="#F5F5F5" stroke="#BCAAA4" stroke-width="1"/>
      <!-- Face -->
      <circle cx="35" cy="38" r="10" fill="#FFCC80"/>
      <!-- Eyes & Smile -->
      <circle cx="32" cy="37" r="1" fill="#3E2723"/>
      <circle cx="38" cy="37" r="1" fill="#3E2723"/>
      <path d="M33,42 Q35,44 37,42" stroke="#3E2723" stroke-width="1" fill="none"/>
      <!-- Body -->
      <path d="M17,63 C17,50 53,50 53,63 Z" fill="#4CAF50"/>
      <!-- Mini onion in hand -->
      <path d="M50,50 C45,45 42,42 45,35 C48,42 55,45 50,50" fill="#A82255"/>
      <path d="M45,35 L44,30 M46,35 L47,29" stroke="#4CAF50" stroke-width="1"/>

      <text class="list-title" x="80" y="25">PETANI / PENGGUNA</text>
      <text class="list-desc" x="80" y="42">Pengguna publik (Publik / Guest)</text>
      
      <!-- Bullet points -->
      <g transform="translate(5, 75)">
        <circle cx="5" cy="5" r="3" fill="#A82255"/>
        <text class="bullet-text" x="18" y="9">Melakukan konsultasi</text>
        
        <circle cx="5" cy="27" r="3" fill="#A82255"/>
        <text class="bullet-text" x="18" y="31">Memilih penyakit/hama target</text>
        
        <circle cx="5" cy="49" r="3" fill="#A82255"/>
        <text class="bullet-text" x="18" y="53">Memilih gejala yang dialami</text>
        
        <circle cx="5" cy="71" r="3" fill="#A82255"/>
        <text class="bullet-text" x="18" y="75">Mengatur tingkat keyakinan (CF User)</text>
        
        <circle cx="5" cy="93" r="3" fill="#A82255"/>
        <text class="bullet-text" x="18" y="97">Melihat hasil diagnosis &amp; skor CF</text>
        
        <circle cx="5" cy="115" r="3" fill="#A82255"/>
        <text class="bullet-text" x="18" y="119">Melihat rekomendasi penanganan</text>
      </g>
    </g>

    <!-- Divider -->
    <line x1="20" y1="275" x2="290" y2="275" stroke="#F2D1DF" stroke-width="1" stroke-dasharray="4 4"/>

    <!-- User 2: Admin / Petugas -->
    <g transform="translate(20, 290)">
      <!-- Admin Avatar -->
      <circle cx="35" cy="35" r="28" fill="#F3E5F5" stroke="#CE93D8" stroke-width="1.5"/>
      <!-- Laptop screen back -->
      <rect x="15" y="42" width="22" height="15" rx="2" fill="#78909C"/>
      <!-- Face -->
      <circle cx="35" cy="28" r="10" fill="#FFD54F"/>
      <!-- Glasses -->
      <rect x="29" y="25" width="5" height="3" rx="1" fill="none" stroke="#37474F" stroke-width="1"/>
      <rect x="36" y="25" width="5" height="3" rx="1" fill="none" stroke="#37474F" stroke-width="1"/>
      <line x1="34" y1="26" x2="36" y2="26" stroke="#37474F" stroke-width="1"/>
      <!-- Body -->
      <path d="M20,53 C20,43 50,43 50,53 Z" fill="#1565C0"/>
      <!-- Laptop keyboard base -->
      <polygon points="10,57 40,57 45,61 5,61" fill="#CFD8DC"/>

      <text class="list-title" x="80" y="25">ADMIN &amp; PETUGAS</text>
      <text class="list-desc" x="80" y="42">Pengelola sistem pakar</text>

      <!-- Bullet points -->
      <g transform="translate(5, 75)">
        <circle cx="5" cy="5" r="3" fill="#800843"/>
        <text class="bullet-text" x="18" y="9">Login &amp; Autentikasi Admin</text>
        
        <circle cx="5" cy="27" r="3" fill="#800843"/>
        <text class="bullet-text" x="18" y="31">Kelola data penyakit &amp; hama</text>
        
        <circle cx="5" cy="49" r="3" fill="#800843"/>
        <text class="bullet-text" x="18" y="53">Kelola data gejala bawang merah</text>
        
        <circle cx="5" cy="71" r="3" fill="#800843"/>
        <text class="bullet-text" x="18" y="75">Kelola rule (relasi target &amp; CF pakar)</text>
        
        <circle cx="5" cy="93" r="3" fill="#800843"/>
        <text class="bullet-text" x="18" y="97">Kelola data pengguna/petugas</text>

        <circle cx="5" cy="115" r="3" fill="#800843"/>
        <text class="bullet-text" x="18" y="119">Melihat data riwayat &amp; laporan</text>
      </g>
    </g>
  </g>

  <!-- HTTP CONNECTIONS -->
  <g>
    <!-- Request Arrow -->
    <path d="M 350 280 L 410 280" stroke="#800843" stroke-width="2.5" stroke-dasharray="1" marker-end="url(#arrowRight)"/>
    <rect x="352" y="253" width="56" height="20" rx="3" fill="#FFFFFF" stroke="#800843" stroke-width="1"/>
    <text class="arrow-text" x="380" y="267" text-anchor="middle">HTTP Request</text>

    <!-- Response Arrow -->
    <path d="M 410 460 L 350 460" stroke="#800843" stroke-width="2.5" stroke-dasharray="1" marker-end="url(#arrowRight)"/>
    <rect x="352" y="468" width="56" height="20" rx="3" fill="#FFFFFF" stroke="#800843" stroke-width="1"/>
    <text class="arrow-text" x="380" y="482" text-anchor="middle">HTTP Response</text>
  </g>

  <!-- CARD 2: FRONTEND (VIEW) -->
  <g class="card-box" transform="translate(415, 160)" filter="url(#cardShadow)">
    <rect width="310" height="500" rx="14" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 14 A 14 14 0 0 1 14 0 L 296 0 A 14 14 0 0 1 310 14 L 310 45 L 0 45 Z" fill="url(#cardHeaderGrad)"/>
    <text class="card-header-title" x="155" y="27" text-anchor="middle">FRONTEND (VIEW)</text>
    
    <!-- Framework details -->
    <text class="card-title-sub" x="20" y="70">Laravel Blade + Bootstrap 5</text>
    
    <!-- Mini tech badges -->
    <g transform="translate(20, 85)">
      <!-- Bootstrap Badge -->
      <rect x="0" y="0" width="60" height="24" rx="5" fill="#7952B3"/>
      <text x="30" y="16" fill="#FFFFFF" font-size="10" font-weight="bold" text-anchor="middle">Bootstrap 5</text>

      <!-- HTML5 Badge -->
      <rect x="67" y="0" width="45" height="24" rx="5" fill="#E34F26"/>
      <text x="89.5" y="16" fill="#FFFFFF" font-size="10" font-weight="bold" text-anchor="middle">HTML5</text>

      <!-- CSS3 Badge -->
      <rect x="119" y="0" width="40" height="24" rx="5" fill="#1572B6"/>
      <text x="139" y="16" fill="#FFFFFF" font-size="10" font-weight="bold" text-anchor="middle">CSS3</text>

      <!-- JS Badge -->
      <rect x="166" y="0" width="40" height="24" rx="5" fill="#F7DF1E"/>
      <text x="186" y="16" fill="#000000" font-size="10" font-weight="bold" text-anchor="middle">JS (ES6)</text>
      
      <!-- Apex Badge -->
      <rect x="213" y="0" width="55" height="24" rx="5" fill="#2E93FA"/>
      <text x="240.5" y="16" fill="#FFFFFF" font-size="10" font-weight="bold" text-anchor="middle">ApexCharts</text>
    </g>

    <!-- Frontend Pages List -->
    <g transform="translate(20, 135)">
      <!-- Page 1 -->
      <g transform="translate(0, 0)">
        <rect x="0" y="0" width="34" height="34" rx="8" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <path d="M9,22 L9,15 L25,15 L25,22 Z M12,12 L22,12 L17,8 Z" stroke="#A82255" stroke-width="1.5" fill="none" stroke-linejoin="round"/>
        <text class="list-title" x="46" y="16">Dashboard Admin</text>
        <text class="list-desc" x="46" y="30">Informasi ringkasan data &amp; tren statistik</text>
      </g>

      <!-- Page 2 -->
      <g transform="translate(0, 52)">
        <rect x="0" y="0" width="34" height="34" rx="8" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <path d="M12,12 L22,12 M12,17 L22,17 M12,22 L18,22 M10,7 L24,7" stroke="#A82255" stroke-width="1.5" fill="none" stroke-linecap="round"/>
        <rect x="8" y="10" width="18" height="16" rx="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <text class="list-title" x="46" y="16">Konsultasi / Deteksi</text>
        <text class="list-desc" x="46" y="30">Form diagnosis dan 6 skala keyakinan</text>
      </g>

      <!-- Page 3 -->
      <g transform="translate(0, 104)">
        <rect x="0" y="0" width="34" height="34" rx="8" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <circle cx="17" cy="17" r="8" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M14,17 L16,19 L20,15" stroke="#A82255" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        <text class="list-title" x="46" y="16">Hasil Diagnosis</text>
        <text class="list-desc" x="46" y="30">Menampilkan nilai CF &amp; tingkat keyakinan</text>
      </g>

      <!-- Page 4 -->
      <g transform="translate(0, 156)">
        <rect x="0" y="0" width="34" height="34" rx="8" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <path d="M10,25 C10,20 17,10 17,10 C17,10 24,20 24,25 C24,28.8 20.8,32 17,32 C13.2,32 10,28.8 10,25 Z" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M17,15 Q19,19 17,23" fill="none" stroke="#A82255" stroke-width="1"/>
        <text class="list-title" x="46" y="16">Solusi Penanganan</text>
        <text class="list-desc" x="46" y="30">Rekomendasi penanganan penyakit/hama</text>
      </g>

      <!-- Page 5 -->
      <g transform="translate(0, 208)">
        <rect x="0" y="0" width="34" height="34" rx="8" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <path d="M10,12 L24,12 M10,17 L24,17 M10,22 L20,22" stroke="#A82255" stroke-width="1.5" fill="none" stroke-linecap="round"/>
        <rect x="8" y="8" width="18" height="18" rx="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <text class="list-title" x="46" y="16">Riwayat Diagnosis</text>
        <text class="list-desc" x="46" y="30">Melihat kembali hasil diagnosa terdahulu</text>
      </g>

      <!-- Page 6 -->
      <g transform="translate(0, 260)">
        <rect x="0" y="0" width="34" height="34" rx="8" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <circle cx="17" cy="14" r="5" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M9,26 C9,22 13,20 17,20 C21,20 25,22 25,26" stroke="#A82255" stroke-width="1.5" fill="none" stroke-linecap="round"/>
        <text class="list-title" x="46" y="16">Login Admin &amp; Petugas</text>
        <text class="list-desc" x="46" y="30">Autentikasi admin (Split-screen layout)</text>
      </g>
      
      <!-- Page 7 (CRUD Management) -->
      <g transform="translate(0, 312)">
        <rect x="0" y="0" width="34" height="34" rx="8" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <path d="M12,17 L22,17 M17,12 L17,22" stroke="#A82255" stroke-width="1.5" fill="none" stroke-linecap="round"/>
        <rect x="8" y="8" width="18" height="18" rx="3" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <text class="list-title" x="46" y="16">CRUD Panel Manajemen</text>
        <text class="list-desc" x="46" y="30">Manajemen gejala, target, dan aturan pakar</text>
      </g>
    </g>
  </g>

  <!-- ROUTE WEB.PHP CONNECTIONS -->
  <g>
    <path d="M 725 380 L 790 380" stroke="#800843" stroke-width="2.5" stroke-dasharray="1" marker-end="url(#arrowRight)"/>
    <rect x="731" y="353" width="54" height="20" rx="3" fill="#FFFFFF" stroke="#800843" stroke-width="1"/>
    <text class="arrow-text" x="758" y="367" text-anchor="middle">routes/web.php</text>
  </g>

  <!-- CARD 3: BACKEND (CONTROLLER & SERVICE) -->
  <g class="card-box" transform="translate(790, 160)" filter="url(#cardShadow)">
    <rect width="310" height="500" rx="14" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 14 A 14 14 0 0 1 14 0 L 296 0 A 14 14 0 0 1 310 14 L 310 45 L 0 45 Z" fill="url(#cardHeaderGrad)"/>
    <text class="card-header-title" x="155" y="27" text-anchor="middle">BACKEND (CONTROLLER &amp; SERVICE)</text>
    
    <!-- Laravel & PHP Details -->
    <text class="card-title-sub" x="20" y="70">Laravel 11 (PHP 8.3)</text>

    <!-- Tech Badges -->
    <g transform="translate(20, 85)">
      <!-- Laravel Badge -->
      <rect x="0" y="0" width="70" height="24" rx="5" fill="#FF2D20"/>
      <text x="35" y="16" fill="#FFFFFF" font-size="10" font-weight="bold" text-anchor="middle">Laravel 11</text>

      <!-- PHP Badge -->
      <rect x="77" y="0" width="55" height="24" rx="5" fill="#777BB4"/>
      <text x="104.5" y="16" fill="#FFFFFF" font-size="10" font-weight="bold" text-anchor="middle">PHP 8.3</text>

      <!-- Eloquent Badge -->
      <rect x="139" y="0" width="80" height="24" rx="5" fill="#4F5D73"/>
      <text x="179" y="16" fill="#FFFFFF" font-size="10" font-weight="bold" text-anchor="middle">Eloquent ORM</text>
    </g>

    <!-- Backend Layer List -->
    <g transform="translate(20, 135)">
      <!-- Layer 1: Middleware -->
      <g transform="translate(0, 0)">
        <rect x="0" y="0" width="270" height="70" rx="10" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <!-- Shield Icon -->
        <path d="M22,18 L34,14 L34,26 C34,34 26,38 22,40 C18,38 10,34 10,26 L10,14 Z" fill="none" stroke="#800843" stroke-width="2" transform="translate(10, 5) scale(0.75)"/>
        <text class="list-title" x="48" y="24">Middleware</text>
        <text class="list-desc" x="48" y="42">Role-based Auth (Admin, Petugas, Guest)</text>
        <text class="list-desc" x="48" y="56">Mengamankan route panel manajemen</text>
      </g>

      <!-- Layer 2: Controller -->
      <g transform="translate(0, 85)">
        <rect x="0" y="0" width="270" height="70" rx="10" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <!-- Controller Icon (Sliders/Settings) -->
        <circle cx="16" cy="20" r="3" stroke="#800843" stroke-width="2" fill="none"/>
        <line x1="16" y1="10" x2="16" y2="17" stroke="#800843" stroke-width="2"/>
        <line x1="16" y1="23" x2="16" y2="34" stroke="#800843" stroke-width="2"/>
        <circle cx="26" cy="28" r="3" stroke="#800843" stroke-width="2" fill="none"/>
        <line x1="26" y1="10" x2="26" y2="25" stroke="#800843" stroke-width="2"/>
        <line x1="26" y1="31" x2="26" y2="34" stroke="#800843" stroke-width="2"/>
        <text class="list-title" x="48" y="24">Controller Layer</text>
        <text class="list-desc" x="48" y="42">DiagnosisController, GejalaController, dll.</text>
        <text class="list-desc" x="48" y="56">Validasi Request &amp; Koordinasi Flow Data</text>
      </g>

      <!-- Layer 3: Service Layer -->
      <g transform="translate(0, 170)">
        <rect x="0" y="0" width="270" height="75" rx="10" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1.5"/>
        <!-- Gear Icon (Process) -->
        <path d="M22,14 A8,8 0 1,0 38,30 A8,8 0 1,0 22,14 Z" fill="none" stroke="#800843" stroke-width="2" transform="translate(5, 5) scale(0.85)"/>
        <path d="M30,17 L30,11 M30,43 L30,37 M17,30 L11,30 M43,30 L37,30" stroke="#800843" stroke-width="2" transform="translate(5, 5) scale(0.85)"/>
        <text class="list-title" x="48" y="24">Service Layer (Inference Logic)</text>
        <text class="list-desc" x="48" y="42">DiagnosisService</text>
        <text class="list-desc" x="48" y="56">Kalkulasi CF &amp; Pencocokan Gejala</text>
        <text class="list-desc" x="48" y="68">Normalisasi &amp; Penyimpanan Riwayat</text>
      </g>

      <!-- Layer 4: Model (Eloquent ORM) -->
      <g transform="translate(0, 260)">
        <rect x="0" y="0" width="270" height="70" rx="10" fill="#FCEBF3" stroke="#F2D1DF" stroke-width="1"/>
        <!-- Database/Model Cylinders -->
        <ellipse cx="22" cy="18" rx="10" ry="4" fill="none" stroke="#800843" stroke-width="2" transform="translate(5, 5) scale(0.85)"/>
        <path d="M12,22 A10,4 0 0,0 32,22 L32,32 A10,4 0 0,1 12,32 Z" fill="none" stroke="#800843" stroke-width="2" transform="translate(5, 5) scale(0.85)"/>
        <text class="list-title" x="48" y="24">Model (Eloquent ORM)</text>
        <text class="list-desc" x="48" y="42">Gejala, Penyakit, Hama, Rule, dll.</text>
        <text class="list-desc" x="48" y="56">Interaksi database dengan OOP modern</text>
      </g>
    </g>
  </g>

  <!-- BACKEND TO INFERENCE CONNECTIONS -->
  <g>
    <!-- Upper path: logic delegation -->
    <path d="M 1100 310 L 1160 310" stroke="#800843" stroke-width="2.5" stroke-dasharray="4 2" marker-end="url(#arrowRight)"/>
    <rect x="1103" y="265" width="54" height="38" rx="3" fill="#FFFFFF" stroke="#800843" stroke-width="1"/>
    <text class="arrow-text" x="1130" y="280" text-anchor="middle">Delegasi</text>
    <text class="arrow-text" x="1130" y="293" text-anchor="middle">Logika</text>

    <!-- Lower path: return calculation -->
    <path d="M 1160 450 L 1100 450" stroke="#800843" stroke-width="2.5" stroke-dasharray="4 2" marker-end="url(#arrowRight)"/>
    <rect x="1103" y="458" width="54" height="24" rx="3" fill="#FFFFFF" stroke="#800843" stroke-width="1"/>
    <text class="arrow-text" x="1130" y="474" text-anchor="middle">Hasil CF</text>
  </g>

  <!-- CARD 4: MESIN INFERENSI -->
  <g class="card-box" transform="translate(1165, 160)" filter="url(#cardShadow)">
    <rect width="360" height="500" rx="14" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 14 A 14 14 0 0 1 14 0 L 346 0 A 14 14 0 0 1 360 14 L 360 45 L 0 45 Z" fill="url(#cardHeaderGrad)"/>
    <text class="card-header-title" x="180" y="27" text-anchor="middle">MESIN INFERENSI</text>
    
    <!-- 1. BACKWARD CHAINING -->
    <g transform="translate(20, 65)">
      <rect x="0" y="0" width="320" height="150" rx="10" fill="#FDF3F8" stroke="#F2D1DF" stroke-width="1"/>
      
      <!-- Target Icon (Bulls eye) -->
      <g transform="translate(25, 60)" scale="0.95">
        <circle cx="20" cy="20" r="18" fill="none" stroke="#A82255" stroke-width="2"/>
        <circle cx="20" cy="20" r="12" fill="none" stroke="#A82255" stroke-width="2"/>
        <circle cx="20" cy="20" r="5" fill="#A82255"/>
        <!-- Arrow going back -->
        <path d="M 50 20 L 25 20" stroke="#800843" stroke-width="2.5" marker-end="url(#arrowRight)"/>
        <!-- Dots linking -->
        <circle cx="65" cy="5" r="4" fill="#DCA2BA"/>
        <circle cx="65" cy="20" r="4" fill="#DCA2BA"/>
        <circle cx="65" cy="35" r="4" fill="#DCA2BA"/>
        <path d="M 65 5 L 50 20 M 65 35 L 50 20" stroke="#DCA2BA" stroke-width="1.5"/>
      </g>

      <text class="list-title" x="100" y="25" fill="#800843">1. BACKWARD CHAINING</text>
      <text class="bullet-text" x="100" y="50" font-weight="bold">Hipotesis Pertama:</text>
      <text class="list-desc" x="100" y="68">Pengguna memilih target penyakit/</text>
      <text class="list-desc" x="100" y="84">hama bawang merah di awal alur.</text>
      <text class="bullet-text" x="100" y="108" font-weight="bold">Penelusuran Aturan:</text>
      <text class="list-desc" x="100" y="126">Sistem mencari gejala-gejala pendukung</text>
      <text class="list-desc" x="100" y="142">dari basis aturan (backward trace).</text>
    </g>

    <!-- 2. CERTAINTY FACTOR (CF) -->
    <g transform="translate(20, 230)">
      <rect x="0" y="0" width="320" height="250" rx="10" fill="#FDF3F8" stroke="#F2D1DF" stroke-width="1"/>
      <text class="list-title" x="20" y="28" fill="#800843">2. CERTAINTY FACTOR (CF)</text>
      
      <!-- CF Formula 1 -->
      <g transform="translate(20, 45)">
        <rect x="0" y="0" width="280" height="50" rx="6" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1"/>
        <text class="bullet-text" x="10" y="20" font-weight="bold" fill="#800843">CF Gejala (Eksistensi):</text>
        <text class="formula-text" x="10" y="38">CF[H,e] = CF_pakar * CF_user</text>
      </g>

      <!-- CF Formula 2 -->
      <g transform="translate(20, 105)">
        <rect x="0" y="0" width="280" height="75" rx="6" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1"/>
        <text class="bullet-text" x="10" y="20" font-weight="bold" fill="#800843">CF Kombinasi (Kombinasi Gejala):</text>
        <text class="formula-text" x="10" y="38">CF_combine(CF_old, CF_new) =</text>
        <text class="formula-text" x="10" y="58">  CF_old + CF_new * (1 - CF_old)</text>
      </g>

      <!-- CF Output -->
      <g transform="translate(20, 190)">
        <text class="bullet-text" x="0" y="16" font-weight="bold">Nilai CF Akhir:</text>
        <text class="list-desc" x="0" y="34">- Skala 0.00 hingga 1.00 (atau 0% s/d 100%)</text>
        <text class="list-desc" x="0" y="50">- Persentase Keyakinan dari Hasil Diagnosis</text>
      </g>
    </g>
  </g>

  <!-- INFERENCE TO DATABASE CONNECTION -->
  <g>
    <path d="M 1525 380 L 1540 380 L 1540 380 L 1565 380" stroke="#800843" stroke-width="2.5" marker-start="url(#arrowLeft)" marker-end="url(#arrowRight)"/>
    <rect x="1518" y="325" width="50" height="38" rx="3" fill="#FFFFFF" stroke="#800843" stroke-width="1"/>
    <text class="arrow-text" x="1543" y="340" text-anchor="middle">SQL</text>
    <text class="arrow-text" x="1543" y="353" text-anchor="middle">Queries</text>
  </g>

  <!-- CARD 5: DATABASE (MySQL) -->
  <g class="card-box" transform="translate(1570, 160)" filter="url(#cardShadow)">
    <rect width="310" height="500" rx="14" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 14 A 14 14 0 0 1 14 0 L 296 0 A 14 14 0 0 1 310 14 L 310 45 L 0 45 Z" fill="url(#cardHeaderGrad)"/>
    <text class="card-header-title" x="155" y="27" text-anchor="middle">DATABASE MySQL</text>
    
    <!-- MySQL logo / title -->
    <text class="card-title-sub" x="20" y="70">MySQL / MariaDB RDBMS</text>

    <!-- Table list -->
    <g transform="translate(20, 90)">
      
      <!-- Table 1: users -->
      <g transform="translate(0, 0)">
        <!-- Table icon -->
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <ellipse cx="14" cy="10" rx="6" ry="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,10 L8,17 A6,2 0 0,0 20,17 L20,10" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,17 L8,24 A6,2 0 0,0 20,24 L20,17" fill="none" stroke="#A82255" stroke-width="1.5"/>
        
        <text class="list-title" x="40" y="14">users</text>
        <text class="list-desc" x="40" y="26">Data administrator &amp; petugas</text>
      </g>

      <!-- Table 2: penyakit -->
      <g transform="translate(0, 52)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <ellipse cx="14" cy="10" rx="6" ry="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,10 L8,17 A6,2 0 0,0 20,17 L20,10" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,17 L8,24 A6,2 0 0,0 20,24 L20,17" fill="none" stroke="#A82255" stroke-width="1.5"/>

        <text class="list-title" x="40" y="14">penyakit</text>
        <text class="list-desc" x="40" y="26">Master data penyakit bawang merah</text>
      </g>

      <!-- Table 3: hama -->
      <g transform="translate(0, 104)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <ellipse cx="14" cy="10" rx="6" ry="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,10 L8,17 A6,2 0 0,0 20,17 L20,10" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,17 L8,24 A6,2 0 0,0 20,24 L20,17" fill="none" stroke="#A82255" stroke-width="1.5"/>

        <text class="list-title" x="40" y="14">hama</text>
        <text class="list-desc" x="40" y="26">Master data hama bawang merah</text>
      </g>

      <!-- Table 4: gejala -->
      <g transform="translate(0, 156)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <ellipse cx="14" cy="10" rx="6" ry="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,10 L8,17 A6,2 0 0,0 20,17 L20,10" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,17 L8,24 A6,2 0 0,0 20,24 L20,17" fill="none" stroke="#A82255" stroke-width="1.5"/>

        <text class="list-title" x="40" y="14">gejala</text>
        <text class="list-desc" x="40" y="26">Master data gejala klinis bawang merah</text>
      </g>

      <!-- Table 5: rules -->
      <g transform="translate(0, 208)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <ellipse cx="14" cy="10" rx="6" ry="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,10 L8,17 A6,2 0 0,0 20,17 L20,10" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,17 L8,24 A6,2 0 0,0 20,24 L20,17" fill="none" stroke="#A82255" stroke-width="1.5"/>

        <text class="list-title" x="40" y="14">rules</text>
        <text class="list-desc" x="40" y="26">Aturan relasi target (penyakit/hama)</text>
      </g>

      <!-- Table 6: rule_details -->
      <g transform="translate(0, 260)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <ellipse cx="14" cy="10" rx="6" ry="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,10 L8,17 A6,2 0 0,0 20,17 L20,10" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,17 L8,24 A6,2 0 0,0 20,24 L20,17" fill="none" stroke="#A82255" stroke-width="1.5"/>

        <text class="list-title" x="40" y="14">rule_details</text>
        <text class="list-desc" x="40" y="26">Pemetaan detail gejala &amp; CF pakar</text>
      </g>

      <!-- Table 7: riwayat_deteksi -->
      <g transform="translate(0, 312)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <ellipse cx="14" cy="10" rx="6" ry="2" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,10 L8,17 A6,2 0 0,0 20,17 L20,10" fill="none" stroke="#A82255" stroke-width="1.5"/>
        <path d="M8,17 L8,24 A6,2 0 0,0 20,24 L20,17" fill="none" stroke="#A82255" stroke-width="1.5"/>

        <text class="list-title" x="40" y="14">riwayat_deteksi</text>
        <text class="list-desc" x="40" y="26">Hasil riwayat diagnosis &amp; input user</text>
      </g>
    </g>
  </g>

  <!-- ==================== MIDDLE ROW (2) ==================== -->

  <!-- CARD 6: OUTPUT SISTEM -->
  <g class="card-box" transform="translate(415, 680)" filter="url(#cardShadow)">
    <rect width="1110" height="95" rx="12" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 12 A 12 12 0 0 1 12 0 L 1098 0 A 12 12 0 0 1 1110 12 L 1110 32 L 0 32 Z" fill="url(#cardHeaderGrad2)"/>
    <text class="card-header-title" x="555" y="20" text-anchor="middle">OUTPUT SISTEM</text>

    <!-- Grid Items inside Output -->
    <g transform="translate(30, 45)">
      <!-- Output 1 -->
      <g transform="translate(0, 0)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <path d="M8,14 L12,18 L20,10" stroke="#A82255" stroke-width="2" fill="none"/>
        <text class="list-title" x="38" y="14">Hasil Diagnosis Penyakit / Hama</text>
        <text class="list-desc" x="38" y="30">Jenis penyakit/hama terdeteksi</text>
      </g>

      <!-- Output 2 -->
      <g transform="translate(260, 0)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <text x="14" y="19" fill="#A82255" font-size="12" font-weight="bold" text-anchor="middle">%</text>
        <text class="list-title" x="38" y="14">Nilai Keyakinan Akhir</text>
        <text class="list-desc" x="38" y="30">Presentase tingkat keyakinan (CF)</text>
      </g>

      <!-- Output 3 -->
      <g transform="translate(520, 0)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <path d="M10,8 L20,8 L20,22 L10,22 Z M10,12 L20,12 M10,17 L20,17" stroke="#A82255" stroke-width="1.5" fill="none"/>
        <text class="list-title" x="38" y="14">Informasi Detail Target</text>
        <text class="list-desc" x="38" y="30">Deskripsi, penyebab, dan gejala utama</text>
      </g>

      <!-- Output 4 -->
      <g transform="translate(790, 0)">
        <rect x="0" y="0" width="28" height="28" rx="6" fill="#FCEBF3" stroke="#F2D1DF"/>
        <path d="M14,8 L14,22 M8,14 L20,14" stroke="#A82255" stroke-width="2"/>
        <text class="list-title" x="38" y="14">Rekomendasi Solusi Penanganan</text>
        <text class="list-desc" x="38" y="30">Panduan tindakan kuratif/preventif</text>
      </g>
    </g>
  </g>

  <!-- ==================== BOTTOM ROW (3) ==================== -->

  <!-- CARD 7: ALUR INFERENSI SISTEM -->
  <g class="card-box" transform="translate(40, 790)" filter="url(#cardShadow)">
    <rect width="640" height="225" rx="14" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 14 A 14 14 0 0 1 14 0 L 626 0 A 14 14 0 0 1 640 14 L 640 40 L 0 40 Z" fill="url(#cardHeaderGrad)"/>
    <text class="card-header-title" x="320" y="25" text-anchor="middle">ALUR INFERENSI SISTEM</text>
    
    <!-- Flowchart Steps -->
    <g transform="translate(20, 60)">
      
      <!-- Step 1 -->
      <g transform="translate(0, 0)">
        <rect x="0" y="0" width="165" height="55" rx="8" fill="#FDF3F8" stroke="#F2D1DF"/>
        <circle cx="20" cy="27" r="10" fill="#A82255"/>
        <text x="20" y="31" fill="#FFFFFF" font-size="11" font-weight="bold" text-anchor="middle">1</text>
        <text class="list-title" x="38" y="24" font-size="12">Pilih Target</text>
        <text class="list-desc" x="38" y="38" font-size="11">Pilih penyakit/hama</text>
      </g>
      
      <!-- Arrow 1-2 -->
      <path d="M 172 27 L 208 27" stroke="#A82255" stroke-width="2" marker-end="url(#arrowRight)"/>

      <!-- Step 2 -->
      <g transform="translate(215, 0)">
        <rect x="0" y="0" width="170" height="55" rx="8" fill="#FDF3F8" stroke="#F2D1DF"/>
        <circle cx="20" cy="27" r="10" fill="#A82255"/>
        <text x="20" y="31" fill="#FFFFFF" font-size="11" font-weight="bold" text-anchor="middle">2</text>
        <text class="list-title" x="38" y="24" font-size="12">Cari Gejala</text>
        <text class="list-desc" x="38" y="38" font-size="11">Backward Chaining</text>
      </g>

      <!-- Arrow 2-3 -->
      <path d="M 392 27 L 428 27" stroke="#A82255" stroke-width="2" marker-end="url(#arrowRight)"/>

      <!-- Step 3 -->
      <g transform="translate(435, 0)">
        <rect x="0" y="0" width="165" height="55" rx="8" fill="#FDF3F8" stroke="#F2D1DF"/>
        <circle cx="20" cy="27" r="10" fill="#A82255"/>
        <text x="20" y="31" fill="#FFFFFF" font-size="11" font-weight="bold" text-anchor="middle">3</text>
        <text class="list-title" x="38" y="24" font-size="12">Input CF User</text>
        <text class="list-desc" x="38" y="38" font-size="11">Tingkat keyakinan</text>
      </g>

      <!-- Arrow down from 3 to 4 -->
      <path d="M 520 62 L 520 85" stroke="#A82255" stroke-width="2" marker-end="url(#arrowRight)"/>

      <!-- Step 4 (Below 3) -->
      <g transform="translate(435, 95)">
        <rect x="0" y="0" width="165" height="55" rx="8" fill="#FDF3F8" stroke="#F2D1DF"/>
        <circle cx="20" cy="27" r="10" fill="#A82255"/>
        <text x="20" y="31" fill="#FFFFFF" font-size="11" font-weight="bold" text-anchor="middle">4</text>
        <text class="list-title" x="38" y="24" font-size="12">Hitung CF</text>
        <text class="list-desc" x="38" y="38" font-size="11">DiagnosisService</text>
      </g>

      <!-- Arrow left from 4 to 5 -->
      <path d="M 428 122 L 392 122" stroke="#A82255" stroke-width="2" marker-end="url(#arrowRight)"/>

      <!-- Step 5 (Below 2) -->
      <g transform="translate(215, 95)">
        <rect x="0" y="0" width="170" height="55" rx="8" fill="#FDF3F8" stroke="#F2D1DF"/>
        <circle cx="20" cy="27" r="10" fill="#A82255"/>
        <text x="20" y="31" fill="#FFFFFF" font-size="11" font-weight="bold" text-anchor="middle">5</text>
        <text class="list-title" x="38" y="24" font-size="12">Tampilkan Hasil</text>
        <text class="list-desc" x="38" y="38" font-size="11">Skor CF &amp; persentase</text>
      </g>

      <!-- Arrow left from 5 to 6 -->
      <path d="M 208 122 L 172 122" stroke="#A82255" stroke-width="2" marker-end="url(#arrowRight)"/>

      <!-- Step 6 (Below 1) -->
      <g transform="translate(0, 95)">
        <rect x="0" y="0" width="165" height="55" rx="8" fill="#FDF3F8" stroke="#F2D1DF"/>
        <circle cx="20" cy="27" r="10" fill="#A82255"/>
        <text x="20" y="31" fill="#FFFFFF" font-size="11" font-weight="bold" text-anchor="middle">6</text>
        <text class="list-title" x="38" y="24" font-size="12">Solusi</text>
        <text class="list-desc" x="38" y="38" font-size="11">Rekomendasi pakar</text>
      </g>
    </g>
  </g>

  <!-- CARD 8: TEKNOLOGI YANG DIGUNAKAN -->
  <g class="card-box" transform="translate(700, 790)" filter="url(#cardShadow)">
    <rect width="580" height="225" rx="14" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 14 A 14 14 0 0 1 14 0 L 566 0 A 14 14 0 0 1 580 14 L 580 40 L 0 40 Z" fill="url(#cardHeaderGrad)"/>
    <text class="card-header-title" x="290" y="25" text-anchor="middle">TEKNOLOGI YANG DIGUNAKAN</text>
    
    <!-- Technology Icons & Columns -->
    <g transform="translate(20, 55)">
      
      <!-- Tech Category 1: Backend -->
      <g transform="translate(10, 10)">
        <text class="list-title" x="0" y="15" fill="#800843">BACKEND LAYER</text>
        
        <g transform="translate(0, 30)">
          <!-- PHP Badge -->
          <rect x="0" y="0" width="70" height="30" rx="6" fill="#777BB4"/>
          <text x="35" y="19" fill="#FFFFFF" font-size="12" font-weight="bold" text-anchor="middle">PHP 8.3</text>
          
          <!-- Laravel Badge -->
          <rect x="80" y="0" width="80" height="30" rx="6" fill="#FF2D20"/>
          <text x="120" y="19" fill="#FFFFFF" font-size="12" font-weight="bold" text-anchor="middle">Laravel 11</text>
          
          <!-- Eloquent Badge -->
          <rect x="0" y="40" width="160" height="30" rx="6" fill="#4F5D73"/>
          <text x="80" y="59" fill="#FFFFFF" font-size="12" font-weight="bold" text-anchor="middle">Eloquent ORM</text>
        </g>
      </g>
      
      <!-- Tech Category 2: Frontend -->
      <g transform="translate(200, 10)">
        <text class="list-title" x="0" y="15" fill="#800843">FRONTEND LAYER</text>
        
        <g transform="translate(0, 30)">
          <!-- Bootstrap Badge -->
          <rect x="0" y="0" width="85" height="30" rx="6" fill="#7952B3"/>
          <text x="42.5" y="19" fill="#FFFFFF" font-size="12" font-weight="bold" text-anchor="middle">Bootstrap 5</text>
          
          <!-- HTML5 & CSS3 -->
          <rect x="95" y="0" width="55" height="30" rx="6" fill="#E34F26"/>
          <text x="122.5" y="19" fill="#FFFFFF" font-size="12" font-weight="bold" text-anchor="middle">HTML5</text>
          
          <rect x="0" y="40" width="60" height="30" rx="6" fill="#1572B6"/>
          <text x="30" y="59" fill="#FFFFFF" font-size="12" font-weight="bold" text-anchor="middle">CSS3</text>
          
          <!-- Javascript -->
          <rect x="70" y="40" width="80" height="30" rx="6" fill="#F7DF1E"/>
          <text x="110" y="59" fill="#000000" font-size="12" font-weight="bold" text-anchor="middle">JavaScript</text>
        </g>
      </g>

      <!-- Tech Category 3: DB & Tools -->
      <g transform="translate(390, 10)">
        <text class="list-title" x="0" y="15" fill="#800843">DATABASE &amp; TOOLS</text>
        
        <g transform="translate(0, 30)">
          <!-- MySQL Badge -->
          <rect x="0" y="0" width="70" height="30" rx="6" fill="#00758F"/>
          <text x="35" y="19" fill="#FFFFFF" font-size="12" font-weight="bold" text-anchor="middle">MySQL</text>
          
          <!-- VS Code -->
          <rect x="80" y="0" width="70" height="30" rx="6" fill="#007ACC"/>
          <text x="115" y="19" fill="#FFFFFF" font-size="11" font-weight="bold" text-anchor="middle">VS Code</text>
          
          <!-- Laragon -->
          <rect x="0" y="40" width="150" height="30" rx="6" fill="#0D5EAF"/>
          <text x="75" y="59" fill="#FFFFFF" font-size="12" font-weight="bold" text-anchor="middle">Laragon Server</text>
        </g>
      </g>
    </g>

    <!-- Legend Lines -->
    <line x1="20" y1="180" x2="560" y2="180" stroke="#F2D1DF" stroke-width="1"/>
    
    <!-- Legend Details -->
    <g transform="translate(20, 192)">
      <line x1="0" y1="10" x2="30" y2="10" stroke="#800843" stroke-width="2.5" stroke-dasharray="1"/>
      <text class="list-desc" x="35" y="14" font-weight="bold">HTTP Flow</text>

      <line x1="130" y1="10" x2="160" y2="10" stroke="#800843" stroke-width="2.5"/>
      <text class="list-desc" x="165" y="14" font-weight="bold">Web Routes</text>

      <line x1="270" y1="10" x2="300" y2="10" stroke="#800843" stroke-width="2.5" stroke-dasharray="4 2"/>
      <text class="list-desc" x="305" y="14" font-weight="bold">Inference/DB Query</text>
    </g>
  </g>

  <!-- CARD 9: FILE KONFIGURASI PENTING -->
  <g class="card-box" transform="translate(1300, 790)" filter="url(#cardShadow)">
    <rect width="580" height="225" rx="14" fill="#FFFFFF" stroke="#F2D1DF" stroke-width="1.5"/>
    <path d="M 0 14 A 14 14 0 0 1 14 0 L 566 0 A 14 14 0 0 1 580 14 L 580 40 L 0 40 Z" fill="url(#cardHeaderGrad)"/>
    <text class="card-header-title" x="290" y="25" text-anchor="middle">FILE KONFIGURASI PENTING</text>
    
    <!-- Config Files Columns -->
    <g transform="translate(20, 50)">
      
      <!-- Col 1 -->
      <g transform="translate(0, 10)">
        
        <!-- File 1: .env -->
        <g transform="translate(0, 0)">
          <!-- File SVG Icon -->
          <path d="M2,2 L14,2 L20,8 L20,22 L2,22 Z M14,2 L14,8 L20,8" fill="none" stroke="#A82255" stroke-width="1.5" transform="translate(0, 2)"/>
          <text class="list-title" x="28" y="14">.env</text>
          <text class="list-desc" x="28" y="27">Konfigurasi database &amp; app key</text>
        </g>

        <!-- File 2: config/database.php -->
        <g transform="translate(0, 42)">
          <path d="M2,2 L14,2 L20,8 L20,22 L2,22 Z M14,2 L14,8 L20,8" fill="none" stroke="#A82255" stroke-width="1.5" transform="translate(0, 2)"/>
          <text class="list-title" x="28" y="14">config/database.php</text>
          <text class="list-desc" x="28" y="27">Konfigurasi driver koneksi MySQL</text>
        </g>

        <!-- File 3: routes/web.php -->
        <g transform="translate(0, 84)">
          <path d="M2,2 L14,2 L20,8 L20,22 L2,22 Z M14,2 L14,8 L20,8" fill="none" stroke="#A82255" stroke-width="1.5" transform="translate(0, 2)"/>
          <text class="list-title" x="28" y="14">routes/web.php</text>
          <text class="list-desc" x="28" y="27">Definisi route URL backend &amp; frontend</text>
        </g>

        <!-- File 4: app/Models/* -->
        <g transform="translate(0, 126)">
          <path d="M2,2 L14,2 L20,8 L20,22 L2,22 Z M14,2 L14,8 L20,8" fill="none" stroke="#A82255" stroke-width="1.5" transform="translate(0, 2)"/>
          <text class="list-title" x="28" y="14">app/Models/*</text>
          <text class="list-desc" x="28" y="27">Definisi model Eloquent ORM</text>
        </g>
      </g>

      <!-- Col 2 -->
      <g transform="translate(280, 10)">
        
        <!-- File 5: app/Http/Controllers/* -->
        <g transform="translate(0, 0)">
          <path d="M2,2 L14,2 L20,8 L20,22 L2,22 Z M14,2 L14,8 L20,8" fill="none" stroke="#A82255" stroke-width="1.5" transform="translate(0, 2)"/>
          <text class="list-title" x="28" y="14">app/Http/Controllers/*</text>
          <text class="list-desc" x="28" y="27">Controller pengatur logic aplikasi</text>
        </g>

        <!-- File 6: app/Services/* -->
        <g transform="translate(0, 42)">
          <path d="M2,2 L14,2 L20,8 L20,22 L2,22 Z M14,2 L14,8 L20,8" fill="none" stroke="#A82255" stroke-width="1.5" transform="translate(0, 2)"/>
          <text class="list-title" x="28" y="14">app/Services/*</text>
          <text class="list-desc" x="28" y="27">DiagnosisService (Algoritma CF)</text>
        </g>

        <!-- File 7: resources/views/* -->
        <g transform="translate(0, 84)">
          <path d="M2,2 L14,2 L20,8 L20,22 L2,22 Z M14,2 L14,8 L20,8" fill="none" stroke="#A82255" stroke-width="1.5" transform="translate(0, 2)"/>
          <text class="list-title" x="28" y="14">resources/views/*</text>
          <text class="list-desc" x="28" y="27">View Blade (Bootstrap template)</text>
        </g>
      </g>
    </g>
  </g>

  <!-- ==================== FOOTER ==================== -->
  
  <g transform="translate(960, 1045)">
    <!-- Footer Gradient bar -->
    <rect x="-850" y="-20" width="1700" height="35" rx="8" fill="url(#onionHeaderGrad)"/>
    
    <!-- Info Icon inside footer -->
    <g transform="translate(-835, -12)">
      <circle cx="10" cy="10" r="8" fill="none" stroke="#FFFFFF" stroke-width="1.5"/>
      <line x1="10" y1="6" x2="10" y2="8" stroke="#FFFFFF" stroke-width="2"/>
      <line x1="10" y1="10" x2="10" y2="14" stroke="#FFFFFF" stroke-width="1.5"/>
    </g>
    
    <text class="footer-text" x="-810" y="2">Sistem SIPATAN membantu petani melakukan diagnosis penyakit dan hama tanaman bawang merah secara cepat, akurat, dan berbasis pengetahuan pakar dengan Certainty Factor.</text>
  </g>

</svg>
"""
    output_dir = "c:\\laragon\\www\\PKL\\public\\assets\\images"
    os.makedirs(output_dir, exist_ok=True)
    output_path = os.path.join(output_dir, "arsitektur_sipatan.svg")
    
    with open(output_path, "w", encoding="utf-8") as f:
        f.write(svg_content)
    
    print(f"SVG successfully written to: {output_path}")

if __name__ == "__main__":
    generate_svg()
