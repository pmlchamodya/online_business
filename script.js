// Load products dynamically on products.html
if (document.getElementById("product-list")) {
  fetch("backend/get_products.php")
    .then(res => res.json())
    .then(data => {
      let list = document.getElementById("product-list");
      list.innerHTML = data.map(p => `
        <div class="card">
          <h3>${p.name}</h3>
          <p>${p.description}</p>
          <p><b>Price:</b> $${p.price}</p>
        </div>
      `).join("");
    });
}
