document.addEventListener("DOMContentLoaded", () => {
  const checkBtn = document.getElementById("checkAvailability");
  const results = document.getElementById("results");

  const seasonalRates = {
    "low": 100,
    "mid": 150,
    "high": 200
  };

  function getSeason(month) {
    if ([6,7,8].includes(month)) return "high";
    if ([3,4,5,9].includes(month)) return "mid";
    return "low";
  }

  function calculateStayInfo(start, end) {
    const dayInMS = 86400000;
    const nights = Math.ceil((end - start) / dayInMS);
    let total = 0;
    let details = "";

    for (let i = 0; i < nights; i++) {
      const date = new Date(start.getTime() + i * dayInMS);
      const season = getSeason(date.getMonth() + 1);
      const rate = seasonalRates[season];
      total += rate;
      details += `<li>${date.toDateString()}: $${rate} (${season} season)</li>`;
    }

    return {
      nights,
      total,
      breakdown: details
    };
  }

  checkBtn.addEventListener("click", () => {
    const checkin = new Date(document.getElementById("checkin").value);
    const checkout = new Date(document.getElementById("checkout").value);

    if (isNaN(checkin.getTime()) || isNaN(checkout.getTime()) || checkout <= checkin) {
      results.innerHTML = "<p>Please select valid check-in and check-out dates.</p>";
      return;
    }

    const stay = calculateStayInfo(checkin, checkout);
    results.innerHTML = \`
      <h2>Available Rooms</h2>
      <p>Nights: \${stay.nights}</p>
      <p>Total Cost: $ \${stay.total}</p>
      <ul>\${stay.breakdown}</ul>
    \`;
  });
});
