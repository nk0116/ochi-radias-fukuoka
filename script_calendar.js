{
  // 各セレクトボックスを取得
  const yearSelect = document.getElementById("birth-year");
  const monthSelect = document.getElementById("birth-month");
  const daySelect = document.getElementById("birth-day");

  // 現在の年を取得
  const currentYear = new Date().getFullYear();

  // 年の選択肢を追加（1900年〜今年まで）
  for (let i = currentYear; i >= 1900; i--) {
    let option = document.createElement("option");
    option.value = i;
    option.textContent = i;
    if (i === 2000) option.selected = true;
    yearSelect.appendChild(option);
  }

  // 月の選択肢を追加（1〜12月）
  for (let i = 1; i <= 12; i++) {
    let option = document.createElement("option");
    option.value = i;
    option.textContent = i;
    if (i === 1) option.selected = true; // ← 1月をデフォルト選択
    monthSelect.appendChild(option);
  }

  // 日の選択肢を追加（1〜31日）
  function updateDays() {
    daySelect.innerHTML = ""; // いったんリセット
    let year = parseInt(yearSelect.value);
    let month = parseInt(monthSelect.value);
    
    if (!year || !month) return;

    // その年・月の最大日数を取得
    let lastDay = new Date(year, month, 0).getDate();
    
    for (let i = 1; i <= lastDay; i++) {
      let option = document.createElement("option");
      option.value = i;
      option.textContent = i;
      if (i === 1) option.selected = true; // ← 1日をデフォルト選択
      daySelect.appendChild(option);
    }
  }

  // 初期表示で 2000年1月1日 をセット
  updateDays();

  // 年 or 月を選んだら、日付を更新
  yearSelect.addEventListener("change", updateDays);
  monthSelect.addEventListener("change", updateDays);
}