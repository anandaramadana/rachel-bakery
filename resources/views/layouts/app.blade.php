<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rachel Bakery</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    @include('components.nav')
    <section class="container-fluid">
        @yield('content')
    </section>
    @include('components.footer')
</body>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="{{ asset('plugins/popper.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    $(document).ready(function() {
        // Tampilkan semua produk saat halaman dimuat
        const products = $('.col-md-3.mb-4');

        function displayProducts(categoryId) {
            products.each(function() {
                const productCategory = $(this).data('category');
                if (categoryId === 'all' || productCategory == categoryId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        displayProducts('all'); // Tampilkan semua produk saat halaman dimuat

        // Filter produk berdasarkan kategori yang dipilih
        $('#categoryFilter').on('change', function() {
            const selectedCategory = $(this).val();
            displayProducts(selectedCategory);
        });
    });
</script>

<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        var telepon = document.getElementById('no_hp').value;
        var email = document.getElementById('email').value;

        var teleponValid = /^\d{10,12}$/;  // Validasi nomor telepon (10-12 digit)
        var emailValid = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;  // Validasi alamat email

        var error_no_hp = document.getElementById('error_no_hp');
        var errorEmail = document.getElementById('error_email');

        // Reset pesan error sebelum memvalidasi lagi
        error_no_hp.textContent = "";
        errorEmail.textContent = "";

        if (!teleponValid.test(telepon)) {
            error_no_hp.textContent = "Nomor telepon harus terdiri dari 10 hingga 12 digit.";
            e.preventDefault(); // Menghentikan pengiriman form
        }

        if (!emailValid.test(email)) {
            errorEmail.textContent = "Alamat email tidak valid.";
            e.preventDefault(); // Menghentikan pengiriman form
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var showPasswordCheckbox = document.getElementById('showPassword');
        var passwordInput = document.getElementById('password');

        // Menangani perubahan status checkbox
        showPasswordCheckbox.addEventListener('change', function () {
            if (showPasswordCheckbox.checked) {
                passwordInput.setAttribute('type', 'text');
            } else {
                passwordInput.setAttribute('type', 'password');
            }
        });
    });
</script>
<script>
    const inputFields = document.querySelectorAll('.form-control');
    const profileImage = document.getElementById('profileImage');
    const submitButton = document.getElementById('submitButton');

    // Simpan nilai awal input dalam array
    const previousValues = Array.from(inputFields, inputField => inputField.value);
    const originalImageSrc = profileImage.src;

    // Tambahkan event listener untuk mendengarkan perubahan pada inputan
    inputFields.forEach((inputField, index) => {
        inputField.addEventListener('input', checkSubmitButtonStatus);
    });

    // Tambahkan event listener untuk mendengarkan perubahan pada gambar
    profileImage.addEventListener('change', checkSubmitButtonStatus);

    function checkSubmitButtonStatus() {
        let inputChanged = false;
        let imageChanged = false;

        inputFields.forEach((inputField, index) => {
            if (inputField.value.trim() !== '' && inputField.value !== previousValues[index]) {
                inputChanged = true;
            }
        });

        if (profileImage.src !== originalImageSrc) {
            imageChanged = true;
        }

        if (inputChanged || imageChanged) {
            // Aktifkan tombol jika ada perubahan pada input atau gambar
            submitButton.removeAttribute('disabled');
        } else {
            // Nonaktifkan tombol jika tidak ada perubahan
            submitButton.setAttribute('disabled', 'true');
        }
    }
</script>

<!-- <script>
    // Daftar produk contoh
    const products = [
        { id: 1, name: "Produk A", description: "Deskripsi produk A", image: "https://via.placeholder.com/150", category: "kategori1" },
        { id: 2, name: "Produk B", description: "Deskripsi produk B", image: "https://via.placeholder.com/150", category: "kategori2" },
        { id: 3, name: "Produk C", description: "Deskripsi produk C", image: "https://via.placeholder.com/150", category: "kategori1" },
        { id: 4, name: "Produk D", description: "Deskripsi produk D", image: "https://via.placeholder.com/150", category: "kategori3" }
    ];

    // Fungsi untuk menampilkan produk
    function displayProducts(products) {
        const productList = $('#productList');
        productList.empty();
        products.forEach(product => {
            const productCard = `
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="${product.image}" class="card-img-top" alt="${product.name}">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                        </div>
                    </div>
                </div>
            `;
            productList.append(productCard);
        });
    }

    // Menampilkan semua produk saat halaman dimuat
    $(document).ready(function() {
        displayProducts(products);

        // Filter produk berdasarkan kategori yang dipilih
        $('#categoryFilter').on('change', function() {
            const selectedCategory = $(this).val();
            const filteredProducts = selectedCategory === "all" ? products : products.filter(product => product.category === selectedCategory);
            displayProducts(filteredProducts);
        });
    });
</script> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const paketGrid = document.querySelector('.paket-grid');

        let isDown = false;
        let startX;
        let scrollLeft;

        paketGrid.addEventListener('mousedown', (e) => {
            isDown = true;
            paketGrid.classList.add('active');
            startX = e.pageX - paketGrid.offsetLeft;
            scrollLeft = paketGrid.scrollLeft;
        });

        paketGrid.addEventListener('mouseleave', () => {
            isDown = false;
            paketGrid.classList.remove('active');
        });

        paketGrid.addEventListener('mouseup', () => {
            isDown = false;
            paketGrid.classList.remove('active');
        });

        paketGrid.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - paketGrid.offsetLeft;
            const walk = (x - startX) * 3; // Adjust scroll speed
            paketGrid.scrollLeft = scrollLeft - walk;
        });
    });
</script> -->

<!-- <script>
    let items = document.querySelectorAll('.header-container .slider-container .slider');
    let next = document.getElementById('next');
    let prev = document.getElementById('prev');

    let countItem = items.length;
    let itemActive = 0;

    document.getElementById('next').addEventListener('click', function() {
        itemActive = itemActive + 1;
        if (itemActive >= countItem) {
            itemActive = 0;
        }
        showSlider();
    });

    document.getElementById('prev').onclick = function() {
        itemActive = itemActive - 1;
        if (itemActive < 0) {
            itemActive = countItem - 1;
        }
        showSlider();
    }

    let refreshInterval = setInterval(() => {
        next.click();
    }, 3000)

    function showSlider() {
        let itemActiveOld = document.querySelector('.header-container .slider-container .slider.active');
        itemActiveOld.classList.remove('active');

        items[itemActive].classList.add('active');

        clearInterval(refreshInterval);
        refreshInterval = setInterval(() => {
            next.click();
        }, 5000)
    }
</script> -->
</html>
