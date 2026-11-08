@extends('layout')
@section('isi')

<!-- Kamera Pengawas (Proctoring) Ukuran Sedang di Pojok Kanan Atas -->
<div style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: #fff; padding: 10px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.25); text-align: center;">
    <p style="font-size: 12px; margin: 0 0 4px 0; font-weight: bold; color: #333;">Kamera Pengawas</p>
    <video id="webcam-ujian" autoplay playsinline width="240" height="180" style="border-radius: 6px; background: #000; object-fit: cover; transform: scaleX(-1); display: block; margin: 0 auto;"></video>
    <canvas id="canvas-proctor" style="display: none;"></canvas>
    <div id="status-warning" style="color: #dc3545; font-size: 11px; font-weight: bold; text-align: center; margin-top: 6px; min-height: 15px;"></div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kuis: {{ $materi->judul }}</h3>
    <h4 id="tm">5:00</h4>
</div>

<form method="POST" id="f" action="/kuis/{{ $materi->id }}">
    @csrf
    @foreach($soals as $i=>$s)
    <div class="card mb-3 shadow-sm" style="max-width: 750px;">
        <div class="card-body">
            <b>{{ $i+1 }}. {{ $s->pertanyaan }}</b>
            @foreach(['a','b','c','d'] as $o)
            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="j[{{ $s->id }}]" value="{{ $o }}" id="s{{ $s->id.$o }}">
                <label class="form-check-label" for="s{{ $s->id.$o }}">{{ $s->{'opsi_'.$o} }}</label>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary">Selesai dan lihat nilai</button>
</form>

<script>
    // Timer Mundur Ujian (5 Menit)
    let t = 300;
    setInterval(() => {
        t--;
        document.getElementById('tm').textContent = Math.floor(t / 60) + ':' + String(t % 60).padStart(2, '0');
        if (t <= 0) document.getElementById('f').submit();
    }, 1000);

    // Skrip Kamera Pengawas & Deteksi Gerakan/Aktivitas
    document.addEventListener("DOMContentLoaded", function () {
        const videoElement = document.getElementById('webcam-ujian');
        
        navigator.mediaDevices.getUserMedia({ video: true, audio: true })
            .then(function (stream) {
                videoElement.srcObject = stream;

                const canvas = document.getElementById('canvas-proctor');
                const context = canvas.getContext('2d');
                canvas.width = 100;
                canvas.height = 75;

                let lastData = null;
                let violationCount = 0;

                // Cek perubahan frame tiap 1 detik
                setInterval(() => {
                    if (videoElement.paused || videoElement.ended) return;
                    context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
                    const imgData = context.getImageData(0, 0, canvas.width, canvas.height);
                    const pixels = imgData.data;

                    if (lastData) {
                        let diff = 0;
                        for (let i = 0; i < pixels.length; i += 4) {
                            diff += Math.abs(pixels[i] - lastData[i]);
                        }
                        
                        // Sensitivitas gerakan (40.000 peka terhadap gerakan wajah & bibir)
                        let threshold = 40000; 

                        if (diff > threshold) {
                            violationCount++;
                            document.getElementById('status-warning').innerText = 'Peringatan: Terdeteksi Gerakan/Bicara! (' + violationCount + '/2)';
                            
                            if (violationCount >= 2) {
                                alert('Peringatan! Anda terdeteksi bergerak aktif atau berbicara. Ujian dibatalkan dan dikembalikan ke halaman utama.');
                                window.location.href = '/dashboard';
                            }
                        } else {
                            if (violationCount > 0) violationCount = Math.max(0, violationCount - 0.5);
                            if (violationCount === 0) {
                                document.getElementById('status-warning').innerText = '';
                            }
                        }
                    }
                    lastData = pixels;
                }, 1000);

            })
            .catch(function (error) {
                console.error("Gagal mengakses kamera:", error);
                alert("Peringatan: Harap izinkan akses kamera (webcam) dan mikrofon untuk mengikuti ujian ini.");
            });
    });
</script>

@endsection