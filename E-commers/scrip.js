// Data produk
const products = [
  { name: 'Laptop', price: 10000000, category: 'Laptop', description: 'Laptop canggih dengan performa tinggi.', image: 'gambar/laptop.JPG' },
  { name: 'Smartphone', price: 5000000, category: 'Elektronik', description: 'Smartphone dengan kamera terbaik.', image: 'gambar/Samsung.JPEG' },
  { name: 'Kaos Polos', price: 150000, category: 'Pakaian', description: 'Kaos polos nyaman dipakai sehari-hari.', image: 'gambar/kaos.JPG' },
  { name: 'Blender', price: 300000, category: 'Peralatan Rumah', description: 'Blender multifungsi untuk dapur.', image: 'gambar/belender.JPEG' },
  { name: 'Kamera DSLR', price: 8000000, category: 'Elektronik', description: 'Kamera DSLR dengan kualitas gambar tinggi.', image: 'gambar/dslr.JPEG' },
  { name: 'Sepatu Sneakers', price: 600000, category: 'Pakaian', description: 'Sepatu sneakers stylish dan nyaman.', image: 'gambar/sepatu.JPEG' }
];

// Menampilkan produk
function displayProducts(filteredProducts) {
  const productList = document.getElementById('productList');
  productList.innerHTML = '';
  filteredProducts.forEach(product => {
    const productCard = `
      <div class="col-md-4 mb-4">
        <div class="card product-card">
          <img src="${product.image}" class="card-img-top product-img" alt="${product.name}">
          <div class="card-body">
            <h5 class="card-title">${product.name}</h5>
            <p class="card-text">${product.description}</p>
            <p class="card-text">Rp ${product.price.toLocaleString('id-ID')}</p>
          </div>
        </div>
      </div>
    `;
    productList.innerHTML += productCard;
  });
}

// Filter produk
function filterProducts() {
  const minPrice = parseInt(document.getElementById('minPrice').value) || 0;
  const maxPrice = parseInt(document.getElementById('maxPrice').value) || Infinity;
  const category = document.getElementById('category').value;

  const filteredProducts = products.filter(product => {
    return product.price >= minPrice &&
           product.price <= maxPrice &&
           (category ? product.category === category : true);
  });

  displayProducts(filteredProducts);
}

// Tampilkan semua produk saat pertama kali
document.addEventListener('DOMContentLoaded', () => {
  displayProducts(products);
});
