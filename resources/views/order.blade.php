@extends('layouts.main')
@section('content')
    <div class="d-flex align-items-center justify-content-between py-3 px-2 sticky-top bg-body">
        <div class="d-flex justify-content-center align-items-center d-flex overflow-scroll gap-2 w-100">
            <button class="btn btn-sm active d-flex nav-step border rounded-2 border-primary" type="button">Pilih
                Menu</button>
            <button class="btn btn-sm nav-step border rounded-2 border-primary" type="button">Pilih Meja</button>
            <button class="btn btn-sm nav-step border rounded-2 border-primary" type="button">Pembayaran</button>
            <button class="btn btn-sm nav-step border rounded-2 border-primary" type="button">Selesai</button>
        </div>
    </div>
    <div class="container mt-3 mt-lg-4 mb-4">
        <div>
            <form id="multiStepForm">
                <div id="step1" class="form-step">
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" aria-expanded="false"
                                data-bs-toggle="dropdown" type="button">Filter&nbsp;</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-category="makanan">Makanan</a>
                                <a class="dropdown-item" href="#" data-category="minuman">Minuman</a>
                            </div>
                        </div>
                    </div>
                    <h5>Daftar Menu</h5>
                    <div id="productCarousel" class="carousel slide">
                        <div class="carousel-inner" id="carouselInner">
                            <!-- Konten menu daftar menu -->
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-center align-items-center my-3 gap-2">
                            <div class="carousel-controls my-4">
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                    data-bs-slide="prev">
                                    <span class="d-flex align-items-center carousel-control-prev-icon" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                            viewBox="0 0 24 24" fill="none" class="fs-1 text-dark">
                                            <path
                                                d="M11 15L8 12M8 12L11 9M8 12L16 12M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </button>
                                <span class="page-indicator mx-4"></span>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                    data-bs-slide="next"><span class="d-flex align-items-center carousel-control-next-icon"
                                        aria-hidden="true"><svg class="fs-1 text-dark" xmlns="http://www.w3.org/2000/svg"
                                            width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M13 9L16 12M16 12L13 15M16 12L8 12M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg></span></button>
                            </div>
                        </div>
                    </div>
                    <h5>Detail Pesanan</h5>
                    <div class="card shadow-none p-3" id="orderDetail">
                        <div class="card-body p-3">
                            <!-- Detail pesanan -->
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center my-3">
                        <button class="btn btn-primary" id="next1" type="button">Next</button>
                    </div>
                </div>
                <div id="step2" class="form-step hidden">
                    <h5>Nomor Meja</h5>
                    <div class="mb-3" id="tableContainer">
                        <div class="row gx-2 gy-2">
                            <!-- Data meja -->
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-end gap-2 my-3">
                        <button class="btn btn-secondary" id="prev1" type="button">Previous</button>
                        <button class="btn btn-primary" id="next2" type="button">Next</button>
                    </div>
                </div>
                <div id="step3" class="form-step hidden">
                    <h5>Pembayaran</h5>
                    <div class="row">
                        <div class="col col-12">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <h5>Detail Pesanan</h5>
                                            <div id="orderSummary"></div>
                                        </div>
                                        <div class="col">
                                            <h5>Metode Pembayaran</h5>
                                            <div class="mb-3">
                                                <div class="row gx-2 gy-2" id="paymentMethods">
                                                    <div class="col-12 col-sm-6 col-lg-6">
                                                        <input id="pembayaranTunai" class="btn-check" type="radio"
                                                            autocomplete="off" name="pembayaran" value="tunai"
                                                            checked />
                                                        <label
                                                            class="fs-4 d-flex justify-content-center align-items-center btn w-100 table-card btn-light"
                                                            for="pembayaranTunai">Tunai</label>
                                                    </div>
                                                    <!-- Metode pembayaran lainnya bisa tambah disini -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-end gap-2 my-3">
                        <button class="btn btn-secondary" type="button" id="prev2">Previous</button>
                        <button class="btn btn-success" type="submit" id="submitBtn">Submit</button>
                    </div>
                </div>
                <div id="step4" class="form-step hidden">
                    <div class="card shadow-none">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-center">
                                <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="8em"
                                    height="8em" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <h4>Terimakasih!</h4>
                            <p class="card-text">Pesanan akan diproses, mohon menunggu di meja yang dipilih</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <button class="btn btn-primary" id="downloadBillBtn" type="button">Download
                                    Bill</button>
                                <a class="btn btn-primary" href="{{ url('/') }}" role="button">Pesan Lagi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Order Items Array
        let orderItems = [];
        let selectedTable = null;

        // Render Order Detail
        function renderOrderDetail() {
            const orderDetail = document.getElementById('orderDetail');
            orderDetail.innerHTML = '';
            let total = 0;
            let row = document.createElement('div');
            row.classList.add('row', 'gx-2', 'gy-2', 'mb-3');

            orderItems.forEach(item => {
                let cardCol = document.createElement('div');
                cardCol.classList.add('col-md-4', 'col-lg-3', 'col-xl-2');

                let card = `
                <div class="card shadow-none h-100">
                    <img class="img-fluid card-img-top w-100 d-block h-100 w-100" src="storage/menu_images/${item.menu.gambar}">
                    <div class="card-body p-2">
                        <div class="d-flex flex-column justify-content-center align-items-center mb-2 border-bottom">
                            <h6 class="mb-0">${item.menu.nama_menu}</h6>
                            <small>Rp ${item.menu.harga.toLocaleString()}</small>
                        </div>
                        <div class="d-flex align-items-center gap-1 justify-content-center mt-1">
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-primary btn-sm" type="button" onclick="decrementQuantity(${item.menu.id})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                                        <path d="M18 12H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <span>${item.quantity}</span>
                                <button class="btn btn-primary btn-sm" type="button" onclick="incrementQuantity(${item.menu.id})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 6V12M12 12V18M12 12H18M12 12L6 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                            <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeItem(${item.menu.id})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                                    <path d="M19 7L18.1327 19.1425C18.0579 20.1891 17.187 21 16.1378 21H7.86224C6.81296 21 5.94208 20.1891 5.86732 19.1425L5 7M10 11V17M14 11V17M15 7V4C15 3.44772 14.5523 3 14 3H10C9.44772 3 9 3.44772 9 4V7M4 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>`;
                cardCol.innerHTML = card;
                row.appendChild(cardCol);
                total += item.menu.harga * item.quantity;
            });

            orderDetail.appendChild(row);
            let totalElement = `
            <div class="d-flex align-items-center justify-content-between mt-3">
                <button class="btn btn-danger" onclick="clearOrder()">Hapus</button>
                <span class="fw-semibold">Total: Rp ${total.toLocaleString()}</span>
            </div>`;
            orderDetail.innerHTML += totalElement;
        }

        // Add Item to Order
        function addItemToOrder(menu) {
            let existingItem = orderItems.find(item => item.menu.id === menu.id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                orderItems.push({
                    menu: menu,
                    quantity: 1
                });
            }
            renderOrderDetail();
        }

        // Decrement Quantity
        function decrementQuantity(menuId) {
            let itemIndex = orderItems.findIndex(item => item.menu.id === menuId);
            if (itemIndex !== -1) {
                orderItems[itemIndex].quantity--;
                if (orderItems[itemIndex].quantity <= 0) {
                    orderItems.splice(itemIndex, 1);
                }
                renderOrderDetail();
            }
        }

        // Increment Quantity
        function incrementQuantity(menuId) {
            let item = orderItems.find(item => item.menu.id === menuId);
            if (item) {
                item.quantity++;
                renderOrderDetail();
            }
        }

        // Remove Item
        function removeItem(menuId) {
            let itemIndex = orderItems.findIndex(item => item.menu.id === menuId);
            if (itemIndex !== -1) {
                orderItems.splice(itemIndex, 1);
                renderOrderDetail();
            }
        }

        // Clear Order
        function clearOrder() {
            orderItems = [];
            renderOrderDetail();
        }

        document.addEventListener('DOMContentLoaded', function() {
            function renderTables(tables) {
                const tableContainer = document.querySelector('#tableContainer .row');
                tableContainer.innerHTML = '';
                tables.forEach(table => {
                    const tableCol = document.createElement('div');
                    tableCol.classList.add('col-6', 'col-sm-4', 'col-lg-3', 'col-xl-3');
                    const tableCard =
                        `
            <input type="radio" id="table${table.id}" class="btn-check" name="table" autocomplete="off" value="${table.id}" ${table.status === 0 ? 'disabled' : ''}>
            <label class="fs-4 d-flex justify-content-center align-items-center btn btn-light w-100 table-card ${table.status === 0 ? 'disabled' : ''}" for="table${table.id}">${table.nama_meja}</label>`;
                    tableCol.innerHTML = tableCard;
                    tableContainer.appendChild(tableCol);
                });

                document.querySelectorAll('input[name="table"]').forEach(input => {
                    input.addEventListener('change', function() {
                        selectedTable = this.value;
                    });
                });
            }


            // Render Order Summary
            function renderOrderSummary() {
                const orderSummary = document.getElementById('orderSummary');
                orderSummary.innerHTML = '';

                let tableInfo = `<div class="mb-3"><p class="fw-bold">Nomor Meja: ${selectedTable}</p></div>`;
                orderSummary.innerHTML = tableInfo;

                let orderList = document.createElement('ul');
                orderList.classList.add('list-group', 'shadow-none', 'list-group-flush', 'border', 'rounded-2',);

                orderItems.forEach(item => {
                    let listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'px-2');
                    listItem.innerHTML =
                        `
                ${item.menu.nama_menu} - ${item.quantity} x Rp ${item.menu.harga.toLocaleString()} = Rp ${(item.menu.harga * item.quantity).toLocaleString()}`;
                    orderList.appendChild(listItem);
                });

                orderSummary.appendChild(orderList);

                let total = orderItems.reduce((acc, item) => acc + item.menu.harga * item.quantity, 0);
                let totalElement = document.createElement('div');
                totalElement.classList.add('mt-3');
                totalElement.innerHTML = `<p class="fw-bold">Total: Rp ${total.toLocaleString()}</p>`;
                orderSummary.appendChild(totalElement);
            }

            // Set Step Navigation
            function setStepNavigation(step) {
                const steps = ['step1', 'step2', 'step3', 'step4'];
                const navSteps = document.querySelectorAll('.nav-step');

                steps.forEach((stepId, index) => {
                    const element = document.getElementById(stepId);
                    if (stepId === step) {
                        element.classList.remove('hidden');
                        navSteps[index].classList.add('active');
                    } else {
                        element.classList.add('hidden');
                        if (index <= steps.indexOf(step)) {
                            navSteps[index].classList.add('active');
                        } else {
                            navSteps[index].classList.remove('active');
                        }
                    }
                });
            }

            // Filter Items By Category
            function filterItemsByCategory(category) {
                let filteredMenus = allMenus.filter(menu => menu.kategori === category);
                renderItems(filteredMenus);
            }
            
            function renderItems(menus) {
                const carouselInner = document.getElementById('carouselInner');
                carouselInner.innerHTML = '';
                let carouselItems = [];
                let currentIndex = 0;

                while (currentIndex < menus.length) {
                    let chunk = menus.slice(currentIndex, currentIndex + 12);
                    currentIndex += 12;

                    let carouselItem = document.createElement('div');
                    carouselItem.classList.add('carousel-item');
                    if (carouselItems.length === 0) {
                        carouselItem.classList.add('active');
                    }

                    let row = document.createElement('div');
                    row.classList.add('row', 'gx-2', 'gy-2');

                    chunk.forEach(menu => {
                        let cardCol = document.createElement('div');
                        cardCol.classList.add('col-6', 'col-sm-6', 'col-md-4', 'col-lg-3', 'col-xl-2');

                        let card = `
                <div class="card shadow-none h-100">
                    <img class="img-fluid card-img-top h-100 w-100 d-block" src="storage/menu_images/${menu.gambar}" alt="${menu.nama_menu}">
                    <div class="card-body p-2">
                        <div class="d-flex flex-column justify-content-center align-items-center mb-2 border-bottom">
                            <h6 class="mb-0">${menu.nama_menu}</h6>
                            <small>Rp ${menu.harga.toLocaleString()}</small>
                        </div>
                        <button class="btn btn-primary btn-sm mt-2 pilih-btn" type="button" data-menu='${JSON.stringify(menu)}' ${menu.status === 0 ? 'disabled' : ''}>Pilih</button>
                    </div>
                </div>`;
                        cardCol.innerHTML = card;
                        row.appendChild(cardCol);
                    });

                    carouselItem.appendChild(row);
                    carouselItems.push(carouselItem);
                }

                carouselItems.forEach(item => {
                    carouselInner.appendChild(item);
                });

                const pilihButtons = document.querySelectorAll('.pilih-btn');
                pilihButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        const menu = JSON.parse(this.getAttribute('data-menu'));
                        addItemToOrder(menu);
                    });
                });
            }


            // Fetch Menus
            fetch("{{ route('get-menus') }}")
                .then(response => response.json())
                .then(data => {
                    allMenus = data.menus;
                    renderItems(allMenus);
                })
                .catch(error => console.error('Error fetching menus:', error));

            // Step Navigation
            document.getElementById('next1').addEventListener('click', function() {
                // Validasi jika tidak ada menu yang dipilih
                if (orderItems.length === 0) {
                    alert('Silakan pilih menu terlebih dahulu.');
                    return;
                }
                fetch("{{ route('get-tables') }}")
                    .then(response => response.json())
                    .then(data => renderTables(data.tables))
                    .catch(error => console.error('Error fetching tables:', error));
                setStepNavigation('step2');
            });

            document.getElementById('next2').addEventListener('click', function() {
                if (orderItems.length === 0) {
                    alert('Silakan pilih menu terlebih dahulu.');
                    return;
                }
                if (!selectedTable) {
                    alert('Silakan pilih meja terlebih dahulu.');
                    return;
                }
                setStepNavigation('step3');
                renderOrderSummary();
            });

            document.getElementById('prev1').addEventListener('click', function() {
                setStepNavigation('step1');
            });

            document.getElementById('prev2').addEventListener('click', function() {
                setStepNavigation('step2');
            });

            document.getElementById('submitBtn').addEventListener('click', function(event) {
                event.preventDefault();

                const orderData = orderItems.map(item => ({
                    menu_id: item.menu.id,
                    quantity: item.quantity
                }));

                const data = {
                    meja_id: selectedTable,
                    total: orderItems.reduce((total, item) => total + (item.menu.harga * item.quantity),
                        0),
                    order_items: orderData,
                    metode_pembayaran: 'tunai',
                    estimasi: calculateEstimation(),
                    status: 'menunggu',
                    menunggu: new Date().toISOString()
                };

                fetch("{{ route('order.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Navigasi ke step 4
                            setStepNavigation('step4');
                            // Tambahkan ID pesanan ke tombol download bill
                            document.getElementById('downloadBillBtn').dataset.transactionId = data
                                .order.id;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to place order.');
                    });
            });

            document.getElementById('downloadBillBtn').addEventListener('click', function() {
                const transactionId = this.dataset.transactionId;
                if (transactionId) {
                    window.location.href = `/transaction/${transactionId}/bill`;
                } else {
                    alert('No transaction found.');
                }
            });

            // Calculate Estimation
            function calculateEstimation() {
                let totalEstimation = 0;
                orderItems.forEach(item => {
                    totalEstimation += item.menu.waktu_pembuatan * item.quantity;
                });
                return totalEstimation;
            }

            // Event Listener for Filter Buttons
            document.querySelector('.dropdown-item[data-category="makanan"]').addEventListener('click', function() {
                filterItemsByCategory('makanan');
            });

            document.querySelector('.dropdown-item[data-category="minuman"]').addEventListener('click', function() {
                filterItemsByCategory('minuman');
            });
        });
    </script>
@endsection
