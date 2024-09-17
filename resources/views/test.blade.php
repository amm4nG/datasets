<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Query Suggestion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #suggestions {
      max-height: 200px;
      overflow-y: auto;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4">Search System with Query Suggestion</h2>
    <div class="row">
      <div class="col-md-8">
        <!-- Search Input -->
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="searchInput" placeholder="Search by title or abstract"
            aria-label="Search">
        </div>

        <!-- Dropdown Query Suggestions -->
        <ul class="list-group" id="suggestions"></ul>
      </div>

      <!-- Filter for fields -->
      <div class="col-md-4">
        <h5>Search in:</h5>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="searchField" id="searchTitle" value="title" checked>
          <label class="form-check-label" for="searchTitle">
            Title
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="searchField" id="searchAbstract" value="abstract">
          <label class="form-check-label" for="searchAbstract">
            Abstract
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="searchField" id="searchBoth" value="both">
          <label class="form-check-label" for="searchBoth">
            Both
          </label>
        </div>
      </div>
    </div>
  </div>

  <script>
    const suggestions = document.getElementById('suggestions');
    const searchInput = document.getElementById('searchInput');
    const searchField = document.getElementsByName('searchField');

    const data = [
      { title: 'Machine Learning for Beginners', abstract: 'An introduction to machine learning concepts, including supervised and unsupervised learning techniques, and how they can be applied to various industries and sectors.' },
      { title: 'Deep Learning with Python', abstract: 'Learn how to build neural networks with Python, from simple feedforward networks to more complex architectures like convolutional neural networks (CNNs) and recurrent neural networks (RNNs).' },
      { title: 'AI in Healthcare', abstract: 'Exploring the use of artificial intelligence in healthcare to improve patient outcomes, streamline administrative processes, and enhance diagnostic accuracy with machine learning algorithms.' },
    ];

    searchInput.addEventListener('input', function() {
      const query = searchInput.value.toLowerCase();
      const selectedField = Array.from(searchField).find(radio => radio.checked).value;
      suggestions.innerHTML = '';

      data.forEach(item => {
        let match = false;
        if (selectedField === 'title' && item.title.toLowerCase().includes(query)) {
          match = true;
        } else if (selectedField === 'abstract' && item.abstract.toLowerCase().includes(query)) {
          match = true;
        } else if (selectedField === 'both' && (item.title.toLowerCase().includes(query) || item.abstract.toLowerCase().includes(query))) {
          match = true;
        }

        if (match) {
          const li = document.createElement('li');
          li.classList.add('list-group-item');
          
          // Limit the abstract length
          const maxLength = 100; // Maximum characters to display for abstract
          const shortAbstract = item.abstract.length > maxLength 
            ? item.abstract.substring(0, maxLength) + '...' 
            : item.abstract;

          li.textContent = `${item.title} - ${shortAbstract}`;
          suggestions.appendChild(li);
        }
      });
    });
  </script>
</body>

</html>