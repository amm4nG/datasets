<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search with Highlight</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dropdown-menu {
            width: 100%;
        }

        mark {
            background-color: yellow;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="form-group">
            <label for="search-input">Search</label>
            <input type="text" class="form-control" value="Algorithmm" id="search-input"
                placeholder="Search...">
            <div class="dropdown">
                <div class="dropdown-menu show" id="search-results">
                    <a href="#" class="dropdown-item disabled bg-info text-white">Mungkin Anda ingin mencari :</a>
                    <a href="#" class="dropdown-item">Neural Network</a>
                    <a href="#" class="dropdown-item">Random Forest</a>
                    <!-- Hasil pencarian akan ditampilkan di sini -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const searchResults = document.getElementById('search-results');
        const searchInput = document.getElementById('search-input');

        // Data yang akan dicari
        // const sampleData = ['Apple', 'Banana', 'Cherry', 'Date', 'Grape', 'Mango', 'Orange', 'Strawberry'];
        const sampleData = [
            'Algorithm',
            'Artificial Intelligence',
            'Neural Network',
            'Supervised Learning',
            'Unsupervised Learning',
            'Regression',
            'Classification',
            'Clustering',
            'Decision Tree',
            'Random Forest',
            'Support Vector Machine',
            'Gradient Descent',
            'Backpropagation',
            'Reinforcement Learning',
            'Deep Learning',
            'Feature Extraction',
            'Overfitting',
            'Underfitting',
            'Cross Validation',
            'Training Data',
            'Test Data',
            'Accuracy',
            'Precision',
            'Recall',
            'F1 Score'
        ];

        // Contoh pencarian kata dalam kamus
        // console.log(machineLearningTerms.includes('Neural Network')); // Output: true
        // Fungsi untuk menambahkan highlight pada hasil yang cocok
        function highlightText(item, query) {
            const regex = new RegExp(query, 'gi');
            return item.replace(regex, '<mark>$&</mark>'); // $& akan mereferensikan teks yang cocok
        }

        // Fungsi yang berjalan setiap kali pengguna mengetik
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            searchResults.innerHTML = ''; // Kosongkan dropdown

            if (query) {
                // Filter data yang cocok
                const filteredData = sampleData.filter(item => item.toLowerCase().includes(query));

                if (filteredData.length > 0) {
                    // Tampilkan hasil yang difilter
                    filteredData.forEach(item => {
                        const highlightedItem = highlightText(item, query);
                        const dropdownItem = document.createElement('a');
                        dropdownItem.classList.add('dropdown-item');
                        dropdownItem.href = "#";
                        dropdownItem.innerHTML = highlightedItem; // Masukkan hasil dengan highlight
                        searchResults.appendChild(dropdownItem);
                    });
                } else {
                    // Tampilkan pesan "Tidak ada data"
                    const noDataItem = document.createElement('a');
                    noDataItem.classList.add('dropdown-item');
                    noDataItem.href = "#";
                    noDataItem.innerHTML = 'Mesin'; // Pesan tidak ada data
                    searchResults.appendChild(noDataItem);
                }
                searchResults.classList.add('show');
            } else {
                searchResults.classList.remove('show');
            }
        });

        // Menutup dropdown ketika mengklik di luar
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.form-group')) {
                searchResults.classList.remove('show');
            }
        });
    </script>
</body>

</html>
