<div class="auth-main-bg">
  <a href="/" class="back-arrow-btn" title="Kembali ke Beranda">
    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#fbb03b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
  </a>
  <div class="auth-glass-box wide">
    <div class="auth-form-side">
      <div class="auth-logo mb-4 text-center">
        <span class="fw-bold" style="font-size:2.2rem;color:#fbb03b;letter-spacing:1px;">LaporPak!</span>
      </div>
      <center><h2 class="mb-2" style="font-weight:700;">Masuk</h2></center>
      <span class="mb-3" style="color:#c9c9c9;font-size:1.04em;">Silakan masuk untuk melanjutkan</span>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <input type="email" name="email" class="form-control auth-input w-100" placeholder="Email" required autofocus>
        </div>
        <div class="mb-4">
          <input type="password" name="password" class="form-control auth-input w-100" placeholder="Kata Sandi" required>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Ingat Saya</label>
          </div>
          <a href="{{ route('password.request') }}" class="text-link">Lupa Sandi?</a>
        </div>
        <div class="d-flex justify-content-center mb-3">
          <center><button type="submit" class="btn auth-btn px-5">Masuk</button></center>
        </div>
        <div class="text-center mt-2">
          Belum punya akun? <a href="{{ route('register') }}" class="text-link">Daftar</a>
        </div>
      </form>
    </div>
  </div>
</div>
<style>
  html, body {
    height: 100%; min-height: 100vh; width: 100vw; margin: 0; padding: 0; overflow: hidden; background: #151f2e;
  }
  .auth-main-bg {
    min-height: 100vh; width: 100vw; background: radial-gradient(ellipse at top left, #fbb03b22 0%, transparent 60%), radial-gradient(ellipse at bottom right, #fbb03b33 0%, transparent 70%), #151f2e; display: flex; align-items: center; justify-content: center;
  }
  .auth-glass-box {
    display: flex; flex-direction: row; background: rgba(30,34,44,0.92); border-radius: 24px; box-shadow: 0 6px 32px 0 #0002; overflow: hidden; max-width: 640px; width: 100%; min-height: 430px; transition: max-width 0.2s;
  }
  .auth-glass-box.wide {
    max-width: 640px;
  }
  .auth-form-side {
    flex: 1 1 0; padding: 48px 48px; display: flex; flex-direction: column; justify-content: center; background: rgba(255,255,255,0.09); backdrop-filter: blur(2px);
  }
  .auth-logo {
    font-family: 'Poppins', Arial, sans-serif; font-weight: bold;
  }
  .auth-btn {
    background: linear-gradient(90deg,#fbb03b 0%, #fbb03b 60%, #ffb84d 100%); color: #fff; font-weight: 600; font-size: 1.1rem; border: none; border-radius: 8px; box-shadow: 0 2px 8px #fbb03b22; transition: background 0.2s; min-width: 120px; text-align: center;
  }
  .auth-btn:hover { background: linear-gradient(90deg,#fbb03b 0%, #ffb84d 100%); }
  .auth-input {
    background: #252e3c; color: #fff; border: 1.5px solid #fbb03b55; border-radius: 8px; padding: 12px 16px; font-size: 1.13em; margin-bottom: 0.2em; width: 100%;
  }
  .auth-input:focus { border-color: #fbb03b; background: #232b39; color: #fff; }
  .text-link { color: #fbb03b; text-decoration: underline; font-weight: 500; }
  .text-link:hover { color: #fff; }
  .text-center.mt-2 { margin-top: 18px; }
  .back-arrow-btn {
    position: absolute;
    top: 32px;
    left: 32px;
    z-index: 10;
    background: rgba(30,34,44,0.88);
    border-radius: 50%;
    padding: 7px 8px 7px 7px;
    box-shadow: 0 2px 12px #0002;
    transition: background 0.18s;
    display: inline-block;
    line-height: 1;
  }
  .back-arrow-btn:hover {
    background: #fbb03b22;
    box-shadow: 0 4px 18px #fbb03b33;
  }
  @media (max-width: 800px) {
    .auth-glass-box, .auth-glass-box.wide { max-width: 98vw; }
    .auth-form-side { padding: 32px 8vw; }
  }
  @media (max-width: 600px) {
    .auth-form-side { padding: 24px 5vw; }
    .auth-glass-box, .auth-glass-box.wide { border-radius: 0; }
    .back-arrow-btn { top: 14px; left: 12px; padding: 4px 5px 4px 4px; }
  }
</style>
