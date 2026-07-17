<div align="right">
  <a href="README.md"><img src="https://img.shields.io/badge/Language-English-blue?style=for-the-badge&logo=translation" alt="English"></a>
</div>

<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
  
  <h1>CogniTicket | Modern Yapay Zeka Destekli Destek Sistemi</h1>

  <p>
    <strong>Modern web geliştirme standartlarını, Clean Architecture (Temiz Mimari) prensiplerini ve premium UX/UI tasarımını bir araya getiren yüksek performanslı, full-stack bir SaaS uygulaması.</strong>
  </p>

  <p>
    <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP 8.4" />
    <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel 12" />
    <img src="https://img.shields.io/badge/Groq_API_(Llama_3)-F55036?style=flat-square&logo=ai&logoColor=white" alt="Groq API" />
    <img src="https://img.shields.io/badge/Laravel_Queues-333333?style=flat-square&logo=laravel&logoColor=white" alt="Laravel Queues" />
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" />
    <img src="https://img.shields.io/badge/Vanilla_JS-F7DF1E?style=flat-square&logo=javascript&logoColor=black" alt="Vanilla JS" />
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL" />
  </p>
</div>

---

## Proje Özeti

**CogniTicket**, müşteri destek süreçlerini verimli bir şekilde yönetmek için tasarlanmış yeni nesil bir bilet (ticket) yönetim sistemidir. **Laravel 12** kullanılarak sıfırdan inşa edilmiş olup; **MVC Tasarım Deseni**, **Nesne Yönelimli Programlama (OOP)** ve **Clean Code** (Temiz Kod) standartları gibi ileri düzey yazılım mühendisliği prensiplerini uygulamalı olarak göstermektedir.

Uygulama, geleneksel ve yavaş sayfa yükleme mantığından tamamen sıyrılarak, gücünü **Vanilla JavaScript (Fetch API)**'den alan kesintisiz bir **SPA (Single Page Application)** deneyimi sunar. Arayüz, ağır frontend kütüphanelerine ihtiyaç duyulmadan Tailwind CSS kullanılarak özel olarak tasarlanmış modern **Glassmorphism (Cam Efekti)** temasıyla şekillendirilmiştir.

## 📸 Ekran Görüntüleri

<div align="center">
  <img src="docs/images/landing.png" alt="Açılış Sayfası" width="800">
  <br><em>Açılış Sayfası (Landing Page)</em><br><br>

  <img src="docs/images/dashboard.png" alt="Kontrol Paneli" width="800">
  <br><em>Kontrol Paneli (Dashboard)</em><br><br>

  <img src="docs/images/tickets.png" alt="Bilet Yönetimi" width="800">
  <br><em>Bilet Yönetimi (Tickets Management)</em><br><br>
</div>

## Temel Özellikler ve Teknik Detaylar

| Özellik | Açıklama |
| :--- | :--- |
| **Clean Architecture** | MVC prensiplerine sıkı sıkıya bağlılık. İş mantığı (business logic); sürdürülebilir ve test edilebilir bir kod yapısı için Service sınıfları, Enum'lar ve Form Request'ler kullanılarak ayrıştırılmıştır. |
| **Asenkron Arayüz** | Global AJAX yöneticileri ve dinamik DOM güncellemeleri sayesinde tüm formlar, tablolar ve sayfalama işlemleri sayfa yenilenmeden şimşek hızında gerçekleşir. |
| **Asenkron Yapay Zeka Analizi** | Otomatik bilet özetleri ve öngörüler çıkarmak için **Groq API (Llama 3.3 70B)** kullanılarak gerçek yapay zeka entegrasyonu sağlanmıştır. Sistemin kilitlenmesini engellemek için **Laravel Queues** ile asenkron arka plan işçileri ve yüksek performanslı okumalar için **Cache (Önbellek)** mimarisi kullanılmıştır. |
| **Premium UI/UX Tasarım** | Tailwind CSS ve Anime.js kullanılarak sıfırdan geliştirilen özel "Glassmorphism" teması. Akıcı mikro animasyonlar, neon vurgular ve tam uyumlu (responsive) mizanpaj içerir. |
| **Çoklu Dil Desteği (i18n)** | Laravel'in JSON çeviri mimarisi kullanılarak oluşturulmuş, oturum (session) tabanlı sorunsuz İngilizce ve Türkçe dil desteği. |
| **Güvenlik ve Yetkilendirme** | Role-Based Access Control (RBAC - Rol Bazlı Erişim), CSRF koruması, güvenli dosya yükleme algoritmaları ve şifrelenmiş oturum yönetimi. |

