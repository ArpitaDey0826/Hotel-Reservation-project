const items = [
    { title: "Deluxe Room", category: "Room", description: "Spacious room with sea view." },
    { title: "Spa Package", category: "Service", description: "Relaxing spa treatments." },
    { title: "Breakfast Buffet", category: "Service", description: "Unlimited breakfast choices." },
    { title: "Summer Offer", category: "Offer", description: "Get 20% off this summer!" },
    { title: "Executive Suite", category: "Room", description: "Luxury suite with VIP amenities." },
    { title: "Airport Pickup", category: "Service", description: "Convenient travel service." },
  ];
  
  function filterItems() {
    const query = document.getElementById("searchInput").value.toLowerCase();
    const category = document.getElementById("categoryFilter").value;
    const resultsContainer = document.getElementById("results");
  
    const filtered = items.filter(item => {
      const matchesCategory = category === "All" || item.category === category;
      const matchesQuery = item.title.toLowerCase().includes(query) || item.description.toLowerCase().includes(query);
      return matchesCategory && matchesQuery;
    });
  
    renderResults(filtered);
  }
  
  function renderResults(filteredItems) {
    const resultsContainer = document.getElementById("results");
    resultsContainer.innerHTML = "";
  
    if (filteredItems.length === 0) {
      resultsContainer.innerHTML = "<p>No results found.</p>";
      return;
    }
  
    filteredItems.forEach(item => {
      const div = document.createElement("div");
      div.className = "result-card";
      div.innerHTML = `<h3>${item.title}</h3><p>${item.description}</p>`;
      resultsContainer.appendChild(div);
    });
  }
  
  // Initial load
  window.onload = filterItems;
  