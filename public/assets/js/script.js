//  Live Search Résultats


document.addEventListener('DOMContentLoaded', function () {
  const input = document.querySelector('.search-input');
  const tbody = document.querySelector('#results-table-body');

  if (input && tbody) {
    input.addEventListener('input', function () {
      const query = input.value.trim();
      const url = input.dataset.url;

      if (query === '') {
        window.location.reload(); 
        return;
      }

      fetch(`${url}?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(results => {
          tbody.innerHTML = '';

          if (results.length > 0) {
            results.forEach(result => {
              const row = document.createElement('tr');
              row.innerHTML = `
                <td>${result.competition_name}</td>
                <td>${result.category}</td>
                <td>${result.first_name} ${result.last_name}</td>
                <td>${result.club_name}</td>
                <td>${result.position}</td>
              `;
              tbody.appendChild(row);
            });
          } else {
            tbody.innerHTML = `<tr><td colspan="5">Aucun résultat trouvé.</td></tr>`;
          }
        })
        .catch(error => {
          console.error('Erreur de fetch:', error);
          tbody.innerHTML = `<tr><td colspan="5">Erreur lors du chargement.</td></tr>`;
        });
    });
  }
});