## Sistem Mimarisi

```text
├── app/
│   ├── Http/Controllers/    # HTTP isteklerini yöneten temiz denetleyiciler
│   ├── Jobs/                # Asenkron kuyruk işçileri (Örn: Yapay Zeka Analizi)
│   ├── Services/            # Ana iş mantığı (Business Logic) ve harici servisler
│   ├── Enums/               # Güçlü tiplere sahip durum yöneticileri
│   └── Models/              # Kesin ilişkilere sahip Eloquent ORM modelleri
├── resources/
│   ├── js/                  # Modüler Vanilla JS (AJAX işlemleri, UI animasyonları)
│   └── views/               # Dinamik Blade bileşenleri ve şablonlar
└── lang/                    # JSON tabanlı çeviri dosyaları (en.json, tr.json)
```

## Kurulum Adımları

Projeyi kendi bilgisayarınızda çalıştırmak için sisteminizde PHP, Composer, Node.js ve MySQL'in kurulu olduğundan emin olun.

```bash
# 1. Projeyi klonlayın
git clone https://github.com/kullanici-adiniz/cogni-ticket.git

# 2. PHP ve Node.js bağımlılıklarını kurun
composer install
npm install

# 3. Ortam değişkenlerini hazırlayın
cp .env.example .env
php artisan key:generate

# 4. .env Dosyasını Yapılandırın
# İlgili satırlara Groq API Anahtarınızı ekleyin ve Kuyruk (Queue) bağlantısını veritabanı yapın:
GROQ_API_KEY=sizin_api_anahtariniz
QUEUE_CONNECTION=database

# 5. Veritabanını oluşturun ve örnek verileri (seed) yükleyin
php artisan migrate --seed

# 6. Asset'leri derleyin
npm run build

# 7. Sunucuyu ve Kuyruk İşçisini Başlatın
# Aşağıdaki iki komutu ayrı ayrı terminal pencerelerinde çalıştırın:
php artisan serve
php artisan queue:work
```

## Neden Bu Proje? (İnsan Kaynakları ve İşe Alım Uzmanları İçin)

Bu proje, ölçeklenebilir ve canlı ortama (production) hazır web uygulamaları geliştirme yetkinliğimi göstermek amacıyla hazırlanmıştır. Aşağıdaki konulardaki uzmanlığımı vurgular:
- Modern PHP kullanarak **SOLID**, **DRY** prensiplerine uygun, okunabilir backend (arka uç) kodu yazabilme yeteneği.
- Ağır kütüphanelere bağımlı kalmadan, **API-first** (Önce API) yaklaşımıyla asenkron iletişim katmanları kurabilme.
- Harici (Third-Party) API servislerini (Örn: Groq Llama 3) arka planda iş kuyrukları (Jobs/Queues) yardımıyla asenkron ve güvenli entegre edebilme.
- Sıfırdan **piksel mükemmelliğinde (pixel-perfect)** ve kullanıcı dostu (UI/UX) arayüzler tasarlayabilme.
- Karmaşık yazılım gereksinimlerini tek başına analiz edip mimarisini kurgulayabilme ve problem çözme becerisi.

---
<div align="center">
  <i>Temiz kod ve harika tasarıma olan tutkuyla geliştirildi.</i>
</div>
