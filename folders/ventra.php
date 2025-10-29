<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Вентра — Панель</title>

  <style>
    :root {
      --vt-bg: #f5f7fa;
      --vt-card: #ffffff;
      --vt-primary: #007bff;
      --vt-primary-dark: #0056d8;
      --vt-muted: #8a93a6;
      --vt-radius: 12px;
      --vt-shadow: 0 6px 20px rgba(2, 6, 23, 0.06);
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }
    body {
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: var(--vt-bg);
      color: #1f2937;
    }

    .vt-page {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 24px;
      padding: 28px 16px;
    }

    /* ---------- HEADER ---------- */
    .vt-header {
      width: 100%;
      max-width: 980px;
      background: var(--vt-card);
      border-radius: 16px;
      padding: 12px 18px;
      box-shadow: var(--vt-shadow);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }

    .vt-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .vt-brand__logo {
      width: 64px;
      height: 64px;
      border-radius: 14px;
      background: linear-gradient(135deg, #e6f0ff, #dff1ff);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: var(--vt-primary-dark);
      box-shadow: 0 2px 6px rgba(0, 123, 255, 0.08);
      font-size: 15px;
      line-height: 1.2;
      text-align: center;
    }

    .vt-brand__day {
      font-size: 15px;
      font-weight: 700;
    }

    .vt-brand__date {
      font-size: 13px;
      color: var(--vt-primary);
      margin-top: 2px;
    }

    .vt-brand__title {
      font-size: 20px;
      font-weight: 700;
      color: #0b2540;
    }

    .vt-header__actions {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .vt-btn--admin {
      background: var(--vt-primary);
      color: #fff;
      border: none;
      padding: 10px 14px;
      border-radius: 10px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 6px 18px rgba(0, 123, 255, 0.18);
      transition: transform .15s ease, background .15s;
    }

    .vt-btn--admin:active { transform: translateY(1px); }
    .vt-btn--admin:hover { background: var(--vt-primary-dark); }

    .vt-hr {
      width: 85%;
      max-width: 980px;
      height: 1px;
      border: none;
      background: #e6e9ef;
      margin: 6px 0 0;
    }

    /* ---------- MAIN ---------- */
    .vt-main {
      width: 100%;
      max-width: 980px;
      display: flex;
      justify-content: center;
      padding-top: 18px;
    }

    .vt-cards {
      display: flex;
      flex-direction: column;
      gap: 18px;
      align-items: center;
      width: 320px;
    }

    .vt-card {
      width: 160px;
      height: 72px;
      border-radius: 14px;
      background: linear-gradient(180deg, var(--vt-primary), var(--vt-primary-dark));
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      box-shadow: 0 8px 20px rgba(2, 6, 23, 0.12);
      transition: transform .14s ease, box-shadow .14s ease;
      font-weight: 700;
      border: 2px solid rgba(255, 255, 255, 0.06);
    }

    .vt-card:hover { transform: translateY(-6px); box-shadow: 0 14px 30px rgba(2, 6, 23, 0.14); }
    .vt-card__icon { font-size: 20px; margin-bottom: 6px; }
    .vt-card__label { font-size: 15px; }

    @media (max-width: 420px) {
      .vt-cards { width: 260px; }
      .vt-card { width: 100%; height: 62px; border-radius: 12px; }
    }

    .vt-footer {
      width: 100%;
      max-width: 980px;
      text-align: center;
      color: var(--vt-muted);
      font-size: 13px;
      padding: 12px 0 40px;
    }
  </style>
</head>
<body>
  <div class="vt-page">

    <header class="vt-header" role="banner">
      <div class="vt-brand">
        <!-- Вместо "ВТ" теперь вставляется текущая дата -->
        <div class="vt-brand__logo" id="vt-date-box">
          <div class="vt-brand__day">--</div>
          <div class="vt-brand__date">--</div>
        </div>
        <div>
          <div class="vt-brand__title">Вентра</div>
          <div style="font-size:12px;color:#7b8696">Панель управления</div>
        </div>
      </div>

      <div class="vt-header__actions">
        <a href="../index.php" style="text-decoration:none">
          <button class="vt-btn--admin" type="button">Админка</button>
        </a>
      </div>
    </header>

    <hr class="vt-hr" />

    <main class="vt-main" role="main">
      <div class="vt-cards" role="navigation" aria-label="Главное меню">
        <a class="vt-card" href="ventor_map.php" target="_blank">
          <div class="vt-card__icon">🗺️</div>
          <div class="vt-card__label">Карта</div>
        </a>

        <a class="vt-card" href="ventra/home.php" target="_blank">
          <div class="vt-card__icon">🏠</div>
          <div class="vt-card__label">Дома</div>
        </a>
        <a class="vt-card" href="/file/documents/ventra_motivation/price.jpg" target="_blank">
          <div class="vt-card__icon">💪</div>
          <div class="vt-card__label">Мотивация</div>
        </a>
      </div>
    </main>

    <footer class="vt-footer">© 2025 Вентра</footer>
  </div>

  <script>
    const dateBox = document.getElementById('vt-date-box');
    const dayNames = ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'];
    const now = new Date();
    const day = dayNames[now.getDay()];
    const date = now.getDate();
    dateBox.querySelector('.vt-brand__day').textContent = day;
    dateBox.querySelector('.vt-brand__date').textContent = date;
  </script>
</body>
</html>
