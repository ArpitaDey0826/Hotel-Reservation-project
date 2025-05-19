document.addEventListener("DOMContentLoaded", () => {
  const savePrefsBtn = document.getElementById("savePrefs");
  const earnPointsBtn = document.getElementById("earnPoints");
  const historyList = document.getElementById("stayHistory");
  const loyaltyPoints = document.getElementById("loyaltyPoints");

  function loadPreferences() {
    const floor = localStorage.getItem("floorPref") || "";
    const view = localStorage.getItem("viewPref") || "";
    const special = localStorage.getItem("specialReq") || "";
    document.getElementById("floorPref").value = floor;
    document.getElementById("viewPref").value = view;
    document.getElementById("specialReq").value = special;
  }

  function loadLoyalty() {
    const points = parseInt(localStorage.getItem("loyaltyPoints") || "0");
    const history = JSON.parse(localStorage.getItem("stayHistory") || "[]");
    updateHistory(history);
    loyaltyPoints.textContent = `Loyalty Points: ${points}`;
  }

  function updateHistory(history) {
    historyList.innerHTML = "";
    history.forEach(item => {
      const li = document.createElement("li");
      li.textContent = item;
      historyList.appendChild(li);
    });
  }

  savePrefsBtn.addEventListener("click", () => {
    const floor = document.getElementById("floorPref").value;
    const view = document.getElementById("viewPref").value;
    const special = document.getElementById("specialReq").value;

    localStorage.setItem("floorPref", floor);
    localStorage.setItem("viewPref", view);
    localStorage.setItem("specialReq", special);

    alert("Preferences saved successfully!");
  });

  earnPointsBtn.addEventListener("click", () => {
    const points = parseInt(localStorage.getItem("loyaltyPoints") || "0") + 100;
    localStorage.setItem("loyaltyPoints", points.toString());

    const date = new Date().toLocaleDateString();
    const history = JSON.parse(localStorage.getItem("stayHistory") || "[]");
    history.push(`Stay on ${date} - 100 Points Earned`);
    localStorage.setItem("stayHistory", JSON.stringify(history));

    updateHistory(history);
    loyaltyPoints.textContent = `Loyalty Points: ${points}`;
  });

  loadPreferences();
  loadLoyalty();
});
